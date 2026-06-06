<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Ripped Steel Black Slim Fit',
                'category' => 'Slim Fit',
                'price' => 450000,
                'stock' => 15,
                'size' => '30, 32, 34',
                'wash_type' => 'Acid Wash',
                'description' => 'Denim hitam dengan robekan gaya punk metalik, kancing baja tahan karat, dan peregangan yang sangat nyaman.',
                'image_url' => null
            ],
            [
                'name' => 'Classic Gunmetal Straight Jeans',
                'category' => 'Straight',
                'price' => 550000,
                'stock' => 8,
                'size' => '32, 34, 36',
                'wash_type' => 'Raw Denim',
                'description' => 'Denim kaku klasik berwarna abu-abu gunmetal tebal dengan jahitan ganda tembaga yang kokoh.',
                'image_url' => null
            ],
            [
                'name' => 'Cyber-Punk Neon Wash Skinny',
                'category' => 'Skinny',
                'price' => 480000,
                'stock' => 3,
                'size' => '28, 30, 32',
                'wash_type' => 'Stone Wash',
                'description' => 'Jeans skinny fit dengan cuci asam abu-abu tua dan jahitan neon biru redup.',
                'image_url' => null
            ],
            [
                'name' => 'Heavy Metal Rivet Denim Jacket',
                'category' => 'Jacket',
                'price' => 750000,
                'stock' => 5,
                'size' => 'M, L, XL',
                'wash_type' => 'Bleach Wash',
                'description' => 'Jaket denim hitam pekat dengan aksen rivet stud logam di kerah dan sablon grafis metal industrial di bagian punggung.',
                'image_url' => null
            ],
            [
                'name' => 'Dark Destroyer Distressed Jeans',
                'category' => 'Slim Fit',
                'price' => 620000,
                'stock' => 12,
                'size' => '30, 32, 34',
                'wash_type' => 'Destroyed Wash',
                'description' => 'Jeans distressed dengan aksen rantai besi dekoratif yang dapat dilepas-pasang pada loop ikat pinggang.',
                'image_url' => null
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
