<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class DialogflowController extends Controller
{
    public function handleWebhook(Request $request): JsonResponse
    {
        Log::info('Dialogflow Request:', $request->all());
        
        $intent = $request->input('queryResult.intent.displayName');
        $parameters = $request->input('queryResult.parameters', []);
        $queryText = $request->input('queryResult.queryText', '');
        
        // Retrieve and trim parameters.
        $categoryName = isset($parameters['category']) ? trim($parameters['category']) : '';
        $productName  = isset($parameters['product'])  ? trim($parameters['product'])  : '';
        
        // Fallback extraction: If both category and product are empty, try to extract product from query text.
        if (empty($categoryName) && empty($productName) && preg_match('/Do you have\s+(.+)/i', $queryText, $matches)) {
            $productName = trim($matches[1]);
            Log::info("Fallback extraction: detected product '$productName' from query text.");
        }
        
        // Check if the query appears to be asking for a count
        $isCountQuery = preg_match('/\b(count|total|number of|items?)\b/i', $queryText);
        
        if ($intent === 'product.availability') {
            // If it's a count query or if the product name is empty, handle it as a category count.
            if ($isCountQuery || empty($productName)) {
                return $this->handleProductAvailabilityByCategory($categoryName);
            }
            // Otherwise, process as a product-specific availability query.
            return $this->handleProductAvailabilityByProduct($categoryName, $productName);
        }
        
        return response()->json([
            'fulfillmentText' => "I'm not sure how to help with that."
        ]);
    }
    
    /**
     * Handles category-based queries by returning the total count of products.
     *
     * @param string $categoryName
     * @return JsonResponse
     */
    private function handleProductAvailabilityByCategory(string $categoryName): JsonResponse
    {
        if (empty($categoryName)) {
            return response()->json([
                'fulfillmentText' => 'Which category would you like to check?'
            ]);
        }
        
        // Perform a case-insensitive match on the category name.
        $category = Category::whereRaw('LOWER(name) = ?', [strtolower($categoryName)])->first();
        
        if (!$category) {
            return response()->json([
                'fulfillmentText' => "I couldn't find the '$categoryName' category."
            ]);
        }
        
        $productCount = Product::where('category_id', $category->id)->count();
        
        return response()->json([
            'fulfillmentText' => "There are $productCount products in the {$category->name} category."
        ]);
    }
    
    /**
     * Handles product-specific queries by returning the stock quantity.
     * If a category is provided, the search is limited to that category.
     *
     * @param string $categoryName
     * @param string $productName
     * @return JsonResponse
     */
    private function handleProductAvailabilityByProduct(string $categoryName, string $productName): JsonResponse
    {
        if (!empty($categoryName)) {
            $category = Category::whereRaw('LOWER(name) = ?', [strtolower($categoryName)])->first();
            if (!$category) {
                return response()->json([
                    'fulfillmentText' => "I couldn't find the '$categoryName' category."
                ]);
            }
            
            // Search within the specified category using a case-insensitive partial match.
            $product = Product::where('category_id', $category->id)
                              ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($productName) . '%'])
                              ->first();
            
            if (!$product) {
                return response()->json([
                    'fulfillmentText' => "I couldn't find a product matching '$productName' in the {$category->name} category."
                ]);
            }
            
            return response()->json([
                'fulfillmentText' => "The product '{$product->name}' is available with a quantity of {$product->quantity}."
            ]);
        }
        
        // If no category is provided, search across all products.
        $product = Product::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($productName) . '%'])->first();
        
        if (!$product) {
            return response()->json([
                'fulfillmentText' => "I couldn't find a product matching '$productName'."
            ]);
        }
        
        return response()->json([
            'fulfillmentText' => "The product '{$product->name}' is available with a quantity of {$product->quantity}."
        ]);
    }
}
