<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Complaints;
use App\Models\Prefix;
use App\Models\ComplaintsPrefixCollection;
use App\Models\CommonProblem;
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
        $query = Complaints::select('complaints.*', 'prefix.name AS prefix_name')
            ->leftjoin('prefix', 'prefix.id', 'complaints.prefix_id');

        if( !empty($search) ) {
            $query->where( function($q) use ($search) {
                $q->where('complaints.name', 'LIKE', '%'.$search.'%')
                    ->orWhere('prefix.name', 'LIKE', '%'.$search.'%');
            });
        }


        $complaint = $query->get();
        // dd($complaint);
        return view('complaint.index', [
            'layout_page' => 'complaint',
            'complaint' => $complaint,
            'search' => $search
        ]);

    }

    public function listAjax(Request $request) {

        $search = $request->search;

        $query = Complaints::select('complaints.*', 'prefix.name AS prefix_name', 'complants_prefix_collection.complaints_success AS complaints_status')
            ->join('prefix', 'prefix.id', 'complaints.prefix_id')
            ->join('complants_prefix_collection', 'complants_prefix_collection.complants_id', 'complaints.id')
            ->orderBy('complaints.updated_at', 'DESC')
            ->where('complants_prefix_collection.complaints_success', 0);
        if( !empty($search) ) {
            $query->where( function($q) use ($search) {
                $q->where('complaints.name', 'LIKE', '%'.$search.'%')
                ->orWhere('prefix.name', 'LIKE', '%'.$search.'%');
            });
        }
        $complaints = $query->get();

        if( count($complaints) > 0){
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
                $complaints[$key]->updated = date('d-m-Y', strtotime($complaint->updated_at) );

            }
        }
        // dd($complaints);

        return response()->json([
            'status'=>1,
            'complaints'=>$complaints,
        ]);
    }

// public function ajaxDelete(Request $request) {
//         $complaints = Complaints::where('id', $request->id)->first();
//         if ($complaints->image === '') {
//             $complaints->delete();
//         }
//         else if (!empty($complaints)) {
//             $path = public_path('img/complaints/') . $complaints->image;
//             if (file_exists($path)) {
//                 unlink($path);
//             }
//             $complaints->delete();
//         }
//         $complaints->delete();
//         return response()->json([
//             'status'=>1,
//             'mgs' => 'Delete Complaints Success'
//         ]);
// }

    public function add(Request $request) {

        $prefixs = Prefix::orderBy('id','ASC')->get();
        $problems = CommonProblem::orderBy('id','ASC')->get();

        return view('complaint.add', [
            'layout_page' => 'complaint',
            'prefixs' => $prefixs,
            'problems' => $problems
        ]);
    }

    public function edit(Request $request) {
        if( empty($request->id) ) {
            abort(404);
        }

        $complaints = Complaints::select('complaints.*', 'prefix.name AS prefix_name')
            ->join('prefix', function($join) {
                $join->on('prefix.id', 'complaints.prefix_id');
            })
            ->where( 'complaints.id', $request->id )
            ->first();
        $complaintsPrefixCollection = ComplaintsPrefixCollection::where('id', $request->id)->first();
        // dd($complaints);

        return view('complaint.edit', [
            'layout_page' => 'complaint',
            'complaints' => $complaints,
            'complaintsPrefixCollection' => $complaintsPrefixCollection,
        ]);

    }

    public function addSave(Request $request) {

        $complaints = new Complaints;
        $complaints->name = $request->name;
        $complaints->prefix_id = $request->prefix;
        $complaints->detail = $request->detail;
        // dd($request);
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
        // dd($complaints);
        $complaintsPrefixCollection = new ComplaintsPrefixCollection;
        $complaintsPrefixCollection->complants_id = $complaints->id;
        $complaintsPrefixCollection->prefix_id = $complaints->prefix_id;
        $complaintsPrefixCollection->complaints_success = '0';
        $complaintsPrefixCollection->save();
        // dd(prefix);
        return response()->json([
            'status' => '1',
            'mgs' => 'Add Complaints Success'
        ]);
    }

    public function editSave(Request $request) {

        $complaints = Complaints::find($request->id);
        $complaints->detail = $request->detail;

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

        $complaints->save();
        // dd($request);
        $complaintsPrefixCollection = ComplaintsPrefixCollection::find($request->id);
        $complaintsPrefixCollection->complaints_success = $request->status_complaints;
        $complaintsPrefixCollection->save();

        return response()->json([
            'status' => '1',
            'mgs' => 'Edit Complaint Success',
            'status_complaints' => intval($request->status_complaints)
        ]);
    }

}
