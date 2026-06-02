<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            // Tạo tên thương hiệu ngẫu nhiên từ 1 đến 2 từ và viết hoa chữ cái đầu
            $name = fake()->unique()->words(fake()->numberBetween(1, 2), true);
            $brandName = ucfirst($name);

            DB::table('brands')->insert([
                'brandname'   => Str::limit($brandName, 50, ''), // Đảm bảo không quá 50 ký tự
                'slug'        => Str::limit(Str::slug($name), 80, ''), // Đảm bảo không quá 80 ký tự
                'image'       => fake()->imageUrl(640, 480, 'brands', true), // Sinh link ảnh giả lập
                'status'      => fake()->numberBetween(0, 1),
                'sort_order'  => $i,
                'description' => fake()->sentence(20),
                'created_at'  => now(),
                'updated_at'  => now()
            ]);
        }
    }
}
