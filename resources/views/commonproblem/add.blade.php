@extends('layout.main')

@section('css')
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('CommonProblem.index') }}" class="linkNav">Problem</a>
                </li>
                <li class="breadcrumb-item active txtMem" class="linkNav">Add Problem</li>
            </ol>
        </nav>
    </div>
    <div class="col-12">
        <div class="title-holder">
            <h1>Add Problem</h1>
        </div>
        <div class="section-group mb-4">
            <h4 set-lan="text:Basic Info">Information</h4>
            <form id="form-add-problem" method="get" action="{{ route('CommonProblem.add') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-12">
                        <div class="form-group row inputform">
                            <label for="name" class="col-2 col-form-label" set-lan="html:Username-">Problem<label style="color: red;">&nbsp;*</label></label>
                            <div class="col-4">
                                {{-- <input type="text" id="name" name="name" class="form-control" style='text-transform:uppercase' autocomplete="off" onkeypress="clsAlphaNoOnly(event)" maxlength="30"> --}}
                                <input type="text" id="name" name="problem" class="form-control" style='text-transform:uppercase' autocomplete="off">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-row">
                    <div class="col-12" style="text-align: center; margin-top: 1rem;">
                        <button class="btn btn-yellow font-weight-bold waves-effect waves-light" type="submit">Add Problem</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $( "#form-add-problem" ).on('submit', function(e) {
        e.preventDefault();

        let name = $("#name").val().trim();
        let alert = "";

        if(!name) {
            alert = "Please enter 'Problem'";
            $("#lbAlert").html(alert);
            $('#modalAlert').modal('show');
            return false;
        }

        $.ajax({
            url: "{{route('CommonProblem.addSave')}}",
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
                    setTimeout(function(){ window.location.href = "{{route('CommonProblem.index')}}" }, 1000);
                } else {
                    if( res.mgs ) {
                        $("#lbAlert").html(res.mgs);
                    } else {
                        $("#lbAlert").html('Add Problem Save Error');
                    }
                    $('#modalAlert').modal('show');
                }
            },
            error: function (xhr, status, error) {
                $('#myModalLoad').modal('hide');
                $("#lbAlert").html('Error Add Problem Save');
                $('#modalAlert').modal('show');
            },
        });
    });
    </script>
@endsection
