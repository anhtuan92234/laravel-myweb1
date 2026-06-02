<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Lấy danh sách ID của bảng users để gán khóa ngoại chính xác
       $userIds = DB::table('users')->pluck('id')->toArray();

       // Nếu bảng users chưa có dữ liệu, mặc định lấy từ 1 đến 10
       if (empty($userIds)) {
           $userIds = range(1, 10);
       }

       for ($i = 1; $i <= 50; $i++) {
           // Tạo tiêu đề bài viết ngẫu nhiên từ 3 đến 6 từ
           $title = fake()->sentence(rand(3, 6));

           DB::table('posts')->insert([
               'title'      => $title,
               'slug'       => Str::slug($title) . '-' . $i, // Đảm bảo tính unique kèm chỉ số $i
               'content'    => fake()->paragraph(rand(3, 7)), // Nội dung bài viết dài từ 3-7 đoạn
               'image'      => 'post-' . rand(1, 10) . '.jpg', // Tên file ảnh giả lập như mẫu product
               'status'     => rand(0, 1),
               'user_id'    => fake()->randomElement($userIds), // Lấy ngẫu nhiên 1 ID user đang tồn tại
               'created_at' => now(),
               'updated_at' => now(),
           ]);
       }
    }
}
