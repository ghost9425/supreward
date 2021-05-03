@extends('layout.main')

@section('css')
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('Complaint.index') }}" class="linkNav">Complaint</a>
                </li>
                <li class="breadcrumb-item active txtMem" class="linkNav">Complaint list</li>
            </ol>
        </nav>
    </div>
    <div class="col-12">
        <div class="title-holder">
            <h1>Complaint list</h1>
        </div>
    </div>
    <div class="col-12">
        {{-- <div class="btn-toolbar section-group pb-0 mb-3" role="toolbar">
            <div class="form-group row" style="padding-left: 1rem;">
                <label class="col-form-label">Username :</label>
                <div style="padding-left: 1rem;">
                    <input type="text" class="form-control" id="search" name="search" value="">
                </div>
            </div>
            <div class="form-group row" style="padding-left: 2rem;">
                <button class="btn btn-yellow font-weight-bold m-0 px-3 py-2 z-depth-0 waves-effect btnMenu" type="button" id="btn-search">Search</button>
            </div>
        </div> --}}
        <div class="table-wrapper">
            <div class="row m-0">
                <div class="col-sm-12 p-0">
                    <table class="table table-border" id="table_complaint" role="grid">
                        <thead class="rgba-green-slight">
                            <tr role="row">
                                <th style="width: 4%">No</th>
                                <th style="width: 10%;text-align: center;padding-left: 5px;">Name</th>
                                <th style="width: 10%;text-align: center;padding-left: 5px;">Prefix</th>
                                <th style="width: 40%;">Detaill</th>
                                <th style="width: 15%;">image</th>
                                <th>Last Complaint date</th>
                                <th style="width: 7%">Edit</th>
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
@endsection
@section('js')
<script>
    $( document ).ready(function() {
        listAjax();
    });

$("#tb-body-complaint").on("click", ".btn-edit", function(){
    $('#myModalLoad').modal('show');
    let id = $(this).data("id");
    let url = "{{ route('Complaint.edit') }}/"+id;
    window.location.href = url;
});

    function listAjax() {
    // let search = $("#search").val();
    let url = "{{ route('Complaint.listAjax') }}";

    $.ajax({
        url: url,
        type: "GET",
        cache: false,
        dataType: "json",
        beforeSend: function() {
            $('#myModalLoad').modal('show');
        },
        success: function(res) {
            let html = "";
            if( res.status==1 ) {
                console.log(res.complaints);
                if( res.complaints.length > 0 ) {
                    $(res.complaints).each(function(k,v) {
                        let support = "";
                        if( v.support ) {
                            support = v.support;
                        }
                        html    +=  '<tr role="row" style="vertical-align: middle;">'+
                                        '<td class="text-center align-middle">'+ (k+1) +'</td>'+
                                        '<td class="align-middle">'+ v.name +'</td>'+
                                        '<td class="align-middle">'+ v.prefix +'</td>'+
                                        '<td class="text-center align-middle">'+ v.detaill +'</td>'+
                                        '<td style="text-align:center;">'+ v.show_image +'</td>'+
                                        '<td id="date_change" class="text-center text-nowrap align-middle">'+ v.updated +'</td>'+
                                        '<td class="text-center align-middle">'+
                                            '<a data-id="'+v.id+'" class="link btn-edit"><i class="fas fa-pencil-alt"></i></a>'+
                                        '</td>'+
                                    '</tr>';
                        console.log(v.updated_at)
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

$("#tb-body-complaint").on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({
        alwaysShowClose: true
    });
});
</script>
@endsection

