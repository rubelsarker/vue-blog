<?php

namespace App\Models\Model;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','body','views','user_id','postImage','slug'];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_posts')->withTimestamps();
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags')->withTimestamps();
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
