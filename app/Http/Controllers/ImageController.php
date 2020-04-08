<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Image;
use App\ImageModel;
use DB;
use Response;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function resizeImage()
    {
        $images = DB::table('tb_images')->get();
        // return $images;
        return view('imagesView.resizeImage', compact('images'));
    }

    public function newImageShow(){
        // return view('imagesView.imageNew');
        return view('imagesView.ajaxImageTool');
    }

    public function resizeImagePost(Request $request)
    {
        $rules = array('image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048');
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return Response::json(array(
                'success' => 'errorValidate',
                'errors' => $validator->getMessageBag()->toArray()
            )); // 400 being the HTTP code for an invalid request.
        }

        $image = $request->file('image');
        $input['imagename'] = $image->getClientOriginalName().time().'.'.$image->extension();

        $destinationPath = public_path('/thumbnail');
        $img = Image::make($image->path());
        $img->resize(120, 120, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);

        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);

        $image = new ImageModel;
        $image->url = $input['imagename'];
        // $image->title = $request->title;
        $image->save();

        $alert[] = array(
          'success'=>"success",
          'msg'=>"Амжилттай хадгаллаа!!!"
        );
        return Response::json($alert);
    }
}
