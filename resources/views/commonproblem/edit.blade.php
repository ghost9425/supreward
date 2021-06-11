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
                <li class="breadcrumb-item active txtMem" class="linkNav">Edit Problem</li>
            </ol>
        </nav>
    </div>
    <div class="col-12">
        <div class="title-holder">
            <h1>Edit Problem</h1>
        </div>
        <div class="section-group mb-4">
            <h4 set-lan="text:Basic Info">Information</h4>
            <form id="form-edit-problem" action="{{ route('CommonProblem.editSave') }}" method="post">
                @csrf
                <input id="id" name="id" value="{{ $commonproblem->id }}" type="hidden" >
                <div class="form-row">
                    <div class="form-group col-12">
                        <div class="form-group row inputform">
                            <label for="name" class="col-2 col-form-label" set-lan="html:Username-">Problem<label style="color: red;">&nbsp;*</label></label>
                            <div class="col-4">
                                <input type="text" id="name" value="{{ $commonproblem->problem }}" name="problem" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-row">
                    <div class="col-12" style="text-align: center; margin-top: 1rem;">
                        <button class="btn btn-yellow font-weight-bold waves-effect waves-light" type="submit">Save problem</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $("#form-edit-problem").on('submit', function(e) {
        e.preventDefault();

        let name = $("#name").val().trim();
        let alert = "";

        if(!name) {
            alert = "Please enter 'Problem detail'";
            $("#lbAlert").html(alert);
            $('#modalAlert').modal('show');
            return false;
        }

        $.ajax({
            url: "{{route('CommonProblem.editSave')}}",
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
                    setTimeout(function(){ window.location.href = "{{route('CommonProblem.index')}}" }, 1000);

                } else {
                    $('#myModalLoad').modal('hide');
                    if( res.mgs ) {
                        $("#lbAlert").html(res.mgs);
                    } else {
                        $("#lbAlert").html('Edit Problem Save Error');
                    }
                    $('#modalAlert').modal('show');
                }
            },
            error: function (xhr, status, error) {
                $('#myModalLoad').modal('hide');
                $("#lbAlert").html('Error Edit Problem Save');
                $('#modalAlert').modal('show');
            },
        });

    });
    </script>
@endsection
