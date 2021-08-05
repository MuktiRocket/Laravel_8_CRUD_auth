<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CatagoryController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }


    public function AllCat()
    {
        // $catagories = DB::table('catagories')
        //     ->join('users', 'catagories.user_id', 'users.id')
        //     ->select('catagories.*', 'users.name')
        //     ->latest()->paginate(5);
        $catagories = Catagory::latest()->paginate(5);
        // $catagories = DB::table('catagories')->latest()->paginate(5);
        $trashcat = Catagory::onlyTrashed()->latest()->paginate(3);

        return view('admin.catagory.index', compact('catagories', 'trashcat'));
    }


    public function AddCat(Request $request)
    {

        $validatedata = $request->validate([
            'catagory' => 'required|unique:catagories|max:255',
        ]);

        Catagory::insert([
            'catagory' => $request->catagory,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);


        // $catagory = new Catagory;
        // $catagory->catagory = $request->catagory;
        // $catagory->user_id = Auth::user()->id;
        // $catagory->save();


        return redirect()->back()->with('success', 'Catagory Inserted Successfully !!');
    }





    public function edit($id)
    {
        // $catagories = Catagory::find($id);
        $catagories = DB::table('catagories')->where('id', $id)->first();
        return view('admin.catagory.edit', compact('catagories'));
    }



    public function update(Request $request, $id)
    {
        // $update = Catagory::find($id)->update([
        //     'catagory' => $request->catagory,
        //     'user_id' => Auth::user()->id,
        // ]);

        $data = array();
        $data['catagory'] = $request->catagory;
        $data['user_id'] = Auth::user()->id;
        DB::table('catagories')->where('id', $id)->update($data);

        return redirect()->route('all.catagory')->with('success', 'Catagory Updated Successfully !!');
    }

    public function softdelete($id)
    {
        $delete = Catagory::find($id)->delete();
        return redirect()->back()->with('success', 'Catagory Soft Deleted Successfully !!');
    }


    public function restore($id)
    {
        $restore = Catagory::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success', 'Catagory Restored Successfully !!');
    }




    public function pdelete($id)
    {
        $pdelete = Catagory::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success', 'Catagory Permanently Deleted !!');
    }
}
