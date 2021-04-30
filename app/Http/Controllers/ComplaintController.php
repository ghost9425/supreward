<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Complaints;
// use Image;

class ComplaintController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('complaint.index', [
            'layout_page' => 'company'
        ]);
    }

    public function listAjax(Request $request) {

        $query = Complaints::select('complaints.*', 'complaints.prefix AS c_prefix')
            ->orderBy('complaints.created_at', 'DESC');
        $complaints = $query->get();
        if( count($complaints) > 0 ) {
            foreach($complaints as $key => $complaint) {
                $complaints[$key]->image = $complaint->image;
                $complaints[$key]->show_image = "<img src='img/complaints/" . $complaint->image . "' width='50'>";
                $complaints[$key]->updated = date('d/m/Y H:i', strtotime($complaint->updated_at) );
            }
        }
        // if( count($complaints) > 0 ) {
        //     foreach($complaints as $key => $complaint) {
        //         $show_image =

        //         "<a href = '".get_path_no_image()."' width='100%' data-toggle='lightbox' data-title='".$complaint->name."'>
        //         <img src='".get_path_no_image()."' width='50'></a>";
        //         // "<img src='".get_path_no_image()."' width='50' data-toggle='lightbox'>";
        //         if( !empty($complaint->image) ) {
        //             $show_image =
        //             "<a class ='Mitr' href ='".asset($complaint->image)."' width='100%' data-toggle='lightbox' data-title='".$complaint->name."'>
        //             <img class ='Mitr' src='".asset($complaint->image)."' width='50'></a>";
        //         }
        //         $complaints[$key]->show_image = "<div class='text-center'>".$show_image."</div>";
        //     }
        // }

        return response()->json([
            'status'=>1,
            'complaints'=>$complaints,
        ]);
    }

    // public function ajaxGet(Request $request) {

    //     $complaints = Complaints::find($request->id);
    //     if( !empty($complaints->image) ) {
    //         $complaints->show_images = asset($complaints->image);
    //     }

    //     return response($complaints);
    // }

    public function add(Request $request) {

        return view('complaint.add', [
            'layout_page' => 'complaint'
        ]);
    }

    public function edit(Request $request) {
        if( empty($request->id) ) {
            abort(404);
        }

        $complaints = Complaints::find($request->id);
        // $user = User::find($request->id);
        // $permissions = Permission::orderBy('id','ASC')->limit(3)->get();

        return view('complaint.edit', [
            'layout_page' => 'complaint',
            // 'auth' => $auth,
            'complaints' => $complaints
            // 'permissions' => $permissions
        ]);

    }

    public function addSave(Request $request) {

        $complaints = new Complaints;
        $complaints->name = $request->name;
        $complaints->prefix = $request->prefix;
        $complaints->detaill = $request->detaill;
        // $complaints->image = $image_path;

        if( $request->hasFile('image') ) {
            $validate['image'] = ['mimes:jpeg,jpg,png,gif','max:3072'];
        }

        $request->validate($validate);

        if( $request->hasFile('image') ) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('img/complaints/',$filename);
            $complaints->image = $filename;
        } else {
            return $request;
            $complaints->image = '';
        }

        $complaints->save();

        return response()->json([
            'status' => '1',
            'mgs' => 'Add Complaints Success'
        ]);
    }

    public function editSave(Request $request) {

        // $complaints = Complaints::find($request->id);
        // $complaints->prefix = $request->prefix;

        // if( $request->hasFile('image') ) {
        //     $validate['image'] = ['mimes:jpeg,jpg,png,gif','max:3072'];
        // }

        // $request->validate($validate);

        // if( $request->hasFile('image') ) {
        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $extension;
        //     $file->move('img/complaints/',$filename);
        //     $complaints->image = $filename;
        // } else {
        //     return $request;
        //     $complaints->image = '';
        // }
            // dd($complaints);
        // $complaints->save();

        // return response()->json([
        //     'status' => '1',
        //     'mgs' => 'Edit Complaint Success'
        // ]);
    }


}
