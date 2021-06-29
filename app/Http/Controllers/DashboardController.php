<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ComplaintsPrefixCollection;
use App\Models\Complaints;
use App\Models\Prefix;

use function PHPUnit\Framework\isEmpty;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $lastyear = date('Y', strtotime("-1 year"));
        $lastmonth = date('Y-m', strtotime("-1 month"));
        $yesterday = date('Y-m-d', strtotime("-1 days"));
        $today = date("Y-m-d");
        $thismonth = date('Y-m');
        $thisyear = date("Y");

        // dd($showdatenow);
        // dd($lastyear,
        // $lastmonth,
        // $yesterday,
        // $today,
        // $thismonth,
        // $thisyear);

        $count_today = DB::table('complants_prefix_collection')
        ->select(DB::raw('count(complants_prefix_collection.date) as count_today'))
        ->where('complants_prefix_collection.date', $today)
        ->first();

        $count_thismonth = DB::table('complants_prefix_collection')
        ->select(DB::raw('count(complants_prefix_collection.date) as count_thismonth'))
        ->where('complants_prefix_collection.date','LIKE', '%'.$thismonth.'%')
        ->first();

        $count_thisyear = DB::table('complants_prefix_collection')
        ->select(DB::raw('count(complants_prefix_collection.date) as count_thisyear'))
        ->where('complants_prefix_collection.date','LIKE', '%'.$thisyear.'%')
        ->first();
        // dd($count);

        // $month_format = DB::raw( "DATE_FORMAT(complants_prefix_collection.date, '%Y-%m')" );
        $count_yesterday = DB::table('complants_prefix_collection')
        ->select(DB::raw('count(complants_prefix_collection.date) as count_yesterday'))
        ->where('complants_prefix_collection.date', $yesterday)
        ->first();

        $count_lastmonth = DB::table('complants_prefix_collection')
        ->select(DB::raw('count(complants_prefix_collection.date) as count_lastmonth'))
        ->where('complants_prefix_collection.date','LIKE', '%'.$lastmonth.'%')
        ->first();

        $count_lastyear = DB::table('complants_prefix_collection')
        ->select(DB::raw('count(complants_prefix_collection.date) as count_lastyear'))
        ->where('complants_prefix_collection.date','LIKE', '%'.$lastyear.'%')
        ->first();

        // dd($count_thisyear,$count_lastyear);

        $count_prefix = DB::table('prefix')
        ->select(DB::raw('count(prefix.id) as count_all_prefix'))
        ->first();
        // dd($count_prefix);

        // dd($countsum_prefix[0]);
        // ->where('complants_prefix_collection.complaints_success', 0);

        $prefixs = Prefix::orderBy('id','ASC')->get();

        return view('dashboard.index', [
            'layout_page' => 'dashboard',
            'allprefix' => $count_prefix,
            'prefixs' => $prefixs,
            'count_lastyear' => $count_lastyear->count_lastyear,
            'count_lastmonth' => $count_lastmonth->count_lastmonth,
            'count_yesterday' => $count_yesterday->count_yesterday,
            'count_today' => $count_today->count_today,
            'count_thismonth' => $count_thismonth->count_thismonth,
            'count_thisyear' => $count_thisyear->count_thisyear,
        ]);
    }

    public function listAjax(Request $request) {

        $today=date("Y-m-d");
        $showdatenow = date("Y-m-d h:i:s");

        $count_pending_dailys = DB::table('complants_prefix_collection')
        ->join('complaints','complaints.id','complants_prefix_collection.complants_id')
        ->select('complants_prefix_collection.complaints_success',DB::raw('count(complants_prefix_collection.complaints_success) as count_pending'))
        ->where('complants_prefix_collection.complaints_success',0)
        ->where('complants_prefix_collection.date',$today)
        ->groupBy('complants_prefix_collection.complaints_success')
        ->first();
        // dd($count_pending_dailys);

        $count_success_dailys = DB::table('complants_prefix_collection')
        ->join('complaints','complaints.id','complants_prefix_collection.complants_id')
        ->select('complants_prefix_collection.complaints_success',DB::raw('count(complants_prefix_collection.complaints_success) as count_success'))
        ->where('complants_prefix_collection.complaints_success',1)
        ->where('complants_prefix_collection.date',$today)
        ->groupBy('complants_prefix_collection.complaints_success')
        ->first();

        $count_today = DB::table('complants_prefix_collection')
        ->select('complants_prefix_collection.date',DB::raw('count(complants_prefix_collection.date) as count_all'))
        ->where('complants_prefix_collection.date',$today)
        ->groupBy('complants_prefix_collection.date')
        ->first();

        $filter_prefix = $request->sort_prefix;
        $sort_prefix = DB::table('complants_prefix_collection')
        ->select('complants_prefix_collection.prefix_id',DB::raw('count(complants_prefix_collection.prefix_id) as count_all'))
        ->where('complants_prefix_collection.prefix_id',$filter_prefix)
        ->groupBy('complants_prefix_collection.prefix_id')
        ->first();
        // if ($request->sort_prefix==0) {
        //     $sort_prefix->where();
        // }
        // dd($sort_prefix);
        // dd($count_pending_dailys,$count_success_dailys);

        $countsum_prefix = DB::table('complants_prefix_collection')
        ->select('complants_prefix_collection.prefix_id', 'prefix.name',DB::raw('count(complants_prefix_collection.prefix_id) as y'))
        ->join('prefix', 'prefix.id', 'complants_prefix_collection.prefix_id')
        ->groupBy('prefix.name')
        ->orderBy('y','DESC','complants_prefix_collection.date','ASC')
        ->get();

        $count_case = DB::table('complants_prefix_collection')
        ->select(DB::raw('count(complants_prefix_collection.id) as count_all_case'))
        ->first();

        return response()->json([
            'status' => '1',
            'count_pending_dailys' => $count_pending_dailys==null?0:$count_pending_dailys,
            'count_success_dailys' => $count_success_dailys==null?0:$count_success_dailys,
            'count_today' => $count_today==null?0:$count_today,
            'sort_prefix' => $sort_prefix==null?0:$sort_prefix,
            'count_case' => $count_case->count_all_case,
            'show_date' => $showdatenow,
            'countsum_prefix' => $countsum_prefix==isEmpty()?0:$countsum_prefix,
        ]);
    }

    public function getResultAjax(Request $request) {

        // $text_chart = date('F Y');
        // $days = date('t');
        // $month = date('m');
        // $year = date('Y');
        // $year_month = date('Y-m');

        // $today = date('Y-m-d');
        // $tomorrow = date('Y-m-d', strtotime('-1 day'));

        // $sum_profit = DB::raw("SUM(transaction_product_dailys.profit) AS sum_profit");
        // $month_format = DB::raw( "DATE_FORMAT(transaction_dailys.date, '%Y-%m')" );

        // $lastMonth_year_month = date('Y-m', strtotime('-1 month', strtotime($year_month)) );
        // $lastMonth_days = date( 't', strtotime($lastMonth_year_month) );

        // $transactionToday = TransactionDaily::select('transaction_dailys.id', 'transaction_dailys.date', $sum_profit )
        //     ->join('transaction_product_dailys', 'transaction_product_dailys.transaction_daily_id', 'transaction_dailys.id' )
        //     ->where('transaction_dailys.date', $today )
        //     ->first();

        // $transactionTomorrow = TransactionDaily::select('transaction_dailys.id', 'transaction_dailys.date', $sum_profit )
        //     ->join('transaction_product_dailys', 'transaction_product_dailys.transaction_daily_id', 'transaction_dailys.id' )
        //     ->where('transaction_dailys.date', $tomorrow )
        //     ->first();

        // $transactionMonth = TransactionDaily::select('transaction_dailys.id', 'transaction_dailys.date', $sum_profit )
        //     ->join('transaction_product_dailys', 'transaction_product_dailys.transaction_daily_id', 'transaction_dailys.id' )
        //     ->where($month_format, $year_month)
        //     ->first();

        // $transactionLastMonth = TransactionDaily::select('transaction_dailys.id', 'transaction_dailys.date', $sum_profit )
        //     ->join('transaction_product_dailys', 'transaction_product_dailys.transaction_daily_id', 'transaction_dailys.id' )
        //     ->where($month_format, $lastMonth_year_month)
        //     ->first();

        // // start this month
        // for( $i=0; $i<$days; $i++ ) {
        //     $select_date = date('Y-m-d', strtotime( '+' . $i . ' Day', strtotime($year_month) ) );
        //     $dayData[$i] = $i+1;

        //     $transactions = TransactionDaily::select('transaction_dailys.id', 'transaction_dailys.date', $sum_profit )
        //         ->join('transaction_product_dailys', 'transaction_product_dailys.transaction_daily_id', 'transaction_dailys.id' )
        //         ->where('transaction_dailys.date', $select_date )
        //         ->first();

        //     $profitData[$i] = 0;
        //     if( isset($transactions) ) {
        //         $profitData[$i] = !empty($transactions->sum_profit)?$transactions->sum_profit:0;
        //     }
        // }
        // // end this month

        // // start last month
        // for( $i=0; $i < $lastMonth_days; $i++ ) {
        //     if( $i < $days ) {
        //         $select_date = date('Y-m-d', strtotime( '+' . $i . ' Day', strtotime($lastMonth_year_month) ) );

        //         $transactions = TransactionDaily::select('transaction_dailys.id', 'transaction_dailys.date', $sum_profit )
        //             ->join('transaction_product_dailys', 'transaction_product_dailys.transaction_daily_id', 'transaction_dailys.id' )
        //             ->where('transaction_dailys.date', $select_date )
        //             ->first();

        //         $profitLastmontData[$i] = 0;
        //         if( isset($transactions) ) {
        //             $profitLastmontData[$i] = !empty($transactions->sum_profit)?$transactions->sum_profit:0;
        //         }
        //     }
        // }
        // end last month

        return response()->json([
            'status' => '1',
            // 'dayData' => $dayData,
            // 'profitData' => $profitData,
            // 'profitLastmontData' => $profitLastmontData,
            // 'text_chart' => $text_chart,
            // 'profitToday' => !empty($transactionToday->sum_profit)?number_format($transactionToday->sum_profit):0,
            // 'profitTomorrow' => !empty($transactionTomorrow->sum_profit)?number_format($transactionTomorrow->sum_profit):0,
            // 'profitMonth' => !empty($transactionMonth->sum_profit)?number_format($transactionMonth->sum_profit):0,
            // 'profitLastMonth' => !empty($transactionLastMonth->sum_profit)?number_format($transactionLastMonth->sum_profit):0
        ]);
    }
}
