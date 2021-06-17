@extends('layout.main')

@section('css')
<style>
    .card-header {
        background: #008F6B;
        color: #FFFFFF;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card mb-4">
            <div class="card-header" set-lan="text:Concurrent User/Peak">Pending Today</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 aligncenter">
                        <span class="card-sub-value HeadFont" id="#"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card mb-4">
            <div class="card-header">Success Today</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 aligncenter">
                        <span class="card-sub-value HeadFont" id="#"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">Win / Lose Monthly</div>
            <div class="card-body">
                <div class="row">
                    <div id="container" style="width: 99%;"></div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@section('js')
@endsection

