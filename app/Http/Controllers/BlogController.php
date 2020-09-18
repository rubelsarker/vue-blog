<?php

namespace App\Http\Controllers;

use App\Models\Model\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $posts = Post::with('user','tags','categories')->orderBy('id','desc')->get();
        return response()->json(['posts' => $posts],200);
    }
}
