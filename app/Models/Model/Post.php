<?php

namespace App\Models\Model;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','body','views'];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_posts');
    }
    public function tags()
    {
        return $this->belongsToMany(Post::class, 'post_tags');
    }
    public function user(){
        return $this->belongsTo(User::class,'id');
    }
}
