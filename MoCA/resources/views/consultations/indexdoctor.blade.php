@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><?= Lang::choice('commons.consultation',2) ?></div>
                <div class="panel-body">
                    @include('errors.messages')
                    <div class="pull-right">
                        <?= Form::text('name', '', array("class"=>"form-control","placeholder"=>Lang::get('consultations.patient_name'),"id"=>"searchBar")); ?>
                        <?= Form::token();?>
                    </div>
                    <div id="consultationList">
                        @include('consultations.items',['consultations' => $consultations])
                    </div>
                    <button id="showButton" onclick="showAllConsultations('')" class="btn btn-primary pull-right"><?= Lang::get('commons.show_all') ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/consultation.js') }}"></script>
@endsection 
