<?php if ($user->type->id == 1): ?>
	<div class="form-group">
		<?php //TODO ?>
  </div>
<?php elseif ($user->type->id == 2): ?>
	<div class="form-group">
		<?= Form::label('firstname', 'Firstname'); ?>
		<?= Form::text("firstname", $user->info()->firstname, $attributes = array("class"=>"form-control")); ?>
	</div>
	<div class="form-group">
		<?= Form::label('name', 'Name'); ?>
		<?= Form::text("name", $user->info()->name, $attributes = array("class"=>"form-control")); ?>
	</div>
	<div class="form-group">
		<?= Form::label('place', 'Select your workplace'); ?>
		<?= Form::text("place", $user->info()->idPlace, $attributes = array("class"=>"form-control")); ?>
	</div>
	<div class="form-group">
		<?= Form::label('role', 'Role'); ?>
		<?= Form::text("role", $user->info()->firstname, $attributes = array("class"=>"form-control")); ?>
	</div>
<?php endif ?>