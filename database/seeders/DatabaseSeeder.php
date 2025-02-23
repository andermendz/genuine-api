<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        // Create predefined categories with products
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Electronic devices and accessories',
                'products' => [
                    ['name' => 'Smart LED TV 55"', 'description' => '4K Ultra HD Smart LED TV with HDR', 'quantity' => 15],
                    ['name' => 'Wireless Earbuds', 'description' => 'True wireless earbuds with noise cancellation', 'quantity' => 50],
                    ['name' => 'Gaming Laptop', 'description' => '15.6" Gaming Laptop with RTX 3060', 'quantity' => 10],
                    ['name' => 'Smartphone', 'description' => '6.7" Smartphone with 5G capability', 'quantity' => 25],
                    ['name' => 'Smartwatch', 'description' => 'Fitness tracking smartwatch with heart rate monitor', 'quantity' => 30],
                    ['name' => 'Tablet', 'description' => '10.9" Tablet with Retina display', 'quantity' => 20]
                ]
            ],
            [
                'name' => 'Clothing',
                'description' => 'Fashion apparel and accessories',
                'products' => [
                    ['name' => 'Denim Jeans', 'description' => 'Classic fit denim jeans for men', 'quantity' => 75],
                    ['name' => 'Cotton T-Shirt', 'description' => 'Premium cotton crew neck t-shirt', 'quantity' => 100],
                    ['name' => 'Winter Jacket', 'description' => 'Waterproof winter jacket with thermal lining', 'quantity' => 40],
                    ['name' => 'Running Shoes', 'description' => 'Lightweight running shoes with cushioning', 'quantity' => 60],
                    ['name' => 'Leather Belt', 'description' => 'Genuine leather belt with classic buckle', 'quantity' => 45],
                    ['name' => 'Wool Sweater', 'description' => 'Merino wool sweater for winter', 'quantity' => 35]
                ]
            ],
            [
                'name' => 'Home & Garden',
                'description' => 'Home decor, furniture, and gardening supplies',
                'products' => [
                    ['name' => 'Garden Tool Set', 'description' => 'Complete set of essential gardening tools', 'quantity' => 25],
                    ['name' => 'Coffee Table', 'description' => 'Modern wooden coffee table with storage', 'quantity' => 15],
                    ['name' => 'Bed Sheets Set', 'description' => '100% Cotton bed sheets with pillowcases', 'quantity' => 50],
                    ['name' => 'Indoor Plant Pot', 'description' => 'Ceramic plant pot with drainage system', 'quantity' => 40],
                    ['name' => 'Wall Clock', 'description' => 'Modern minimalist wall clock', 'quantity' => 30],
                    ['name' => 'Kitchen Knife Set', 'description' => 'Professional 6-piece kitchen knife set', 'quantity' => 20]
                ]
            ],
            [
                'name' => 'Books',
                'description' => 'Books, magazines, and publications',
                'products' => [
                    ['name' => 'Programming Guide', 'description' => 'Complete guide to modern programming', 'quantity' => 45],
                    ['name' => 'Cookbook', 'description' => 'International cuisine cookbook with recipes', 'quantity' => 35],
                    ['name' => 'Science Fiction Novel', 'description' => 'Bestselling sci-fi novel hardcover', 'quantity' => 50],
                    ['name' => 'Self-Help Book', 'description' => 'Personal development and motivation guide', 'quantity' => 40],
                    ['name' => 'Children\'s Book Set', 'description' => 'Educational children\'s book collection', 'quantity' => 30],
                    ['name' => 'History Book', 'description' => 'Comprehensive world history book', 'quantity' => 25]
                ]
            ],
            [
                'name' => 'Sports & Outdoors',
                'description' => 'Sports equipment and outdoor gear',
                'products' => [
                    ['name' => 'Yoga Mat', 'description' => 'Non-slip exercise yoga mat', 'quantity' => 55],
                    ['name' => 'Tennis Racket', 'description' => 'Professional tennis racket with case', 'quantity' => 25],
                    ['name' => 'Camping Tent', 'description' => '4-person waterproof camping tent', 'quantity' => 20],
                    ['name' => 'Basketball', 'description' => 'Official size indoor/outdoor basketball', 'quantity' => 40],
                    ['name' => 'Hiking Backpack', 'description' => '40L hiking backpack with rain cover', 'quantity' => 30],
                    ['name' => 'Fitness Dumbbells', 'description' => 'Adjustable weight dumbbells set', 'quantity' => 25]
                ]
            ]
        ];

        foreach ($categories as $categoryData) {
            $products = $categoryData['products'];
            unset($categoryData['products']);
            
            $category = Category::create($categoryData);
            
            foreach ($products as $productData) {
                $productData['category_id'] = $category->id;
                Product::create($productData);
            }
        }
    }
}
