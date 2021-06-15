<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComplaintsPrefixCollection;

class ReportController extends Controller
{
    public function index(Request $request)
    {

        $complaints_status = ComplaintsPrefixCollection::orderBy('id','ASC')->get();

        return view('report.index', [
            'layout_page' => 'report',
            'complaints_status' => $complaints_status
        ]);

    }

    public function listAjax(Request $request) {

        $search = $request->search;
        $search2 = $request->status_complaints;
        // $company_name = $request->company_name;
        // $nickname = $request->nickname;
        // dd($search);
        $query = ComplaintsPrefixCollection::select('complants_prefix_collection.*',
        'complaints.name AS complaints_name','complaints.detail AS complaints_detail','prefix.name AS prefix_name')
            ->join('complaints', 'complaints.id', 'complants_prefix_collection.complants_id')
            ->join('prefix', 'prefix.id', 'complants_prefix_collection.prefix_id')
            ->orderBy('complants_prefix_collection.updated_at', 'DESC');
            // dd($search2);
            if (($search2 == 0 || $search2 == 1) ){
                // dd($search2);
                $query->where( function($q) use ($search2) {
                    $q->where('complants_prefix_collection.complaints_success', 'LIKE', '%'.$search2.'%');
                });
            }

        // dd($query);
        // $complaints_status = ComplaintsPrefixCollection::orderBy('id','ASC')->get();
        // dd($search);
        if( ($search != '') ) {
            $query->where( function($q) use ($search) {
                $q->where('complaints.name', 'LIKE', '%'.$search.'%')
                ->orWhere('prefix.name', 'LIKE', '%'.$search.'%');
                // ->orWhere('complaints.name', 'LIKE', '%'.$search.'%');
            });
        }

        $reports = $query->get();
        // dd($reports);
        if( count($reports) > 0 ) {
            foreach($reports as $key => $report) {

                // $complaints[$key]->image = $complaint->image;
                // if($complaints[$key]->image == '') {
                //     $complaints[$key]->show_image =
                //     "<a class ='Mitr' href ='img/no-image-available.png' width='100%' data-toggle='lightbox'>
                //     <img src='img/no-image-available.png' width='50'";
                // } else {
                // $complaints[$key]->show_image =
                //     "<a class ='Mitr' href ='img/complaints/".$complaint->image."' width='100%' data-toggle='lightbox'>
                //         <img src='img/complaints/" . $complaint->image . "' width='50'";
                // }
                // if($reports[$key]->complaints_success == 1){
                //     $report->complaints_success = "Success";
                // } else {
                //     $report->complaints_success = "Pending";
                // }
                $reports[$key]->updated = date('d-m-Y H:i', strtotime($report->updated_at) );

            }
        }
        // dd($reports);
        return response()->json([
            'status'=>1,
            'reports'=>$reports

        ]);
    }

}
