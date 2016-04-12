@extends('layouts.app')
@section('head')
<script type="text/javascript" src="{{ URL::asset('lib/jsPsych-5.0.3/jspsych.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('lib/jsPsych-5.0.3/plugins/jspsych-text.js') }}"></script>
<link href="{{ asset('lib/spsych-5.0.3/jspsych.css') }}" rel="stylesheet">
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-body center-block">
					@include('errors.messages')
					<?= Form::token();?>
					<?= Form::hidden("consultation",$consultation->id);?>
					<?= Form::hidden("test",$test->id);?>
					<div id="jspsych-target" class="psych_window"></div>
    				<?php include($test->getFullPath()); ?>
    				<div class="text-center"> 
						<button class="btn btn-primary" onclick="fullscreen();"><?= Lang::get('tests.start_test') ?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/consultation.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('lib/screenfull.js') }}"></script>
@endsection 
