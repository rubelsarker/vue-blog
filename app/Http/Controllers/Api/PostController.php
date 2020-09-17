<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Model\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with('user','tags','categories')->get();
        return response()->json(['posts' => $posts],200);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|min:10',
            'body'         => 'required'
        ]);
        $photo = $request->postImage;
        if($photo){
            $position = strpos($photo,';');
            $sub = substr($photo, 0, $position);
            $ext = explode('/',$sub)[1];
            $imageName = time().".".$ext;
            $upload_path = 'upload/post';
            if (!File::exists($upload_path)) {
                File::makeDirectory($upload_path, $mode = 0777, true, true);
            }
            $img = Image::make($photo)->resize(240,200);
            $image_url = $upload_path . '/' . $imageName;
            $img->save($image_url);
        }
        else{
            $image_url = '';
        }
        $data = [
            'title'         => $request->title,
            'body'          => $request->body,
            'slug'          => Str::slug($request->title),
            'postImage'     => $image_url,
            'user_id'       => 1
        ];
        $post =  Post::create($data);
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        return response()->json([
            'staus' => 200
        ]);
    }


    public function show($id)
    {
        $row = Post::where('id',$id)->with('categories','tags')->first();
        $cat = [];
        $tags = [];
        foreach ($row->categories as $r){
            $cat[] = $r->id;
        }
        foreach ($row->tags as $r){
            $tags[] = $r->id;
        }
        return response()->json(['row' => $row, 'cats' => $cat,  'tags' => $tags]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title'        => 'required|min:10',
            'body'         => 'required'
        ]);
        $row = Post::findOrFail($id);
        $photo = $request->newPostImage;
        if($photo){
            $position = strpos($photo,';');
            $sub = substr($photo, 0, $position);
            $ext = explode('/',$sub)[1];
            $imageName = time().".".$ext;
            $upload_path = 'upload/post';
            if (!File::exists($upload_path)) {
                File::makeDirectory($upload_path, $mode = 0777, true, true);
            }
            if(file_exists($row->postImage)){
                unlink($row->postImage);
            }
            $img = Image::make($photo)->resize(240,200);
            $image_url = $upload_path . '/' . $imageName;
            $img->save($image_url);
        }
        else{
            $image_url = $row->postImage;
        }
        $data = [
            'title'         => $request->title,
            'body'          => $request->body,
            'slug'          => Str::slug($request->title),
            'postImage'     => $image_url,
        ];
        $dataId  = Post::where('id',$id)->update($data);
        $post = Post::findOrFail($dataId);
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        return response()->json([
            'staus' => 200
        ]);
    }


    public function destroy($id)
    {
        $row = Post::findOrFail($id);
        if(file_exists($row->postImage)){
            unlink($row->postImage);
        }
        $row->categories()->detach();
        $row->tags()->detach();
        $row->delete();
        return response()->json([
            'staus' => 200
        ]);
    }
}
