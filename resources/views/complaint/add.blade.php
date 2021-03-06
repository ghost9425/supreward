@extends('layout.main')

@section('css')
@endsection

@section('content')
{{-- @dd($problems) --}}
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('Complaint.index') }}" class="linkNav">Complaint</a>
                </li>
                <li class="breadcrumb-item active txtMem" class="linkNav">Add Complaint</li>
            </ol>
        </nav>
    </div>
    <div class="col-12">
        <div class="title-holder">
            <h1>Add Complaint</h1>
        </div>
        <div class="section-group mb-4">
            <h4 set-lan="text:Basic Info">Information</h4>
            <form id="form-add-complaint" method="get" action="{{ route('Complaint.add') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-12">
                        <div class="form-group row inputform">
                            <label for="name" class="col-2 col-form-label" set-lan="html:Username-">Complainant's name<label style="color: red;">&nbsp;*</label></label>
                            <div class="col-4">
                                <input type="text" id="name" name="name" class="form-control" autocomplete="off" maxlength="30">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <div class="form-group row inputform">
                            <label for="prefix" class="col-2 col-form-label" set-lan="html:Username-">PREFIX<label style="color: red;">&nbsp;*</label></label>
                            <div class="col-4">
                                <div class="select-outline">
                                    <select class="mdb-select initialized" id="prefix" name="prefix" searchable="Search here.." style='text-transform:uppercase'>
                                        <option value="" selected>Select PREFIX</option>
                                        @if( count($prefixs) > 0 )
                                            @foreach( $prefixs as $prefix )
                                            <option value="{{ $prefix->id }}">{{ $prefix->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <div class="form-group row inputform">
                            <label for="prefix" class="col-2 col-form-label" set-lan="html:Username-">COMMON PROBLEM<label style="color: red;">&nbsp;*</label></label>
                            <div class="col-4">
                                <div class="select-outline">
                                    <select class="mdb-select initialized" id="problem" name="problem" searchable="Search here..">
                                        <option value="" selected>Enter Problem</option>
                                        @if( count($problems) > 0 )
                                            @foreach( $problems as $problem )
                                            <option value=" {{$problem->id }}">{{ $problem->problem }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <div class="form-group row inputform">
                            <label for="detaill" class="col-2 col-form-label" set-lan="html:Username-">Complaint detail<label style="color: red;">&nbsp;*</label></label>
                            <div class="col-6">
                                {{-- <input type="text" id="detaill" name="detaill" class="form-control" autocomplete="off" maxlength="255"> --}}
                                <textarea class="form-control rounded-0" id="detail" name="detail" rows="7" style="resize: none;">

                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <div class="form-group row inputform">
                            <label for="image" class="col-2 col-form-label">Attachment</label>
                            <div class="col-5">
                                <input type="file" name="image" id="image" class="form-control" autocomplete="off">
                                <small class="text-muted form-text">Only images (.jpg, .jpeg, .gif, .png)</small>
                            </div>
                            <div class="text-center p-3" style="text-align: center">
                                {{-- <img id="edit_show_image" src="{{get_path_no_image()}}" /> --}}
                            </div>
                         </div>
                    </div>

                </div>
                <div class="form-row">
                    <div class="col-12" style="text-align: center; margin-top: 1rem;">
                        <button class="btn btn-yellow font-weight-bold waves-effect waves-light" type="submit">Add Complaint</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

$(document).on( 'change', 'select#problem', function () {
    let problem_alert = $( "#problem option:selected" ).val()
    if (problem_alert != 6){
        $("#detail").val($(this).val());
        if (problem_alert == 1) {
            $("#detail").val("???????????????????????????");
        } else if (problem_alert == 2) {
            $("#detail").val("???????????????????????????????????????");
        } else if (problem_alert == 3) {
            $("#detail").val("?????????????????????????????????????????????");
        } else if (problem_alert == 4) {
            $("#detail").val("????????????????????????????????????????????????");
        } else if (problem_alert == 5) {
            $("#detail").val("??????????????????????????????,??????????????????????????????????????????");
        }
    } else {
        $("#detail").val("");
    }
});

$( "#form-add-complaint" ).on('submit', function(e) {
    e.preventDefault();

    let name = $("#name").val().trim();
    let prefix = $("#prefix").val().trim();
    let detail = $("#detail").val().trim();
    let problem = $("#problem").val().trim();
    let alert = "";

    if(!name) {
        alert = "Please enter 'Complainant's name'";
        $("#lbAlert").html(alert);
        $('#modalAlert').modal('show');
        return false;
    }

    if(!prefix) {
        alert = "Please SELECT 'PREFIX'";
        $("#lbAlert").html(alert);
        $('#modalAlert').modal('show');
        return false;
    }

    if(!problem) {
        alert = "Please enter 'Type Problem'";
        $("#lbAlert").html(alert);
        $('#modalAlert').modal('show');
        return false;
    }

    if(!detail) {
        alert = "Please enter 'Complaint detail'";
        $("#lbAlert").html(alert);
        $('#modalAlert').modal('show');
        return false;
    }


    $.ajax({
        url: "{{route('Complaint.addSave')}}",
        dataType: "json",
        type: "POST",
        data: new FormData(this),
        cache: false,
        processData: false,
        contentType: false,
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
                    $("#lbAlert").html('Add Complaints Save Error');
                }
                $('#modalAlert').modal('show');
            }
        },
        error: function (xhr, status, error) {
            // console.log(xhr, status, error);
            $('#myModalLoad').modal('hide');
            $("#lbAlert").html('Error Add Complaints Save');
            $('#modalAlert').modal('show');
        },
    });
});
</script>
@endsection
