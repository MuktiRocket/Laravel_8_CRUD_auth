<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MultiPicture;
use Carbon\Carbon;

class MultipicController extends Controller
{


    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function multipic()
    {
        $images = MultiPicture::all();
        return view('admin.multipic.index', compact('images'));
    }


    public function Storeimg(Request $request)
    {
        $validatedata = $request->validate(
            [
                'image' => 'required',
            ],
            [
                'image.required' => '*Please Upload Brand image',
            ]
        );

        $image = $request->file('image');

        foreach ($image as $multi_image) {

            $name_generate = hexdec(uniqid());
            $img_ext = strtolower($multi_image->getClientOriginalExtension());
            $img_name = $name_generate . '.' . $img_ext;
            $up_location = 'image/multi/';
            $last_img = $up_location . $img_name;
            $multi_image->move($up_location, $img_name);
            MultiPicture::insert([
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
        }
        return redirect()->back()->with('success', 'Brand Inserted Successfully !!');
    }
}
