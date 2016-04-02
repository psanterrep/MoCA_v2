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
								Test result for the consultation done on : <?= $consultation->date ?>
							</p>
							<table class="table table-striped">
								<tr>
									<th>Name</th>
									<th>Version</th>
									<th>Result</th>
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
							There's no result for this patient.
						</p>
						<a href="/follow">
							<button type="button" class="btn btn-primary" aria-label="Left Align">
                            	<span class="glyphicon glyphicon-arrow-left" aria-hidden="true">&nbsp;</span>Back
                        	</button>
                        </a>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection 
