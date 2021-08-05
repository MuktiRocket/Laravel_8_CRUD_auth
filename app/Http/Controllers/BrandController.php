<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }


    public function allBrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }


    public function StoreBrand(StoreBrandRequest $request)
    {
        // $validatedata = $request->validate(
        //     [
        //         'brand_name' => 'required|unique:brands|max:20',
        //         'brand_image' => 'required|mimes:jpg,jpeg,png',

        //     ],
        //     [
        //         'brand_name.required' => '*Please input Brand Name',
        //         'brand_name.max' => '*Brand Name Should Be Less Than 20 Characters',
        //         'brand_image.required' => '*Please Upload Brand image',
        //     ]
        // );

        $brand_image = $request->file('brand_image');
        $name_generate = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_generate . '.' . $img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location . $img_name;
        $brand_image->move($up_location, $img_name);
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Brand Inserted Successfully !!');
    }



    public function edit($id)
    {
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));
    }



    public function update(Request $request, $id)
    {
        $validatedata = $request->validate(
            [
                'brand_name' => 'required|max:20',

            ],
            [
                'brand_name.required' => '*Please input Brand Name',
                'brand_name.max' => '*Brand Name Should Be Less Than 20 Characters',
            ]
        );

        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');

        if ($brand_image) {
            $name_generate = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_generate . '.' . $img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location . $img_name;
            $brand_image->move($up_location, $img_name);
            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now()
            ]);

            return redirect()->back()->with('success', 'Brand Updated Successfully !!');
        } else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);

            return redirect()->back()->with('success', 'Brand Updated Successfully !!');
        }
    }



    public function delete($id)
    {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        Brand::find($id)->delete();
        return redirect()->back()->with('success', 'Brand Deleted Successfully !!');
    }
}
