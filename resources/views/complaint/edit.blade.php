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
                <li class="breadcrumb-item active txtMem" class="linkNav">Edit Complaint</li>
            </ol>
        </nav>
    </div>
    <div class="col-12">
        <div class="title-holder">
            <h1>Edit Complaint</h1>
        </div>
        <div class="section-group mb-4">
            <h4 set-lan="text:Basic Info">Information</h4>
            <form id="form-edit-complaint" action="{{ route('Complaint.editSave') }}" method="post">
                @csrf
                <input id="id" name="id" value="{{ $complaints->id }}" type="hidden" >
                <div class="form-row">
                    <div class="form-group col-12">
                        <div class="form-group row inputform">
                            <label for="name" class="col-2 col-form-label" set-lan="html:Username-">Complainant's name<label style="color: red;">&nbsp;*</label></label>
                            <div class="col-4">
                                <input type="text" id="name" value="{{ $complaints->name }}" name="name" class="form-control" autocomplete="off" onkeypress="clsAlphaNoOnly(event)" maxlength="30" disabled="disabled">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <div class="form-group row inputform">
                            <label for="prefix" class="col-2 col-form-label" set-lan="html:Username-">PREFIX<label style="color: red;">&nbsp;*</label></label>
                            <div class="col-4">
                                <input type="text" id="prefix" name="prefix" value="{{ $complaints->prefix }}" class="form-control" autocomplete="off" onkeypress="clsAlphaNoOnly(event)" maxlength="30" disabled="disabled">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <div class="form-group row inputform">
                            <label for="detaill" class="col-2 col-form-label" set-lan="html:Username-">Complaint detail<label style="color: red;">&nbsp;*</label></label>
                            <div class="col-10">
                                <input type="text" id="detaill" name="detaill" value="{{ $complaints->detaill }}" class="form-control" autocomplete="off" maxlength="255">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <div class="form-group row inputform">
                            <label for="image" class="col-2 col-form-label">Attachment</label>
                            <div class="col-5">
                                <input type="file" name="image" id="image" class="form-control" autocomplete="off">
                                <small class="text-muted form-text">Only images (.jpg, .jpeg, .gif, .png) and files (.pdf).</small>
                            </div>
                            <div class="text-center p-3" style="text-align: center">
                            </div>
                         </div>
                    </div>

                </div>
                <div class="form-row">
                    <div class="col-12" style="text-align: center; margin-top: 1rem;">
                        <button class="btn btn-yellow font-weight-bold waves-effect waves-light" type="submit">Save Complaint</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $( document ).ready(function() {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    });
$("#form-edit-complaint").on('submit', function(e) {
    e.preventDefault();

    let detaill = $("#detaill").val().trim();
    let alert = "";

    if(!detaill) {
        alert = "Please enter 'Complaint detail'";
        $("#lbAlert").html(alert);
        $('#modalAlert').modal('show');
        return false;
    }

    $.ajax({
        url: "{{route('Complaint.editSave')}}",
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
            if( res.status == 1 ) {
                $("#lbAlert").html(res.mgs);
                $('#myModalLoad').modal('hide');
                $('#modalAlert').modal('show');
                setTimeout(function(){ window.location.href = "{{route('Complaint.index')}}" }, 1000);

            } else {
                $('#myModalLoad').modal('hide');
                if( res.mgs ) {
                    $("#lbAlert").html(res.mgs);
                } else {
                    $("#lbAlert").html('Error Addssss User Save');
                }
                $('#modalAlert').modal('show');
            }
        },
        error: function (xhr, status, error) {
            $('#myModalLoad').modal('hide');
            $("#lbAlert").html('Error Add User Save');
            $('#modalAlert').modal('show');
        },
    });

});
</script>

@endsection
