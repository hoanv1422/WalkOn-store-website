<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'parent_id',
        'content',
        'rating',
        'last_admin_username',
    ];

    /**
     * Get the user who wrote the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * Get the product that the comment belongs to.
     */
    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }

    /**
     * Get the parent comment if it's a reply.
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id')->withDefault();
    }

    /**
     * Get the replies for the comment.
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /**
     * Get the images associated with the comment.
     */
    public function galleries()
    {
        return $this->hasMany(CommentGallery::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }


}
