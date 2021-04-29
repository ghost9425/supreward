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
                    <table class="table table-border" id="table_user" role="grid">
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
                        <tbody id="tb-body-user"></tbody>
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
