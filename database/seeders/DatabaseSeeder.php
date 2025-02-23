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
        // Create a test user
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        // Define categories with uneven distribution of products
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Electronic devices and accessories',
                'products' => [
                    ['name' => 'Smart LED TV 55"', 'description' => '4K Ultra HD Smart LED TV with HDR', 'quantity' => 12],
                    ['name' => 'Wireless Earbuds', 'description' => 'True wireless earbuds with noise cancellation', 'quantity' => 30],
                    ['name' => 'Gaming Laptop', 'description' => '15.6" Gaming Laptop with RTX 3060', 'quantity' => 8],
                    ['name' => 'Smartphone', 'description' => '6.7" Smartphone with 5G capability', 'quantity' => 20],
                    ['name' => 'Smartwatch', 'description' => 'Fitness tracking smartwatch with heart rate monitor', 'quantity' => 25],
                    ['name' => 'Tablet', 'description' => '10.9" Tablet with Retina display', 'quantity' => 15],
                    ['name' => 'Bluetooth Speaker', 'description' => 'Portable Bluetooth speaker with deep bass', 'quantity' => 22],
                    ['name' => 'Digital Camera', 'description' => 'High-resolution digital camera with zoom lens', 'quantity' => 10],
                    ['name' => 'VR Headset', 'description' => 'Immersive virtual reality headset', 'quantity' => 5],
                    ['name' => 'Gaming Console', 'description' => 'Latest generation gaming console', 'quantity' => 7],
                ],
            ],
            [
                'name' => 'Clothing',
                'description' => 'Fashion apparel and accessories',
                'products' => [
                    ['name' => 'Denim Jeans', 'description' => 'Classic fit denim jeans for men', 'quantity' => 60],
                    ['name' => 'Cotton T-Shirt', 'description' => 'Premium cotton crew neck t-shirt', 'quantity' => 80],
                    ['name' => 'Winter Jacket', 'description' => 'Waterproof winter jacket with thermal lining', 'quantity' => 35],
                    ['name' => 'Running Shoes', 'description' => 'Lightweight running shoes with cushioning', 'quantity' => 55],
                    ['name' => 'Leather Belt', 'description' => 'Genuine leather belt with classic buckle', 'quantity' => 40],
                    ['name' => 'Wool Sweater', 'description' => 'Merino wool sweater for winter', 'quantity' => 30],
                    ['name' => 'Summer Dress', 'description' => 'Light and airy summer dress', 'quantity' => 25],
                ],
            ],
            [
                'name' => 'Home & Garden',
                'description' => 'Home decor, furniture, and gardening supplies',
                'products' => [
                    ['name' => 'Garden Tool Set', 'description' => 'Complete set of essential gardening tools', 'quantity' => 20],
                    ['name' => 'Coffee Table', 'description' => 'Modern wooden coffee table with storage', 'quantity' => 12],
                    ['name' => 'Bed Sheets Set', 'description' => '100% cotton bed sheets with pillowcases', 'quantity' => 45],
                    ['name' => 'Indoor Plant Pot', 'description' => 'Ceramic plant pot with drainage system', 'quantity' => 35],
                    ['name' => 'Wall Clock', 'description' => 'Modern minimalist wall clock', 'quantity' => 28],
                    ['name' => 'Kitchen Knife Set', 'description' => 'Professional 6-piece kitchen knife set', 'quantity' => 18],
                    ['name' => 'LED Floor Lamp', 'description' => 'Energy-saving LED floor lamp', 'quantity' => 15],
                ],
            ],
            [
                'name' => 'Books',
                'description' => 'Books, magazines, and publications',
                'products' => [
                    ['name' => 'Programming Guide', 'description' => 'Complete guide to modern programming', 'quantity' => 40],
                    ['name' => 'Cookbook', 'description' => 'International cuisine cookbook with recipes', 'quantity' => 25],
                    ['name' => 'Science Fiction Novel', 'description' => 'Bestselling sci-fi novel hardcover', 'quantity' => 30],
                    ['name' => 'Self-Help Book', 'description' => 'Personal development and motivation guide', 'quantity' => 20],
                    ['name' => 'Children\'s Book Set', 'description' => 'Educational children\'s book collection', 'quantity' => 15],
                ],
            ],
            [
                'name' => 'Sports & Outdoors',
                'description' => 'Sports equipment and outdoor gear',
                'products' => [
                    ['name' => 'Yoga Mat', 'description' => 'Non-slip exercise yoga mat', 'quantity' => 50],
                    ['name' => 'Tennis Racket', 'description' => 'Professional tennis racket with case', 'quantity' => 18],
                    ['name' => 'Camping Tent', 'description' => '4-person waterproof camping tent', 'quantity' => 10],
                    ['name' => 'Basketball', 'description' => 'Official size indoor/outdoor basketball', 'quantity' => 30],
                    ['name' => 'Hiking Backpack', 'description' => '40L hiking backpack with rain cover', 'quantity' => 22],
                    ['name' => 'Fitness Dumbbells', 'description' => 'Adjustable weight dumbbells set', 'quantity' => 16],
                    ['name' => 'Fishing Rod', 'description' => 'Lightweight fishing rod for freshwater', 'quantity' => 8],
                    ['name' => 'Running Cap', 'description' => 'Breathable running cap', 'quantity' => 12],
                    ['name' => 'Cycling Gloves', 'description' => 'Padded cycling gloves', 'quantity' => 15],
                ],
            ],
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
