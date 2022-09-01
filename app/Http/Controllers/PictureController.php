<?php

namespace App\Http\Controllers;

use App\Http\Requests\PictureRequest;
use App\Models\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pictures = Picture::all();
        return response()->json($pictures);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PictureRequest $request)
    {
        $picture = Picture::create([
                        'title' => $request->title,
                        'description' => $request->description,
                        'image' => $request->image,
                    ]);

        return response()->json($picture);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Picture $picture)
    {
        $picture = Picture::findOrFail($picture->id);
        return response()->json($picture);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PictureRequest $request, Picture $picture)
    {
        $picture = Picture::findOrFail($picture->id);
        $picture->title = $request->title;
        $picture->description = $request->description;
        $picture->image = $request->image;
        $picture->save();

        return response()->json($picture);
    }


    /**
     * Search for a picture.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function search(string $name) {
        $picture = Picture::where('title','like', '%'.$name.'%')->get();
        return response()->json($picture);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $picture = Picture::findOrFail($id);

        if ($picture->delete()) {
            return response()->json("Picture deleted successfully");
        }
    }
}
