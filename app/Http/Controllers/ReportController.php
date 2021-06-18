<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComplaintsPrefixCollection;

class ReportController extends Controller
{
    public function index(Request $request)
    {

        // $complaints_status = ComplaintsPrefixCollection::orderBy('id','ASC')->get();

        $today = date('Y-m-d');
        $startdate = $today;
        $todate = $today;

        // $date_now = date('d-m-Y');
        // $date_select = $request->sort_datetime;
        // if( empty($date_select) ) {
        //     $date_select = $date_now;
        // }
        // $dateArray = explode('-', $date_select);
        // $date_select_query = $dateArray[2]. '-' .$dateArray[1] .'-'. $dateArray[0];

        return view('report.index', [
            'layout_page' => 'report',
            'today' => $today,
            'startdate' => $startdate,
            'todate' => $todate,
            // 'date_select' => $date_select,
            // 'date_select_query' => $date_select_query,
            // 'complaints_status' => $complaints_status
        ]);

    }

    public function listAjax(Request $request) {

        $search = $request->search;
        $search2 = $request->status_complaints;

        $startdate = $request->startdate;
        $todate = $request->todate;
        $sort_datetime = $request->sort_datetime;

        $today =  date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime("-1 days"));
        $lastmonth = date('m', strtotime("-1 month"));;
        // dd($yesterday);

        if( $request->sort_datetime) {
            $date_array = $this->getDateLength( $sort_datetime,$startdate, $todate);
            $startdate = $date_array['startdate'];
            $todate = $date_array['todate'];
        }

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

        if (($sort_datetime == 0)) {
            $query->where( function($q) use ($today) {
                $q->where('complants_prefix_collection.updated_at', 'LIKE', '%'.$today.'%');
            });
        } else if (($sort_datetime == 1)) {
            $query->where( function($q) use ($yesterday) {
                $q->where('complants_prefix_collection.updated_at', 'LIKE', '%'.$yesterday.'%');
            });
        } else if (($sort_datetime == 2)) {
            $query->where( function($q) use ($lastmonth) {
                $q->where('complants_prefix_collection.updated_at', 'LIKE', '%'.$lastmonth.'%');
            });
        } else {

        }


        if( ($search != '') ) {
            $query->where( function($q) use ($search) {
                $q->where('complaints.name', 'LIKE', '%'.$search.'%')
                ->orWhere('prefix.name', 'LIKE', '%'.$search.'%');
            });
        }

