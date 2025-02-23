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

        // Fix: Use 'category' instead of 'productavailability'
        $categoryName = $parameters['category'] ?? '';

        if ($intent === 'product.availability') {
            return $this->handleProductAvailability($categoryName);
        }

        return response()->json([
            'fulfillmentText' => "I'm not sure how to help with that."
        ]);
    }

    private function handleProductAvailability(string $categoryName): JsonResponse
    {
        if (empty($categoryName)) {
            return response()->json([
                'fulfillmentText' => 'Which category would you like to check?'
            ]);
        }

        // Case-insensitive exact match for category
        $category = Category::whereRaw('LOWER(name) = LOWER(?)', [trim($categoryName)])
            ->select('id', 'name')
            ->first();

        if (!$category) {
            return response()->json([
                'fulfillmentText' => "I couldn't find the '$categoryName' category."
            ]);
        }

        $productCount = Product::where('category_id', $category->id)
            ->count();

        return response()->json([
            'fulfillmentText' => "There are $productCount products in the {$category->name} category."
        ]);
    }
}