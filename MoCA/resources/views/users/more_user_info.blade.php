<?php if ($idType == 1): ?>
	<div class="form-group">
		<?php //TODO ?>
  </div>
<?php elseif ($idType == 2): ?>
	<div class="form-group">
		<?= Form::label('firstname', 'Firstname'); ?>
		<?= Form::text("firstname", (isset($user) && isset($user->info()->firstname)) ? $user->info()->firstname : "", $attributes = array("class"=>"form-control")); ?>
	</div>
	<div class="form-group">
		<?= Form::label('name', 'Name'); ?>
		<?= Form::text("name", (isset($user) && isset($user->info()->name)) ? $user->info()->name : "" , $attributes = array("class"=>"form-control")); ?>
	</div>
	<div class="form-group">
		<?= Form::label('place', 'Select your workplace'); ?>
		<?= Form::text("place", (isset($user) && isset($user->info()->idPlace)) ? $user->info()->idPlace : "" , $attributes = array("class"=>"form-control")); ?>
	</div>
	<div class="form-group">
		<?= Form::label('role', 'Role'); ?>
		<?= Form::text("role", (isset($user) && isset($user->info()->firstname)) ? $user->info()->firstname : "" , $attributes = array("class"=>"form-control")); ?>
	</div>
<?php endif ?>