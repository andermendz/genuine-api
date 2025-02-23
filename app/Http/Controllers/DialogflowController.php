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

        // Intent Handling
        switch ($intent) {
            case 'product.availability':
                $productName = $parameters['product'] ?? '';
                return $this->handleProductAvailability($productName);

            case 'category.product_count':
                $categoryName = $parameters['category'] ?? '';
                return $this->handleCategoryProductCount($categoryName);

            default:
                // Fallback Intent (good practice)
                return response()->json([
                    'fulfillmentText' => "I'm not sure how to help with that. Could you rephrase your request, asking about a product or a category?"
                ]);
        }
    }

    private function handleCategoryProductCount(string $categoryName): JsonResponse
    {
        $category = Category::whereRaw('LOWER(name) = ?', [strtolower($categoryName)])->first();

        if (!$category) {
            return response()->json([
                'fulfillmentText' => "I couldn't find the '$categoryName' category. We have categories like Electronics, Clothing, Home & Garden, Books, and Sports & Outdoors."
            ]);
        }

        $productCount = Product::where('category_id', $category->id)->count();

        return response()->json([
            'fulfillmentText' => "There are $productCount products in the {$category->name} category."
        ]);
    }


    private function handleProductAvailability(string $productName): JsonResponse
    {
        // Search across all products.
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