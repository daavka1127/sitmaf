<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Image;
use App\ImageModel;
use DB;

class ImageController extends Controller
{
    public function resizeImage()
    {
        $images = DB::table('tb_images')->get();
        return view('imagesView.resizeImage', compact('images'));
    }

    public function newImageShow(){
        return view('imagesView.imageNew');
    }

    public function resizeImagePost(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $input['imagename'] = time().'.'.$image->extension();

        $destinationPath = public_path('/thumbnail');
        $img = Image::make($image->path());
        $img->resize(120, 120, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);

        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);

        $image = new ImageModel;
        $image->url = $input['imagename'];
        $image->title = $request->title;
        $image->save();

        return back()
            ->with('success','Image Upload successful')
            ->with('imageName',$input['imagename']);
    }
}
