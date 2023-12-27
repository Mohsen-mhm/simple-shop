<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'کفش 1',
                'title' => 'این محصول کفش شماره 1 است',
                'slug' => 'shoe-1',
                'price' => 350000,
                'quantity' => 20,
                'colors' => json_encode(['red', 'blue']),
            ],
            [
                'name' => 'کفش 2',
                'title' => 'این محصول کفش شماره 2 است',
                'slug' => 'shoe-2',
                'price' => 290000,
                'quantity' => 10,
                'colors' => json_encode(['yellow', 'red']),
            ],
            [
                'name' => 'کفش 3',
                'title' => 'این محصول کفش شماره 3 است',
                'slug' => 'shoe-3',
                'price' => 410000,
                'quantity' => 4,
                'colors' => json_encode(['yellow', 'blue', 'green']),
            ],
            [
                'name' => 'کفش 4',
                'title' => 'این محصول کفش شماره 4 است',
                'slug' => 'shoe-4',
                'price' => 246000,
                'quantity' => 7,
                'colors' => json_encode(['blue', 'green', 'gray']),
            ],
            [
                'name' => 'کفش 5',
                'title' => 'این محصول کفش شماره 5 است',
                'slug' => 'shoe-5',
                'price' => 670000,
                'quantity' => 14,
                'colors' => json_encode(['blue', 'green', 'gray', 'purple']),
            ],
            [
                'name' => 'کفش 6',
                'title' => 'این محصول کفش شماره 6 است',
                'slug' => 'shoe-6',
                'price' => 510000,
                'quantity' => 2,
                'colors' => json_encode(['purple']),
            ],
        ];
        $productImagesPath = public_path('img/products');
        $productImageFiles = glob($productImagesPath . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
        $usedImages = [];

        foreach ($items as $item) {
            $product = Product::query()->whereSlug($item['slug'])->first();

            if (!$product) {
                $createdProduct = Product::create($item);

                $availableImages = array_diff($productImageFiles, $usedImages);
                if (empty($availableImages)) {
                    // All images have been used; handle this case as needed
                    break;
                }

                $randomImage = $productImageFiles[array_rand($productImageFiles)];

                // Get the file extension
                $extension = pathinfo($randomImage, PATHINFO_EXTENSION);

                // Generate a random name for the image with the correct extension
                $imageFileName = Str::random(10) . '.' . $extension;

                // Move the image to storage
                $destinationPath = storage_path('app/public/images/products');

                if (!File::isDirectory($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true, true);
                }

                $movedImagePath = $destinationPath . '/' . $imageFileName;
                copy($randomImage, $movedImagePath);

                // Save the image in the images table
                $image = new Image([
                    'image' => $imageFileName,
                ]);

                $createdProduct->image()->save($image);

                $usedImages[] = $randomImage;
            }
        }
    }
}
