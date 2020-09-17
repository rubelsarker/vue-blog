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
        $row = Category::findOrFail($id);
        return response()->json(['row' => $row]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'categoryName'   => 'required|unique:categories,categoryName,'.$id,
        ]);
        $row = Category::findOrFail($id);
        $photo = $request->newCategoryImage;
        if($photo){
            $position = strpos($photo,';');
            $sub = substr($photo, 0, $position);
            $ext = explode('/',$sub)[1];
            $imageName = time().".".$ext;
            $upload_path = 'upload/category';
            if (!File::exists($upload_path)) {
                File::makeDirectory($upload_path, $mode = 0777, true, true);
            }
            if(file_exists($row->categoryImage)){
                unlink($row->categoryImage);
            }
            $img = Image::make($photo)->resize(240,200);
            $image_url = $upload_path . '/' . $imageName;
            $img->save($image_url);
        }
        else{
            $image_url = $row->categoryImage;
        }
        $data = [
            'categoryName'          => $request->categoryName,
            'categoryImage'         => $image_url
        ];
        Category::where('id',$id)->update($data);
        return response()->json([
            'staus' => 200
        ]);
    }


    public function destroy($id)
    {
        $row = Category::findOrFail($id);
        if(file_exists($row->categoryImage)){
            unlink($row->categoryImage);
        }
        $row->delete();
        return response()->json([
            'staus' => 200
        ]);
    }
}
