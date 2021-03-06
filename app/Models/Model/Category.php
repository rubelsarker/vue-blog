<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['categoryName','categoryImage'];
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_posts');
    }
}
