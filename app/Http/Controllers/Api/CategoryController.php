<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'categories' => $categories
        ],200);
    }


    public function store(Request $request)
    {
        $request->validate([
            'categoryName'        => 'required|unique:categories'
        ]);
        $photo = $request->categoryImage;
        if($photo){
            $position = strpos($photo,';');
            $sub = substr($photo, 0, $position);
            $ext = explode('/',$sub)[1];
            $imageName = time().".".$ext;
            $upload_path = 'upload/category';
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
            'categoryName'          => $request->categoryName,
            'categoryImage'         => $image_url
        ];
        Category::create($data);
        return response()->json([
           'staus' => 200
        ]);
    }


    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