        $reports = $query->get();
        // dd($reports);
        if( count($reports) > 0 ) {
            foreach($reports as $key => $report) {

                if($reports[$key]->complaints_success == 1){
                    $report->complaints_success = "Success";
                } else {
                    $report->complaints_success = "Pending";
                }
                $reports[$key]->updated = date('d-m-Y H:i', strtotime($report->updated_at) );

            }
        }
        // dd($reports);
        return response()->json([
            'status'=>1,
            'reports'=>$reports,
            'startdate' => $startdate,
            'todate' => $todate

        ]);
    }

    private function getDateLength( $sort_datetime,$startdate, $todate) {
        $today = date('Y-m-d');
        if( empty($date_previous_next) ) {
            // if( $date_action == 'today' ) {
            if( $sort_datetime == 0 ) {
                $startdate = $today;
                $todate = $today;
            // } else if( $date_action == 'yesterday' ) {
            } else if( $sort_datetime == 1 ) {
                $startdate = date('Y-m-d' ,strtotime(' -1 DAY', strtotime($today)) );
                $todate = $startdate;
            }
            // } else if( $date_action == 'this_week' ) {
            //     if (date('D') == 'Tue') {
            //         $firstday = date('Y-m-d');
            //         $date = date('Y-m-d');
            //     } else {
            //         $firstday = date('Y-m-d', strtotime("last Tuesday"));
            //         $date = date('Y-m-d', strtotime("last Tuesday"));
            //     }
            //     $date = strtotime($date);
            //     $date = strtotime("+6 day", $date);
            //     $lastday = date('Y-m-d', $date);
            //     $startdate = $firstday;
            //     $todate = $lastday;

            // } else if( $date_action == 'last_week' ) {
            //     if (date('D') == 'Tue') {
            //         $firstday = date('Y-m-d', strtotime("last Tuesday"));
            //         $date = date('Y-m-d', strtotime("last Tuesday"));
            //     } else {
            //         $firstday = date('Y-m-d', strtotime("last Tuesday"));
            //         $date = date('Y-m-d', strtotime("last Tuesday"));
            //         $date = strtotime($date);
            //         $date = strtotime("-7 day", $date);
            //         $firstday = date('Y-m-d', $date);
            //     }
            //     $date = strtotime("+6 day", $date);
            //     $lastday = date('Y-m-d', $date);
            //     $startdate = $firstday;
            //     $todate = $lastday;
            // } else if( $date_action == 'this_month' ) {
            //     $startdate = date('Y-m-01');
            //     $todate = date('Y-m-t');
            // } else if( $date_action == 'last_month' ) {
            else if( $sort_datetime == 2 ) {
                $startdate = date('Y-m-01', strtotime("-1 month"));
                $todate = date('Y-m-t', strtotime("-1 month"));
            }
        } else {
            $startdate = strtotime($startdate);
            $todate = strtotime($todate);

            // if( $date_previous_next == 'next' ) {
            //     if( $date_action == 'today' ) {
            //         $startdate = date('Y-m-d', strtotime('+1 Day', $startdate) );
            //         $todate = $startdate;
            //     } else if( $date_action == 'yesterday' ) {
            //         $startdate = date('Y-m-d', strtotime('+1 Day', $startdate) );
            //         $todate = $startdate;
            //     } else if( $date_action == 'this_week' ) {

            //         $select_date = date('Y-m-d', $startdate);
            //         $get_day = date('D', strtotime($select_date) );

            //         $select_new_date = strtotime( '+1 day', strtotime($select_date) ) ;

            //         if( $get_day == 'Tue' ) {
            //             $get_tuesday = date('Y-m-d', strtotime( 'last tuesday', $select_new_date) );
            //             $get_monday = date('Y-m-d', strtotime( 'next monday', strtotime($select_date) ) );
            //         } else {
            //             $get_tuesday = date('Y-m-d', strtotime( 'last tuesday', strtotime($select_date) ) );
            //             $get_monday = date('Y-m-d', strtotime( 'next monday', strtotime($select_date) ) );
            //         }
            //         $startdate = date('Y-m-d', strtotime('+7 Day', strtotime($get_tuesday) ) );
            //         $todate = date('Y-m-d', strtotime('+7 Day', strtotime($get_monday) ) );

            //     } else if( $date_action == 'last_week' ) {
            //         $select_date = date('Y-m-d', $startdate);
            //         $get_day = date('D', strtotime($select_date) );

            //         $select_new_date = strtotime( '+1 day', strtotime($select_date) ) ;

            //         if( $get_day == 'Tue' ) {
            //             $get_tuesday = date('Y-m-d', strtotime( 'last tuesday', $select_new_date) );
            //             $get_monday = date('Y-m-d', strtotime( 'next monday', strtotime($select_date) ) );
            //         } else {
            //             $get_tuesday = date('Y-m-d', strtotime( 'last tuesday', strtotime($select_date) ) );
            //             $get_monday = date('Y-m-d', strtotime( 'next monday', strtotime($select_date) ) );
            //         }
            //         $startdate = date('Y-m-d', strtotime('+7 Day', strtotime($get_tuesday) ) );
            //         $todate = date('Y-m-d', strtotime('+7 Day', strtotime($get_monday) ) );
            //     } else if( $date_action == 'this_month' ) {
            //         $select_date = date('Y-m-01', $startdate);
            //         $startdate = date('Y-m-01', strtotime('+1 Month', strtotime($select_date) ) );
            //         $todate = date('Y-m-t', strtotime('+1 Month', strtotime($select_date) ) );
            //     } else if( $date_action == 'last_month' ) {
            //         $select_date = date('Y-m-01', $startdate);
            //         $startdate = date('Y-m-01', strtotime('+1 Month', strtotime($select_date) ) );
            //         $todate = date('Y-m-t', strtotime('+1 Month', strtotime($select_date) ) );
            //     }
            // } else if( $date_previous_next == 'previous' ) {
            //     if( $date_action == 'today' ) {
            //         $startdate = date('Y-m-d', strtotime('-1 Day', $startdate) );
            //         $todate = $startdate;
            //     } else if( $date_action == 'yesterday' ) {
            //         $startdate = date('Y-m-d', strtotime('-1 Day', $startdate) );
            //         $todate = $startdate;
            //     } else if( $date_action == 'this_week' ) {
            //         $select_date = date('Y-m-d', $startdate);
            //         $get_day = date('D', strtotime($select_date) );

            //         $select_new_date = strtotime( '+1 day', strtotime($select_date) ) ;

            //         if( $get_day == 'Tue' ) {
            //             $get_tuesday = date('Y-m-d', strtotime( 'last tuesday', $select_new_date) );
            //             $get_monday = date('Y-m-d', strtotime( 'next monday', strtotime($select_date) ) );
            //         } else {
            //             $get_tuesday = date('Y-m-d', strtotime( 'last tuesday', strtotime($select_date) ) );
            //             $get_monday = date('Y-m-d', strtotime( 'next monday', strtotime($select_date) ) );
            //         }
            //         $startdate = date('Y-m-d', strtotime('-7 Day', strtotime($get_tuesday) ) );
            //         $todate = date('Y-m-d', strtotime('-7 Day', strtotime($get_monday) ) );

            //     } else if( $date_action == 'last_week' ) {
            //         $select_date = date('Y-m-d', $startdate);
            //         $get_day = date('D', strtotime($select_date) );

            //         $select_new_date = strtotime( '+1 day', strtotime($select_date) ) ;

            //         if( $get_day == 'Tue' ) {
            //             $get_tuesday = date('Y-m-d', strtotime( 'last tuesday', $select_new_date) );
            //             $get_monday = date('Y-m-d', strtotime( 'next monday', strtotime($select_date) ) );
            //         } else {
            //             $get_tuesday = date('Y-m-d', strtotime( 'last tuesday', strtotime($select_date) ) );
            //             $get_monday = date('Y-m-d', strtotime( 'next monday', strtotime($select_date) ) );
            //         }
            //         $startdate = date('Y-m-d', strtotime('-7 Day', strtotime($get_tuesday) ) );
            //         $todate = date('Y-m-d', strtotime('-7 Day', strtotime($get_monday) ) );
            //     } else if( $date_action == 'this_month' ) {
            //         $select_date = date('Y-m-01', $startdate);
            //         $startdate = date('Y-m-01', strtotime('+1 Month', strtotime($select_date) ) );
            //         $todate = date('Y-m-t', strtotime('+1 Month', strtotime($select_date) ) );
            //     } else if( $date_action == 'last_month' ) {
            //         $select_date = date('Y-m-01', $startdate);
            //         $startdate = date('Y-m-01', strtotime('-1 Month', strtotime($select_date) ) );
            //         $todate = date('Y-m-t', strtotime('-1 Month', strtotime($select_date) ) );
            //     }
            // }

        }

        return [
            'startdate' => $startdate,
            'todate' => $todate
        ];

    }

}
