@extends('layout.main')

@section('css')
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item">
                    <a href="{{ route('Company.index') }}" class="linkNav">Company</a>
                </li> --}}
                <li class="breadcrumb-item">
                    Complaint
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
            <form id="form-add-complaint" method="POST" action="{{ route('Complaint.add') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-12">
                        <div class="form-group row inputform">
                            <label for="name" class="col-2 col-form-label" set-lan="html:Username-">Complainant's name<label style="color: red;">&nbsp;*</label></label>
                            <div class="col-4">
                                <input type="text" id="name" name="name" class="form-control" autocomplete="off" onkeypress="clsAlphaNoOnly(event)" maxlength="30">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <div class="form-group row inputform">
                            <label for="prefix" class="col-2 col-form-label" set-lan="html:Username-">PREFIX<label style="color: red;">&nbsp;*</label></label>
                            <div class="col-4">
                                <input type="text" id="prefix" name="prefix" class="form-control" autocomplete="off" onkeypress="clsAlphaNoOnly(event)" maxlength="30">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <div class="form-group row inputform">
                            <label for="detaill" class="col-2 col-form-label" set-lan="html:Username-">Complaint detail<label style="color: red;">&nbsp;*</label></label>
                            <div class="col-10">
                                <input type="text" id="detaill" name="detaill" class="form-control" autocomplete="off" maxlength="255">
                            </div>
                        </div>
                        {{-- <div class="form-group row inputform">
                            <label for="permission" class="col-4 col-form-label" set-lan="text:Phone number">Admin <label style="color: red;">&nbsp;*</label></label>
                            <div class="col-8">
                                <div class="select-outline">
                                    <select class="mdb-select initialized" id="user_id" name="user_id">
                                        <option value="">Select Admin</option>
                                        @if( count($users) > 0 )
                                            @foreach( $users as $user)
                                            <option value="{{ $user->id }}">{{ $user->user.' ('.$user->name.')' }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                    </div>

                    {{-- <div class="col-1"></div>
                    <div class="form-group col-5">
                        <div class="form-group row inputform">
                            <label for="nickname" class="col-4 col-form-label" set-lan="text:Nickname">Company Percent<label style="color: red;">&nbsp;*</label></label>
                            <div class="col-8">
                                <input type="text" name="percent" id="percent" class="form-control" autocomplete="off" onkeypress="clsPercentOnly(event)" maxlength="30">
                                <small class="text-muted form-text">Enter only number (0-9) or letter ( , ) , /.</small>
                            </div>
                        </div>

                    </div> --}}

                </div>
                {{-- <div id="box-product">
                    <h4 set-lan="text:Status">Products</h4>
                    <div class="form-row">
                        <div class="form-group col-5">
                            <div class="form-group row inputform">
                                <label for="company" class="col-4 col-form-label" set-lan="html:Username-">1. Product Name</label>
                                <div class="col-4">
                                    <input type="text" name="products[]" class="form-control" autocomplete="off" onkeypress="clsAlphaNoOnly(event)" maxlength="30" >
                                    <small class="text-muted form-text">Enter only number (0-9) or letter (A-Z, a-z).</small>
                                </div>
                                <div class="col-4">
                                    <div class="select-outline">
                                        <select class="mdb-select initialized" name="type[]">
                                            <option value="general">General</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <small class="text-muted form-text">Select Type</small>
                                </div>
                            </div>
                            <div class="form-group row inputform">
                                <label for="company" class="col-4 col-form-label" set-lan="html:Username-">2. Product Name</label>
                                <div class="col-4">
                                    <input type="text" name="products[]" class="form-control" autocomplete="off" onkeypress="clsAlphaNoOnly(event)" maxlength="30" >
                                    <small class="text-muted form-text">Enter only number (0-9) or letter (A-Z, a-z).</small>
                                </div>
                                <div class="col-4">
                                    <div class="select-outline">
                                        <select class="mdb-select initialized" name="type[]">
                                            <option value="general">General</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <small class="text-muted form-text">Select Type</small>
                                </div>
                            </div>
                            <div class="form-group row inputform">
                                <label for="company" class="col-4 col-form-label" set-lan="html:Username-">3. Product Name</label>
                                <div class="col-4">
                                    <input type="text" name="products[]" class="form-control" autocomplete="off" onkeypress="clsAlphaNoOnly(event)" maxlength="30" >
                                    <small class="text-muted form-text">Enter only number (0-9) or letter (A-Z, a-z).</small>
                                </div>
                                <div class="col-4">
                                    <div class="select-outline">
                                        <select class="mdb-select initialized" name="type[]">
                                            <option value="general">General</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <small class="text-muted form-text">Select Type</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-1"></div>
                        <div class="form-group col-5">
                            <div class="form-group row inputform">
                                <label for="company" class="col-4 col-form-label" set-lan="html:Username-">4. Product Name</label>
                                <div class="col-4">
                                    <input type="text" name="products[]" class="form-control" autocomplete="off" onkeypress="clsAlphaNoOnly(event)" maxlength="30" >
                                    <small class="text-muted form-text">Enter only number (0-9) or letter (A-Z, a-z).</small>
                                </div>
                                <div class="col-4">
                                    <div class="select-outline">
                                        <select class="mdb-select initialized" name="type[]">
                                            <option value="general">General</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <small class="text-muted form-text">Select Type</small>
                                </div>
                            </div>
                            <div class="form-group row inputform">
                                <label for="company" class="col-4 col-form-label" set-lan="html:Username-">5. Product Name</label>
                                <div class="col-4">
                                    <input type="text" name="products[]" class="form-control" autocomplete="off" onkeypress="clsAlphaNoOnly(event)" maxlength="30" >
                                    <small class="text-muted form-text">Enter only number (0-9) or letter (A-Z, a-z).</small>
                                </div>
                                <div class="col-4">
                                    <div class="select-outline">
                                        <select class="mdb-select initialized" name="type[]">
                                            <option value="general">General</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <small class="text-muted form-text">Select Type</small>
                                </div>
                            </div>
                            <div class="form-group row inputform">
                                <label for="company" class="col-4 col-form-label" set-lan="html:Username-">6. Product Name</label>
                                <div class="col-4">
                                    <input type="text" name="products[]" class="form-control" autocomplete="off" onkeypress="clsAlphaNoOnly(event)" maxlength="30" >
                                    <small class="text-muted form-text">Enter only number (0-9) or letter (A-Z, a-z).</small>
                                </div>
                                <div class="col-4">
                                    <div class="select-outline">
                                        <select class="mdb-select initialized" name="type[]">
                                            <option value="general">General</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <small class="text-muted form-text">Select Type</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
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
    $( "#form-add-complaint" ).on('submit', function(e) {
    e.preventDefault();

    let name = $("#name").val().trim();
    let prefix = $("#prefix").val().trim();
    let detaill = $("#detaill").val().trim();
    let alert = "";

    if(!name) {
        alert = "Please enter 'Complainant's name'";
        $("#lbAlert").html(alert);
        $('#modalAlert').modal('show');
        return false;
    }

    if(!prefix) {
        alert = "Please enter 'PREFIX'";
        $("#lbAlert").html(alert);
        $('#modalAlert').modal('show');
        return false;
    }

    if(!detaill) {
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
                    $("#lbAlert").html('Error Add Complaints Save');
                }
                $('#modalAlert').modal('show');
            }
        },
        error: function (xhr, status, error) {
            $('#myModalLoad').modal('hide');
        },
    });
});
</script>
@endsection
