<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['tagName'];
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags');
    }
}
