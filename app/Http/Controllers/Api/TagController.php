<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Model\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::all();
        return response()->json([
            'tags' => $tags
        ],200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tagName'        => 'required|unique:tags'
        ]);
        $data = [
            'tagName'          => $request->tagName
        ];
        Tag::create($data);
        return response()->json([
            'staus' => 200
        ]);
    }


    public function show($id)
    {
        $row = Tag::findOrFail($id);
        return response()->json(['row' => $row]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tagName'   => 'required|unique:tags,tagName,'.$id,
        ]);
        $row = Tag::findOrFail($id);

        $data = [
            'tagName'          => $request->tagName
        ];
        Tag::where('id',$id)->update($data);
        return response()->json([
            'staus' => 200
        ]);
    }

    public function destroy($id)
    {
        $row = Tag::findOrFail($id);
        $row->delete();
        return response()->json([
            'staus' => 200
        ]);
    }
}
