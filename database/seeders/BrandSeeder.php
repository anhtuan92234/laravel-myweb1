<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i++) {
            // Tạo tên thương hiệu ngẫu nhiên từ 1 đến 2 từ và viết hoa chữ cái đầu
            $name = $faker->words(rand(1, 2), true);
    $brandName = ucfirst($name) . ' ' . $i;

    DB::table('brands')->insert([
        'brandname'   => $brandName,
        'slug'        => Str::slug($brandName . '-' . $i . '-' . rand(100,999)),
        'image'       => $faker->imageUrl(640, 480, 'brands', true),
        'status'      => $faker->numberBetween(0, 1),
        'sort_order'  => $i,
        'description' => $faker->sentence(20),
        'created_at'  => now(),
        'updated_at'  => now(),
            ]);
        }
    }
}
