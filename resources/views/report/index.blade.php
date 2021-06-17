@extends('layout.main')

@section('css')
@endsection

@section('content')
<input type="hidden" class="form-control" id="startdate" value="{{ $startdate }}" />
<input type="hidden" class="form-control" id="todate" value="{{ $todate }}" />
<div class="row">
    @csrf
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('Report.index') }}" class="linkNav">Report</a>
                </li>
                <li class="breadcrumb-item active txtMem" class="linkNav">Report list</li>
            </ol>
        </nav>
    </div>
    <div class="col-12">
        <div class="title-holder">
            <h1>Report list</h1>
        </div>
    </div>
    <div class="col-12">
        <div class="btn-toolbar section-group pb-0 mb-3" role="toolbar">
            <div class="form-group row" style="padding-left: 1rem;">
                <label class="col-form-label">Prefix :</label>
                <div style="padding-left: 1rem;">
                    <input type="text" class="form-control" id="search" name="search" value="">
                </div>
            </div>
            <div class="form-group row" style="padding-left: 2rem;">
                <div class="select-outline">
                    <select class="mdb-select initialized" id="status_complaints" name="status_complaints">
                        <option value="" disabled>Enter Problem</option>
                        {{-- @if( count($complaints_status) > 0 )
                            @foreach( $complaints_status as $status )
                            <option value="{{ $status->id }}">{{ ($status->complaints_success==0)?'Pending':'Success' }}</option>
                            @endforeach
                        @endif --}}
                        <option value="0">Pending</option>
                        <option value="1">Success</option>
                        <option value="2" selected>All</option>
                    </select>
                </div>
            </div>
            <div class="form-group row" style="padding-left: 2rem;">
                <div class="select-outline">
                    <select class="mdb-select initialized" id="sort_datetime" name="sort_datetime">
                        <option value="" disabled>Select Datetime</option>
                        {{-- @if( count($complaints_status) > 0 )
                            @foreach( $complaints_status as $status )
                            <option value="{{ $status->id }}">{{ ($status->complaints_success==0)?'Pending':'Success' }}</option>
                            @endforeach
                        @endif --}}
                        <option value="0">Today</option>
                        <option value="1">Yesterday</option>
                        <option value="2">Last Month</option>
                        <option value="3" selected>Anytime</option>
                    </select>
                </div>
            </div>
            <div class="form-group row" style="padding-left: 2rem;">
                <button class="btn btn-yellow font-weight-bold m-0 px-3 py-2 z-depth-0 waves-effect btnMenu" type="button" id="btn-search">Search</button>
            </div>
        </div>
        <div class="table-wrapper">
            <div class="row m-0">
                <div class="col-sm-12 p-0">
                    <table class="table table-border" id="table_complaint" role="grid">
                        <thead class="rgba-green-slight">
                            <tr role="row">
                                <th style="width: 4%">No</th>
                                <th style="width: 10%;text-align: center;padding-left: 5px;">Name</th>
                                <th style="width: 6%;text-align: center;padding-left: 5px;">Prefix</th>
                                <th style="width: 38%;">Detaill</th>
                                <th>Last Update date</th>
                                <th style="width: 12%;text-align: center;">Status</th>
                                <th style="width: 10%">Edit</th>
                            </tr>
                        </thead>
                        <tbody id="tb-body-complaint"></tbody>
                        <tfoot class="rgba-yellow-slight">
                            <tr class="total">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="overflow ellipsis"></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @dd($report) --}}
@endsection

@section('js')
<script>
$( document ).ready(function() {
        listAjax();
});
$(document).on( 'change', 'select#status_complaints', function () {
    listAjax();
    // alert("status");
});

$(document).on("change", 'select#sort_datetime', function() {
        let btn = $(this).val();
        if (btn == 0) {
            // $("#date_action").val("today");
            // $("#date_previous_next").val("");
            alert(btn);
        } else if (btn == 1) {
            // $("#date_action").val("yesterday");
            // $("#date_previous_next").val("");
            alert(btn);
        } else if (btn == 2) {
            // $("#date_action").val("this_week");
            // $("#date_previous_next").val("");
            alert(btn);
        } else if (btn == 'last_week') {
            // $("#date_action").val("last_week");
            // $("#date_previous_next").val("");
        } else if (btn == 'this_month') {
            // $("#date_action").val("this_month");
            // $("#date_previous_next").val("");
        } else if (btn == 'last_month') {
            // $("#date_action").val("last_month");
            // $("#date_previous_next").val("");
        } else if (btn == 'previous') {
            // $("#date_previous_next").val("previous");
        } else if (btn == 'next') {
            // $("#date_previous_next").val("next");
        }

        listAjax();
    });

var input = document.getElementById("search");

input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
    event.preventDefault();
    document.getElementById("btn-search").click();
    }
});

$("#btn-search").on("click", function(){
    listAjax();
});

function listAjax() {
    let search = $("#search").val();
    // let search2 = $("#status_complaints").val();
    let search2 = $( "#status_complaints option:selected" ).val();
    let sort_datetime = $( "#sort_datetime option:selected" ).val();
    let startdate = $("#startdate").val();
    let todate = $("#todate").val();
    // var capacityValue = $('select.operations-supplier').find(':selected').data('capacity');
    // let search2 = $(this).data("id");
    let url = "{{ route('Report.listAjax') }}";
    // console.log(sort_datetime);

    $.ajax({
        url: url,
        type: "GET",
        cache: false,
        data: {
            search: search,
            status_complaints: search2,
            "startdate": startdate,
            "todate": todate,
            "sort_datetime": sort_datetime,
        },
        dataType: "json",
        beforeSend: function() {
            $('#myModalLoad').modal('show');
        },
        success: function(res) {
            let html = "";
            $("#startdate").val(res.startdate);
            $("#todate").val(res.todate);
            if( res.status==1 ) {
                if( res.reports.length > 0 ) {
                    $(res.reports).each(function(k,v) {
                        let support = "";
                        if( v.support ) {
                            support = v.support;
                        }
                        html    +=  '<tr role="row" style="vertical-align: middle;">'+
                                        '<td class="text-center align-middle">'+ (k+1) +'</td>'+
                                        '<td class="align-middle text-center">'+ v.complaints_name +'</td>'+
                                        '<td class="align-middle text-center text-uppercase">'+ v.prefix_name +'</td>'+
                                        '<td class="text-center align-middle">'+ v.complaints_detail +'</td>'+
                                        '<td id="date_change" class="text-center text-nowrap align-middle">'+ v.updated +'</td>'+
                                        '<td class="text-center align-middle">'+ v.complaints_success +'</td>'+
                                        '<td class="text-center align-middle">'+
                                            '<a data-id="'+v.id+'" class="link btn-edit"><i class="fas fa-pencil-alt"></i></a>'+
                                        '</td>'+
                                    '</tr>';
                    });
                } else {
                    html    +=  '<tr role="row"><td class="text-center" colspan="8">No Data</td></tr>';
                }

            }
            $("#tb-body-complaint").html(html);
            $('#myModalLoad').modal('hide');
        },
        error: function (xhr, status, error) {
            alert("invalid list ajax");
            $('#myModalLoad').modal('hide');
        },
    });
}
</script>
@endsection
