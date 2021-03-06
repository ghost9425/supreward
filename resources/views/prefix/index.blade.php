@extends('layout.main')

@section('css')
@endsection

@section('content')
<div class="row">
    @csrf
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('Prefix.index') }}" class="linkNav">Prefix</a>
                </li>
                <li class="breadcrumb-item active txtMem" class="linkNav">Prefix list</li>
            </ol>
        </nav>
    </div>
    <div class="col-12">
        <div class="title-holder">
            <h1>Prefix list</h1>
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
                <button class="btn btn-yellow font-weight-bold m-0 px-3 py-2 z-depth-0 waves-effect btnMenu" type="button" id="btn-search">Search</button>
            </div>
        </div>
        <div class="table-wrapper">
            <div class="row m-0">
                <div class="col-sm-12 p-0">
                    <table class="table table-border" id="table_prefix" role="grid">
                        <thead class="rgba-green-slight">
                            <tr role="row">
                                <th style="width: 4%">No</th>
                                <th style="width: 10%;text-align: center;padding-left: 5px;">Prefix</th>
                                <th>Prefix Created</th>
                                <th style="width: 7%">Edit</th>
                            </tr>
                        </thead>
                        <tbody id="tb-body-prefix"></tbody>
                        <tfoot class="rgba-yellow-slight">
                            <tr class="total">
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

<div class="modal fade" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold ml-5" set-lan="text:Mission">Delete Record?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">??</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="row">
                    <label for="user" class="col-12 col-form-label text-center" set-lan="html:Username-">Are you sure you want to delete the selected rows?<label style="color: red;">&nbsp;*</label></label>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button id="btn-change-delete" type="button" class="btn btn-yellow font-weight-bold waves-effect waves-light">OK</button>
                <button type="button" class="btn btn-yellow font-weight-bold waves-effect waves-light" data-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
{{-- <script>
$("#tb-body-complaint").on("click", "#btn-modal-delete", function(){
    $("#modaldelete").modal("show");
    let id = $(this).data("id");
    $( "#modaldelete" ).on( "click", "#btn-change-delete", function() {
        $.ajax({
            url: "{{route('Complaint.ajaxDelete')}}",
            dataType: "json",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
            },
            cache: false,
            beforeSend: function() {
                $('#myModalLoad').modal('show');
            },
            success: function(res) {
                $('#myModalLoad').modal('hide');
                if( res.status == 1 ) {
                    $("#lbAlert").html(res.mgs);
                    $('#modalAlert').modal('show');
                    setTimeout(function(){ window.location.href = "{{route('Complaint.index')}}" }, 1000);
                } else {
                    if( res.mgs ) {
                        $("#lbAlert").html(res.mgs);
                    } else {
                        $("#lbAlert").html('Delete Complaints Save Error');
                    }
                    $('#modalAlert').modal('show');
                }
            },
            error: function (xhr, status, error) {
                $('#myModalLoad').modal('hide');
                $("#lbAlert").html('Error Delete Complaints Save');
                $('#modalAlert').modal('show');
            },
        });
    });
});
</script> --}}
<script>
    $( document ).ready(function() {
        listAjax();
    });

$("#tb-body-prefix").on("click", ".btn-edit", function(){
    $('#myModalLoad').modal('show');
    let id = $(this).data("id");
    let url = "{{ route('Prefix.edit') }}/"+id;
    window.location.href = url;
});
$("#btn-search").on("click", function(){
    listAjax();
});

    function listAjax() {
    let search = $("#search").val();
    let url = "{{ route('Prefix.listAjax') }}";

    $.ajax({
        url: url,
        type: "GET",
        cache: false,
        data: {
            search: search,
        },
        dataType: "json",
        beforeSend: function() {
            $('#myModalLoad').modal('show');
        },
        success: function(res) {
            let html = "";
            if( res.status==1 ) {
                console.log(res.prefixs);
                if( res.prefixs.length > 0 ) {
                    $(res.prefixs).each(function(k,v) {
                        let support = "";
                        if( v.support ) {
                            support = v.support;
                        }
                        html    +=  '<tr role="row" style="vertical-align: middle;">'+
                                        '<td class="text-center align-middle">'+ (k+1) +'</td>'+
                                        '<td class="align-middle text-center text-uppercase">'+ v.name +'</td>'+
                                        '<td id="date_change" class="text-center text-nowrap align-middle">'+ v.created +'</td>'+
                                        '<td class="text-center align-middle">'+
                                            // '<a data-id="'+v.id+'" class="link btn-edit"><i class="fas fa-pencil-alt"></i></a> <button data-id="'+v.id+'" id="btn-modal-delete" class="btn btn-sm btn-danger btn_delete_item col-xl-auto col-sm-12 mt-1">delete</button>'+
                                            '<a data-id="'+v.id+'" class="link btn-edit"><i class="fas fa-pencil-alt"></i></a>'+
                                        '</td>'+
                                    '</tr>';
                        console.log(v.updated_at)
                    });
                } else {
                    html    +=  '<tr role="row"><td class="text-center" colspan="8">No Data</td></tr>';
                }

            }
            $("#tb-body-prefix").html(html);
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

