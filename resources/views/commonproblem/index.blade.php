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
                    <a href="{{ route('CommonProblem.index') }}" class="linkNav">Problem</a>
                </li>
                <li class="breadcrumb-item active txtMem" class="linkNav">Problem list</li>
            </ol>
        </nav>
    </div>
    <div class="col-12">
        <div class="title-holder">
            <h1>Problem list</h1>
        </div>
    </div>
    <div class="col-12">
        <div class="btn-toolbar section-group pb-0 mb-3" role="toolbar">
            <div class="form-group row" style="padding-left: 1rem;">
                <label class="col-form-label">Problem :</label>
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
                    <table class="table table-border" id="table_problem" role="grid">
                        <thead class="rgba-green-slight">
                            <tr role="row">
                                <th style="width: 6%">No</th>
                                <th style="text-align: center;padding-left: 5px;">Detail Problem</th>
                                <th style="width: 15%">Problem Created</th>
                                <th style="width: 8%">Edit</th>
                            </tr>
                        </thead>
                        <tbody id="tb-body-problem"></tbody>
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
@endsection
@section('js')
<script>
    $( document ).ready(function() {
        listAjax();
    });

$("#tb-body-problem").on("click", ".btn-edit", function(){
    $('#myModalLoad').modal('show');
    let id = $(this).data("id");
    let url = "{{ route('CommonProblem.edit') }}/"+id;
    window.location.href = url;
});
$("#btn-search").on("click", function(){
    listAjax();
});

    function listAjax() {
    let search = $("#search").val();
    let url = "{{ route('CommonProblem.listAjax') }}";

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
                // console.log(res.prefixs);
                if( res.problems.length > 0 ) {
                    $(res.problems).each(function(k,v) {
                        let support = "";
                        if( v.support ) {
                            support = v.support;
                        }
                        html    +=  '<tr role="row" style="vertical-align: middle;">'+
                                        '<td class="text-center align-middle">'+ (k+1) +'</td>'+
                                        '<td class="align-middle text-center text-uppercase">'+ v.problem +'</td>'+
                                        '<td id="date_change" class="text-center text-nowrap align-middle">'+ v.created +'</td>'+
                                        '<td class="text-center align-middle">'+
                                            // '<a data-id="'+v.id+'" class="link btn-edit"><i class="fas fa-pencil-alt"></i></a> <button data-id="'+v.id+'" id="btn-modal-delete" class="btn btn-sm btn-danger btn_delete_item col-xl-auto col-sm-12 mt-1">delete</button>'+
                                            '<a data-id="'+v.id+'" class="link btn-edit"><i class="fas fa-pencil-alt"></i></a>'+
                                        '</td>'+
                                    '</tr>';
                        // console.log(v.updated_at)
                    });
                } else {
                    html    +=  '<tr role="row"><td class="text-center" colspan="8">No Data</td></tr>';
                }

            }
            $("#tb-body-problem").html(html);
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

