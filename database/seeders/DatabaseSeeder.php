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

        $categoryName = $parameters['category'] ?? '';

        // Intent Handling
        if ($intent === 'category.product_count') { // Match the new intent name
            return $this->getCategoryProductCount($categoryName);
        }

        // Fallback Intent 
        return response()->json([
            'fulfillmentText' => "I'm not sure how to help with that.  Could you rephrase your request, asking about a category?"
        ]);
    }

    private function getCategoryProductCount(string $categoryName): JsonResponse
    {
        $category = Category::whereRaw('LOWER(name) = ?', [strtolower($categoryName)])->first();

        if (!$category) {
            return response()->json([
                'fulfillmentText' => "I couldn't find the '$categoryName' category.  We have categories like Electronics, Clothing, Home & Garden, Books, and Sports & Outdoors."
            ]);
        }

        $productCount = Product::where('category_id', $category->id)->count();

        return response()->json([
            'fulfillmentText' => "There are $productCount products in the {$category->name} category."
        ]);
    }
}