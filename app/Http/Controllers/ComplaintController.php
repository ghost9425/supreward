<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Complaints;

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

    public function add(Request $request) {

        return view('complaint.add', [
            'layout_page' => 'complaint'
        ]);
    }

    public function addSave(Request $request) {

        $complaints = new Complaints;
        $complaints->name = $request->name;
        // $user->password = Hash::make($request->password);
        $complaints->prefix = $request->prefix;
        $complaints->detaill = $request->detaill;
        // $complaints->image = null;
        // dd($complaints->image);
        // if( $auth->permission_id == 1 ) {
        //     $user->permission_id = (isset($request->permission))?$request->permission:'3';
        // } else if( $auth->permission_id == 2 ) {
        //     $user->permission_id = '3';
        // } else {
        //     $user->permission_id = '4';
        // }
        $complaints->save();

        return response()->json([
            'status' => '1',
            'mgs' => 'Add Complaints Success'
        ]);
    }
}
