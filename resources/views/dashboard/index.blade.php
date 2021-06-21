@extends('layout.main')

@section('css')
<style>
    .card-header {
        background: #008F6B;
        color: #FFFFFF;
    }
</style>
@endsection

@section('content')
{{-- @dd($count_pending_dailys) --}}
<div class="col-12">
    <div class="title-holder">
        <h1><b>Dashboard</b></h1>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="card mb-4">
            <div class="card-header" set-lan="text:Concurrent User/Peak">Pending Today</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 aligncenter">
                        <span class="card-sub-value HeadFont" id="result_pending"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card mb-4">
            <div class="card-header">Success Today</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 aligncenter">
                        <span class="card-sub-value HeadFont" id="result_success"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">Pending / Success Monthly</div>
            <div class="card-body">
                <div class="row">
                    <div id="#" style="width: 100%;">
                        Prefix
                    </div>
                </div>
                <div class="row">
                    <div id="result_thismonth" style="width: 99%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function() {
    getStatusAjax();
});
function getStatusAjax() {
    let url = "{{ route('Dashboard.listAjax') }}";
    $.ajax({
        url: url,
        type: "GET",
        cache: false,
        dataType: "json",
        beforeSend: function() {
            $('#myModalLoad').modal('show');
        },
        success: function(res) {
            $('#myModalLoad').modal('hide');
            console.log(res);
            if( res.status == 1 ) {
                // console.log(res.status," = true");
                let count_pending = res.count_pending_dailys.count_pending;
                let count_success = res.count_success_dailys.count_success;
                let count_today = res.count_today.count_all;
                // console.log(count_pending,count_success,count_today);
                // let color_profitTomorrow = "";
                // let color_profitMonth = "";
                // let color_profitLastMonth = "";

                // if( parseInt(res.profitToday) < 0 ) {
                //     color_profitToday = "#e20c0c";
                // }

                if ( count_today === undefined ) {
                    count_pending = 0;
                    count_success = 0;
                    count_today = 0;
                } else if( count_pending === undefined) {
                     count_pending = 0;
                } else if ( count_success === undefined ) {
                     count_success = 0;
                }

                $("#result_pending").html( "<span>" + count_pending + "</span>" );
                $("#result_success").html( "<span>" + count_success + "</span>" + "</span> / <span>" + count_today + "</span>" );
                // $("#result_success").html(  "<span style='color:"+color_profitMonth+"'>" + res.profitMonth + "</span> / <span style='color:"+color_profitLastMonth+"'>" + res.profitLastMonth + "</span>" );
                // createProfitDaily(res.dayData,res.profitData,res.profitLastmontData, res.text_chart);
            }
        },
        error: function (xhr, status, error) {
            $("#lbAlert").html("Invalid Get Count Ajax");
            $('#myModalLoad').modal('hide');
            $('#modalAlert').modal('show');
        },
    });
}
</script>
@endsection

