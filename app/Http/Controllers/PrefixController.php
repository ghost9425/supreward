<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Prefix;
use phpDocumentor\Reflection\DocBlock\Tag;
use Storage;

class PrefixController extends Controller
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

        return view('prefix.index', [
            'layout_page' => 'prefix'
        ]);

    }

    public function listAjax(Request $request) {

        $search = $request->search;

        $query = Prefix::select('prefix.*')
            ->orderBy('prefix.created_at', 'ASC');
        if( !empty($search) ) {
            $query->where( function($q) use ($search) {
                $q->where('prefix.name', 'LIKE', '%'.$search.'%');
            });
        }

        $prefixs = $query->get();

        if( count($prefixs) > 0 ) {
            foreach($prefixs as $key => $prefix) {
                $prefixs[$key]->created = date('d-m-Y H:i', strtotime($prefix->created_at) );
            }
        }

        return response()->json([
            'status'=>1,
            'prefixs'=>$prefixs,
        ]);
    }

    // public function ajaxDelete(Request $request) {
    //     $complaints = Complaints::where('id', $request->id)->first();

    //     if ($complaints->image === '') {
    //         $complaints->delete();
    //     }
    //     else if (!empty($complaints)) {
    //         $path = public_path('img/complaints/') . $complaints->image;
    //         if (file_exists($path)) {
    //             unlink($path);
    //         }
    //         $complaints->delete();
    //     }

    //     $complaints->delete();
    //     return response()->json([
    //         'status'=>1,
    //         'mgs' => 'Delete Complaints Success'
    //     ]);

    // }

    public function add(Request $request) {

        return view('prefix.add', [
            'layout_page' => 'prefix'
        ]);
    }

    public function edit(Request $request) {
        if( empty($request->id) ) {
            abort(404);
        }

        $prefix = Prefix::find($request->id);

        return view('prefix.edit', [
            'layout_page' => 'prefix',
            'prefix' => $prefix
        ]);

    }

    public function addSave(Request $request) {

        $prefix = new Prefix;
        $prefix->name = strtoupper($request->name);

        $validate['name'] = ['required', 'string', 'min:2'];

        $request->validate($validate);

        $prefix->save();

        return response()->json([
            'status' => '1',
            'mgs' => 'Add Prefix Success'
        ]);
    }

    public function editSave(Request $request) {

        $prefix = Prefix::find($request->id);
        $prefix->name = strtoupper($request->name);

        $validate['name'] = ['required', 'string', 'min:2'];

        $request->validate($validate);

        $prefix->save();

        return response()->json([
            'status' => '1',
            'mgs' => 'Edit Prefix Success'
        ]);
    }


}
