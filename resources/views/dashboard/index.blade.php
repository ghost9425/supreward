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
                        <div class="col-9 text-right">
                            <h6>พ้อยท์หาย :</h6>
                        </div>
                        <div class="col-3">
                            <h6 id="case1"></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-9 text-right">
                            <h6>พ้อยไม่อัพเดท :</h6>
                        </div>
                        <div class="col-3">
                            <h6 id="case2"></h6>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-9 text-right">
                            <h6>เติมเงินมีปัญหา :</h6>
                        </div>
                        <div class="col-3">
                            <h6 id="case3"></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-9 text-right">
                            <h6>แลกเครดิตไม่เข้า :</h6>
                        </div>
                        <div class="col-3">
                            <h6 id="case4"></h6>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-9 text-right">
                            <h6>พ้อยท์เกิน,แลกเยอะผิดปกติ :</h6>
                        </div>
                        <div class="col-3">
                            <h6 id="case5"></h6>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-9 text-right">
                            <h6>อื่น ๆ :</h6>
                        </div>
                        <div class="col-3">
                            <h6 id="case6"></h6>
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

                <div class="row mt-2">
                    <div class="col-5 text-right">
                        <h6>Total Prefix:</h6>
                    </div>
                    <div class="col-7">
                        <h6>{{$allprefix->count_all_prefix}}</h6>
                        <h6></h6>
                    </div>
                </div>
                <div class="row mt-3">
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
                <div class="row mt-3">
                    <div class="col-5 text-right">
                        <h6>Hits case :</h6>
                    </div>
                    <div class="col-7">
                        <h6 id="hit_case"></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
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

    <div class="col-6">
        <div class="card mb-4">
            <div class="card-header">Chart Case</div>
            <div class="card-body">
                <figure class="highcharts-figure">
                    <div id="container2"></div>
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
            // console.log(res.countall);
            if( res.status == 1 ) {
                let count_pending = res.count_pending_dailys.count_pending;
                let count_success = res.count_success_dailys.count_success;
                let count_today = res.count_today.count_all;
                let sumcount_prefix = res.countsum_prefix;
                let hit_case = res.countall;

                for(name=0;name<hit_case.length;name++)
                console.log(hit_case[name]);

                $("#case1").html(hit_case[0].case_one);

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

                function hitcase (a,b) {
                    return b.case_one - a.case_one
                }

                for (let i = 0; i < hit_case.sort( hitcase ).length; i++)

                // let isBelowThreshold = (currentValue) => currentValue = hitcase[i].case_one;


                $("#hit_case").html(hit_case.sort( hitcase )[0].case_name=="Case"?"No Case":hit_case.sort( hitcase )[0].case_name);
                $("#time,#time2").html(res.show_date);
                $("#result_pending").html( "<span>" + count_pending + "</span>" );
                $("#result_success").html( "<span>" + count_success + "</span>" + "</span> / <span>" + count_today + "</span>" );
                // $("#result_success").html(  "<span style='color:"+color_profitMonth+"'>" + res.profitMonth + "</span> / <span style='color:"+color_profitLastMonth+"'>" + res.profitLastMonth + "</span>" );
                // createProfitDaily(res.dayData,res.profitData,res.profitLastmontData, res.text_chart);

                if (sumcount_prefix != "") {
                    texttitile = "Browser Prefix";
                } else {
                    texttitile = "No Case / Prefix";
                }

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
                        text: texttitile
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
                        data: (function(){
                            let data = [];
                            let arr = res.countsum_prefix;
                            if (arr == "") {
                                // console.log("null")
                            } else {
                                console.log("have data")
                                if (arr.length != 0) {
                                    for (i=0;i < arr.length;i++) {
                                        // for (j=0;i<6;j++) {
                                        if (i<6) {
                                            if (i==0){
                                            data.push({
                                                name: arr[i].name,
                                                y: arr[i].y,
                                                sliced: true,
                                                selected: true
                                            })
                                            } else {
                                                data.push({
                                                    name: arr[i].name,
                                                    y: arr[i].y,
                                                })
                                            }
                                        }
                                    }
                                    return data
                                }
                            }
                        }())
                    }]
                });
                Highcharts.chart('container2', {
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
                        text: (function(){
                            if (hit_case[0].case_name == "Case") {
                                text= "Empty Case";
                            } else {
                                text = "Case"
                            }
                            return text
                        }())
                    },
                    // title: {
                    //     text: 'Browser Case'
                    // },
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
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                            }
                        }
                    },
                    series: [{
                        name: 'Total case',
                        colorByPoint: true,
                        data: (function(){
                            let data = [];
                            let count_case = res.countall;
                            // console.log(count_case);
                            function compare (a,b) {
                                return b.case_one - a.case_one
                            }
                            count_case.sort( compare );
                            // console.log(count_case.sort( compare ));
                            if (count_case.sort( compare ).length !=0) {
                                for (i=0;i < count_case.sort( compare ).length;i++) {
                                    if (i==0) {
                                        data.push({
                                            name: count_case[i].case_name,
                                            y: count_case[i].case_one,
                                            sliced: true,
                                            selected: true
                                        })
                                    } else {
                                        data.push({
                                            name: count_case[i].case_name,
                                            y: count_case[i].case_one,
                                        })
                                    }
                                }
                                return data
                            }
                        }())
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

