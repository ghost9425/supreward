<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Complaints;
use App\Models\Prefix;
use phpDocumentor\Reflection\DocBlock\Tag;
use Storage;

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
    public function index(Request $request)
    {
        $search = $request->search;
        $query = Complaints::select('complaints.*');

        if( !empty($search) ) {
            $query->where( function($q) use ($search) {
                $q->where('complaints.name', 'LIKE', '%'.$search.'%')
                    ->orWhere('complaints.prefix', 'LIKE', '%'.$search.'%');
            });
        }

        $complaint = $query->get();

        return view('complaint.index', [
            'layout_page' => 'complaint',
            'complaint' => $complaint,
            'search' => $search
        ]);

    }

    public function listAjax(Request $request) {

        $search = $request->search;

        $query = Complaints::select('complaints.*', 'prefix.name AS prefix_name')
            ->join('prefix', 'prefix.id', 'complaints.prefix_id')
            ->orderBy('complaints.updated_at', 'DESC');
        if( !empty($search) ) {
            $query->where( function($q) use ($search) {
                $q->where('complaints.name', 'LIKE', '%'.$search.'%')
                ->orWhere('complaints.prefix', 'LIKE', '%'.$search.'%');
            });
        }

        $complaints = $query->get();

        if( count($complaints) > 0 ) {
            foreach($complaints as $key => $complaint) {
                $complaints[$key]->image = $complaint->image;
                if($complaints[$key]->image == '') {
                    $complaints[$key]->show_image =
                    "<a class ='Mitr' href ='img/no-image-available.png' width='100%' data-toggle='lightbox'>
                    <img src='img/no-image-available.png' width='50'";
                } else {
                $complaints[$key]->show_image =
                    "<a class ='Mitr' href ='img/complaints/".$complaint->image."' width='100%' data-toggle='lightbox'>
                        <img src='img/complaints/" . $complaint->image . "' width='50'";
                }

                $complaints[$key]->updated = date('d-m-Y H:i', strtotime($complaint->updated_at) );
                // $complaints[$key]->prefix =
            }
        }

        return response()->json([
            'status'=>1,
            'complaints'=>$complaints,
        ]);
    }

    public function ajaxDelete(Request $request) {
        $complaints = Complaints::where('id', $request->id)->first();

        if ($complaints->image === '') {
            $complaints->delete();
        }
        else if (!empty($complaints)) {
            $path = public_path('img/complaints/') . $complaints->image;
            if (file_exists($path)) {
                unlink($path);
            }
            $complaints->delete();
        }

        $complaints->delete();
        return response()->json([
            'status'=>1,
            'mgs' => 'Delete Complaints Success'
        ]);

    }

    public function add(Request $request) {

        $prefixs = Prefix::orderBy('id','ASC')->get();
        return view('complaint.add', [
            'layout_page' => 'complaint',
            'prefixs' => $prefixs
        ]);
    }

    public function edit(Request $request) {
        if( empty($request->id) ) {
            abort(404);
        }

        $complaints = Complaints::find($request->id);

        return view('complaint.edit', [
            'layout_page' => 'complaint',
            'complaints' => $complaints
        ]);

    }

    public function addSave(Request $request) {

        $complaints = new Complaints;
        $complaints->name = $request->name;
        $complaints->prefix_id = $request->prefix;
        $complaints->detaill = $request->detaill;
        // $null_path = 'no-image-available.png';
        // $default_image = public_path('img/').$null_path;

        // if( $request->hasFile('image') ) {
        $validate['image'] = ['mimes:jpeg,jpg,png,gif','max:3072'];
        // }

        $request->validate($validate);

        if( $request->hasFile('image') ) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('img/complaints/'),$filename);
            $complaints->image = $filename;
        } else {
            // return $request;
            $complaints->image = '';
        }

        $complaints->save();

        return response()->json([
            'status' => '1',
            'mgs' => 'Add Complaints Success'
        ]);
    }

    public function editSave(Request $request) {

        $complaints = Complaints::find($request->id);
        $complaints->detaill = $request->detaill;

        // if( $request->hasFile('image') ) {
            $validate['image'] = ['mimes:jpeg,jpg,png,gif','max:3072'];
        // }

        $request->validate($validate);

        if( $request->hasFile('image') ) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('img/complaints/'),$filename);
            $oldfilename = $complaints->image;

            $complaints->image = $filename;

            Storage::delete($oldfilename);
        }
        // else {
        //     return $request;
        //     $complaints->image = '';
        // }


        $complaints->save();

        return response()->json([
            'status' => '1',
            'mgs' => 'Edit Complaint Success'
        ]);
    }


}
