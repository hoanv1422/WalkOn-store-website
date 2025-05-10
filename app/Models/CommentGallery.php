<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'image',
    ];

    /**
     * Get the comment that owns the image.
     */
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
