@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				
				<?php 
					$a_types;
					foreach ($types as $type){
						$a_types[$type->id] = $type->name;
					}
				?>
				<div class="panel-body">
					@include('errors.messages')
					<?= Form::open(array("url" => "/consultation/save/".$id,"method" => "POST")) ?>
					<div class="form-group">
						<?= Form::label('date', 'Date'); ?>
						<?= Form::date("date", '', $attributes = array("class"=>"form-control")); ?>
					</div>
					<div class="form-group">
						<?= Form::label('type', 'Consultation Type'); ?>
						<?= Form::select("type", $a_types, null, ['placeholder' => 'Choose one..', 'class'=>'form-control']); ?>
					</div>
					<div class="form-group">
						<?= Form::label('test', 'Tests'); ?>
						<select multiple="multiple" name="tests[]" id="tests" class="form-control">
						@foreach($tests as $test)
							<option value="{{$test->id}}" ><?= $test->name." - Version_".$test->version ?></option>
						@endforeach
						</select>
					</div>
					<div class="form-group">
						<?= Form::label('comment', 'Comment'); ?>
						<?= Form::textarea("comment", '', $attributes = array("class"=>"form-control")); ?>
					</div>
					<button type="submit" class="btn btn-primary">Save</button>
					<?= Form::close() ?>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection 
