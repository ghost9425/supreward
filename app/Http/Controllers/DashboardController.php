<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ComplaintsPrefixCollection;
use App\Models\Complaints;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // $today=date("Y-m-d");

        // $a=date("Y-m-d");
        // $today = DB::table('complaints')
        // ->select(DB::raw("DATE_FORMAT(complaints.created_at,'%Y-%m-%d') AS date"),DB::raw('count(complaints.created_at) as count_pending'))
        // // ->where('complants_prefix_collection.complaints_success',0)
        // ->where(DB::raw("DATE_FORMAT(complaints.created_at,'%Y-%m-%d')"), $a)
        // ->groupBy('complaints.created_at')
        // ->get();
        // dd($today);

        // dd($count_pending_dailys,$count_success_dailys);
        return view('dashboard.index', [
            'layout_page' => 'dashboard',
        ]);
    }

    public function listAjax(Request $request) {

        $today=date("Y-m-d");

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

        // dd($count_pending_dailys,$count_success_dailys);
        return response()->json([
            'status' => '1',
            'count_pending_dailys' => $count_pending_dailys==null?0:$count_pending_dailys,
            'count_success_dailys' => $count_success_dailys==null?0:$count_success_dailys,
            'count_today' => $count_today==null?0:$count_today,
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
