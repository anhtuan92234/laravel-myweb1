<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'title',
        'slug',
        'detail',
        'image',
        'topic_id', // Thay đổi cho khớp tên cột trong DB của bạn nếu có
        'user_id',  // Khóa ngoại liên kết với bảng users
        'status'
    ];

    // Quan hệ với User (Người đăng bài)
    public function user()
    {
        // Khóa ngoại là user_id, khóa chính bảng users là id
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
