@extends('layout.main')

@section('css')
<style>
    .card-header {
        background: #008F6B;
        color: #FFFFFF;
    }
    .highcharts-figure, .highcharts-data-table table {
    min-width: 320px;
    max-width: 660px;
    margin: 1em auto;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}
</style>
@endsection

@section('content')
{{-- @dd() --}}
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
                        <span class="card-sub-value HeadFont" id="result_pending"></span><br>
                        <span class="card-sub-value" id="time"></span>
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
                        <span class="card-sub-value HeadFont" id="result_success"></span><br>
                        <span class="card-sub-value" id="time2"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card mb-4">
            <div class="card-header" set-lan="text:Concurrent User/Peak">Case Complaints All / DAY</div>
            <div class="card-body d-flex">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6 text-right">
                            <h6>Today :</h6>
                        </div>
                        <div class="col-6">
                            <h6 id="#">{{$count_today}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-right">
                            <h6>Yesterday :</h6>
                        </div>
                        <div class="col-6">
                            <h6 id="#">{{$count_yesterday}}</h6>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 text-right">
                            <h6>This Month :</h6>
                        </div>
                        <div class="col-6">
                            <h6 id="#">{{$count_thismonth}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-right">
                            <h6>Last Month :</h6>
                        </div>
                        <div class="col-6">
                            <h6 id="#">{{$count_lastmonth}}</h6>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 text-right">
                            <h6>This Year :</h6>
                        </div>
                        <div class="col-6">
                            <h6 id="#">{{$count_thisyear}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-right">
                            <h6>Last Year :</h6>
                        </div>
                        <div class="col-6">
                            <h6 id="#">{{$count_lastyear}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6 text-right">
                            <h6>Today :</h6>
                        </div>
                        <div class="col-6">
                            <h6 id="#">{{$count_today}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-right">
                            <h6>Yesterday :</h6>
                        </div>
                        <div class="col-6">
                            <h6 id="#">{{$count_yesterday}}</h6>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 text-right">
                            <h6>This Month :</h6>
                        </div>
                        <div class="col-6">
                            <h6 id="#">{{$count_thismonth}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-right">
                            <h6>Last Month :</h6>
                        </div>
                        <div class="col-6">
                            <h6 id="#">{{$count_lastmonth}}</h6>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 text-right">
                            <h6>This Year :</h6>
                        </div>
                        <div class="col-6">
                            <h6 id="#">{{$count_thisyear}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-right">
                            <h6>Last Year :</h6>
                        </div>
                        <div class="col-6">
                            <h6 id="#">{{$count_lastyear}}</h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card mb-4">
            <div class="card-header" set-lan="text:Concurrent User/Peak">Detail Prefix</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-5 text-right">
                        <h6>Total Prefix:</h6>
                    </div>
                    <div class="col-7">
                        <h6>{{$allprefix->count_all_prefix}}</h6>
                        <h6></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5 text-right align-self-center">
                        <h6>Prefix :</h6>
                    </div>
                    <div class="col-3">
                        <div class="select-outline">
                            <select class="mdb-select initialized" id="sort_prefix" name="sort_prefix">
                                <option value="" disabled>Select Prefix</option>
                                <option value="0" selected>All</option>
                                {{-- <option value='4'>prefix 4</option> --}}
                                @if( count($prefixs) > 0 )
                                    @foreach( $prefixs as $prefix )
                                    <option value="{{ $prefix->id }}">{{ $prefix->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-5 text-right">
                        <h6>Total Case :</h6>
                    </div>
                    <div class="col-7">
                        <h6 id="show_count"></h6>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-5 text-right">
                        <h6>Last Month :</h6>
                    </div>
                    <div class="col-7">
                        <h6 id="#"></h6>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-5 text-right">
                        <h6>This Year :</h6>
                    </div>
                    <div class="col-7">
                        <h6 id="#"></h6>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">Chart Prefix</div>
            <div class="card-body">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                    <p class="highcharts-description">
                    </p>
                </figure>
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

$(document).on( 'change', 'select#sort_prefix', function () {
    getStatusAjax();
    // alert("status");
});

function getStatusAjax() {
    let url = "{{ route('Dashboard.listAjax') }}";
    let sort_prefix = $( "#sort_prefix option:selected" ).val();
    $.ajax({
        url: url,
        type: "GET",
        cache: false,
        data: {
            "sort_prefix": sort_prefix,
        },
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
                let sumcount_prefix = res.countsum_prefix;
                console.log(sumcount_prefix);
                // let count_case = res.count_all_case;
                // console.log(res,res.count_case);
                // let count_prefix = res.sort_prefix.count_all;
                // console.log(count_prefix);

                // let color_profitTomorrow = "";
                // let color_profitMonth = "";
                // let color_profitLastMonth = "";

                // if( count_prefix === undefined) {
                //     count_prefix = 0;
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
                if ( sort_prefix == 0) {
                    $("#show_count").html(res.count_case);
                } else {
                    $("#show_count").html(res.sort_prefix==0?res.sort_prefix:res.sort_prefix.count_all);
                }

                $("#time,#time2").html(res.show_date);
                $("#result_pending").html( "<span>" + count_pending + "</span>" );
                $("#result_success").html( "<span>" + count_success + "</span>" + "</span> / <span>" + count_today + "</span>" );
                // $("#result_success").html(  "<span style='color:"+color_profitMonth+"'>" + res.profitMonth + "</span> / <span style='color:"+color_profitLastMonth+"'>" + res.profitLastMonth + "</span>" );
                // createProfitDaily(res.dayData,res.profitData,res.profitLastmontData, res.text_chart);

                Highcharts.chart('container', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    credits: {
                        enabled: false
                    },
                    title: {
                        text: 'Browser Prefix'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: 'Brands',
                        colorByPoint: true,
                        data: [{
                            name: sumcount_prefix[0].name,
                            y: sumcount_prefix[0].countsum_prefix,
                            sliced: true,
                            selected: true
                        }, {
                            name: sumcount_prefix[1].name,
                            y: sumcount_prefix[1].countsum_prefix
                        }, {
                            name: sumcount_prefix[2].name,
                            y: sumcount_prefix[2].countsum_prefix
                        }, {
                            name: sumcount_prefix[3].name,
                            y: sumcount_prefix[3].countsum_prefix
                        }, {
                            name: sumcount_prefix[4].name,
                            y: sumcount_prefix[4].countsum_prefix
                        }, {
                            name: sumcount_prefix[5].name,
                            y: sumcount_prefix[5].countsum_prefix
                        },]
                    }]
                });
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

