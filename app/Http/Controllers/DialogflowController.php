<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Product;

class DialogflowController extends Controller
{
    public function status(): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'message' => 'Dialogflow webhook endpoint is working'
        ]);
    }

    public function handleWebhook(Request $request): JsonResponse
    {
        $body = $request->json()->all();
        $intent = $body['queryResult']['intent']['displayName'] ?? null;
        $parameters = $body['queryResult']['parameters'] ?? [];

        switch ($intent) {
            case 'get_product_count':
                return $this->handleGetProductCount($parameters);
            default:
                return response()->json([
                    'fulfillmentText' => 'Sorry, I don\'t understand that request.'
                ]);
        }
    }

    private function handleGetProductCount(array $parameters): JsonResponse
    {
        $categoryName = $parameters['category'] ?? null;

        if (!$categoryName) {
            return response()->json([
                'fulfillmentText' => 'Please specify a category name.'
            ]);
        }

        $category = Category::where('name', 'like', "%{$categoryName}%")->first();

        if (!$category) {
            return response()->json([
                'fulfillmentText' => "Sorry, I couldn't find a category named '{$categoryName}'."
            ]);
        }

        $productCount = $category->products()->count();

        return response()->json([
            'fulfillmentText' => "There are {$productCount} products in the {$category->name} category."
        ]);
    }

    public function handleWebhook(Request $request)
    {
        $data = $request->all();
        $intent = $data['queryResult']['intent']['displayName'];
        $parameters = $data['queryResult']['parameters'];

        if ($intent === 'get_products_by_category') {
            $category = $parameters['category'];
            $count = Product::where('category', $category)->count();

            return response()->json([
                'fulfillmentText' => "There are {$count} products available in the {$category} category."
            ]);
        }

        return response()->json([
            'fulfillmentText' => "I'm sorry, I couldn't process that request."
        ]);
    }
}