<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComments extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'user_id',
        'content',
        'status',
        'parent_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product that the comment belongs to.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function replies()
    {
        return $this->hasMany(PostComments::class, 'parent_id')->with('user', 'replies');
    }
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
    public function getDepth(): int
    {
        $depth = 1;
        $p = $this->parent;
        while ($p) {
            $depth++;
            $p = $p->parent;
        }
        return $depth;
    }
}
