@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Consultations</div>
                <div class="panel-body">
                    @include('errors.messages')
                    <div class="pull-right">
                        <?= Form::text('name', '', array("class"=>"form-control","placeholder"=>"Patient name","id"=>"searchBar")); ?>
                        <?= Form::token();?>
                    </div>
                    <div id="consultationList">
                        Incoming consultation
                        @include('consultations.items',['consultations' => $consultations])
                    </div>
                    <button id="showButton" onclick="showAllConsultations('')" class="btn btn-primary pull-right">Show All</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/consultation.js') }}"></script>
@endsection 
