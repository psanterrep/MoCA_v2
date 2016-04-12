@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-body center-block">
					@include('errors.messages')
					<p>
						<?= Lang::get('tests.test_result_for_the_consultation_done_on') ?> : <?= $consultation->date ?>
					</p>
					<table class="table table-striped">
						<tr>
							<th><?= Lang::get('commons.name') ?></th>
							<th><?= Lang::get('tests.version') ?></th>
							<th><?= Lang::get('commons.result') ?></th>
						</tr>  
					<?php foreach ($consultation->tests()->get() as $test): ?>
						<?php if (!is_null($test->pivot->result)): ?>
								<tr>
									<td><?= $test->name ?></td>
									<td><?= $test->version ?></td>
									<td>
									<?php 
										$json = $test->pivot->result;
										$results = json_decode($json, true);
										foreach($results as $key=>$value){
											echo $key." : ".$value."<br/>";
										}
									?>
									</td>
								</tr>
						<?php endif ?>
					<?php endforeach; ?>
					</table>
					<button type="button" class="btn btn-primary pull-right" onclick="exportResults(<?= $consultation->id ?>)">
						<?= Lang::get('commons.export') ?>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/consultation.js') }}"></script>
@endsection 
