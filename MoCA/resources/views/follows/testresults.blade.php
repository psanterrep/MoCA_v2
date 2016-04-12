@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-body center-block">
					@include('errors.messages')
					<?php 
						$isEmpty = true;
						foreach ($patient->consultations()->get() as $consultation) : ?>
							<?php 
								if ($consultation->hasResult()): 
									$isEmpty = false;
							?>
							
							<p>
								
								<?= Lang::get('tests.test_result_for_the_consultation_done_on') ." ". $consultation->date ?>
							</p>
							<table class="table table-striped">
								<tr>
									<th><?= Lang::get('commons.name') ?></th>
									<th><?= Lang::get('commons.version') ?></th>
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
						<?php endif ?>
					<?php endforeach; ?>
					<?php if ($isEmpty): ?>
						<p>
							<?= Lang::get('tests.no_result') ?>
						</p>
						<a href="/follow">
							<button type="button" class="btn btn-primary" aria-label="Left Align">
                            	<span class="glyphicon glyphicon-arrow-left" aria-hidden="true">&nbsp;</span><?= Lang::get('commons.back') ?>
                        	</button>
                        </a>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection 
