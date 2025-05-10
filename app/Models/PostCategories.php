<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategories extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'is_active',
        'description',
    ];
    protected $casts = [
        'is_active' => 'boolean'
    ];
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }

}
