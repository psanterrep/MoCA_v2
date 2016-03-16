@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				

                <div class="panel-body">
                    Your Application's consultation adding Page.
                    <?= Form::open(array("url" => "/consultation/save/".$id,"method" => "POST")) ?>
					<div class="form-group">
						<?= Form::label('date', 'Date'); ?>
						<?= Form::date("date", '', $attributes = array("class"=>"form-control")); ?>
					</div>
					<div class="form-group">
						<?= Form::label('comment', 'Comment'); ?>
						<?= Form::date("comment", '', $attributes = array("class"=>"form-control")); ?>
					</div>
					<button type="submit" class="btn btn-primary">Save</button>
					<?= Form::close() ?>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection 
