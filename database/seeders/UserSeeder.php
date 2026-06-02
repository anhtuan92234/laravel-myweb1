<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'fullname'   => 'Nguyễn Anh Admin',
            'username'   => 'admin',
            'email'      => 'admin@gmail.com',
            'password'   => md5('123456'), // Mã hóa MD5 (32 ký tự), mật khẩu là: 123456
            'phone'      => '0912345678',
            'address'    => '123 Đường Tô Ký, Quận 12, TP.HCM',
            'gender'     => 1, // Nam
            'birthday'   => '2000-01-01',
            'role'       => 1, // 1: Quản lý
            'status'     => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // 2. Tạo thêm 9 tài khoản nhân viên/người dùng ngẫu nhiên bằng Faker
        for ($i = 1; $i <= 9; $i++) {
            DB::table('users')->insert([
                'fullname'   => fake()->name(),
                'username'   => fake()->unique()->userName(),
                'email'      => fake()->unique()->safeEmail(),
                'password'   => md5('password'), // Mật khẩu chung là: password
                'phone'      => Str::limit(fake()->unique()->phoneNumber(), 20, ''),
                'address'    => fake()->address(),
                'gender'     => fake()->numberBetween(0, 1), // 0: Nữ, 1: Nam
                'birthday'   => fake()->date('Y-m-d', '2005-01-01'), // Ngày sinh ngẫu nhiên trước năm 2005
                'role'       => 2, // 2: Nhân viên
                'status'     => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
