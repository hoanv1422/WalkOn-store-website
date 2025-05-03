<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentHidden extends Model
{
    protected $table = 'comment_hidden'; // Chỉ định tên bảng chính xác
    protected $fillable = ['comment_id', 'hidden_at'];

    // Mối quan hệ với bảng comment
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}

