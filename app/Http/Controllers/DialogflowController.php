<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class DialogflowController extends Controller
{
    /**
     * Handle the Dialogflow webhook request.
     * Expects a payload with a "queryResult" key.
     */
    public function handleWebhook(Request $request): JsonResponse
    {
        Log::info('Dialogflow Webhook Request:', $request->all());

        // Expect the request to have a "queryResult" key.
        $queryResult = $request->input('queryResult');

        if (!$queryResult) {
            return response()->json([
                'fulfillmentText' => "Invalid request payload."
            ]);
        }

        // Extract the intent name, parameters, and query text.
        $intent     = $queryResult['intent']['displayName'] ?? 'Default Fallback Intent';
        $parameters = $queryResult['parameters'] ?? [];
        $queryText  = $queryResult['queryText'] ?? '';

        // --- Intent handling ---

        // Default Welcome Intent
        if ($intent === 'Default Welcome Intent') {
            return response()->json([
                'fulfillmentText' => 'Hello! How can I assist you today?'
            ]);
        }

        // Default Fallback Intent
        if ($intent === 'Default Fallback Intent') {
            return response()->json([
                'fulfillmentText' => "Sorry, I didn't understand that. Could you please rephrase?"
            ]);
        }

        // Product Availability Intent
        if ($intent === 'product.availability') {
            // Get the category or product from parameters
            $categoryName = isset($parameters['category']) ? trim($parameters['category']) : '';
            $productName  = isset($parameters['product'])  ? trim($parameters['product'])  : '';

            // Remove any trailing punctuation
            $categoryName = preg_replace('/[?!.]+$/', '', $categoryName);
            $productName  = preg_replace('/[?!.]+$/', '', $productName);

            // If no product is specified, or if the query indicates a count request,
            // handle it as a category query.
            $isCountQuery = preg_match('/\b(count|total|number of|items?)\b/i', $queryText);
            if ($isCountQuery || empty($productName)) {
                return $this->handleProductAvailabilityByCategory($categoryName);
            }

            // Otherwise, handle it as a product-specific query.
            return $this->handleProductAvailabilityByProduct($categoryName, $productName);
        }

        // Fallback response for unrecognized intents.
        return response()->json([
            'fulfillmentText' => "I'm not sure how to help with that."
        ]);
    }

    /**
     * Returns the total number of products in the given category.
     */
    private function handleProductAvailabilityByCategory(string $categoryName): JsonResponse
    {
        if (empty($categoryName)) {
            return response()->json([
                'fulfillmentText' => 'Which category would you like to check?'
            ]);
        }

        $category = Category::whereRaw('LOWER(name) = ?', [strtolower($categoryName)])->first();

        if (!$category) {
            return response()->json([
                'fulfillmentText' => "I couldn't find the '$categoryName' category."
            ]);
        }

        $count = Product::where('category_id', $category->id)->count();

        return response()->json([
            'fulfillmentText' => "There are $count products in the {$category->name} category."
        ]);
    }

    /**
     * Returns the stock quantity of a product,
     * optionally scoped to a category.
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

        // If no category is provided, search all products.
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
