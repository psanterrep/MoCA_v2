@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><?= (isset($user)) ? "Edit user" : "Create user" ?></div>
                <div class="panel-body">
                      <?php 
                        $id = (isset($user)) ? $user->id : 0;
                        $a_types;
                        foreach ($types as $type) {
                            $a_types[$type->id] = $type->name;
                        }
                      ?>
                      <?= Form::open(array("url" => "/user/save/".$id,"method" => "POST")) ?>
                          <?= Form::token(); ?>
                          <div class="form-group">
                              <?= Form::label('username', 'Username'); ?>
                              <?= Form::text("username", (isset($user)) ? $user->username : '', $attributes = array("class"=>"form-control")); ?>
                          </div>

                          <div class="form-group">
                              <?= Form::label('email', 'E-Mail Address'); ?>
                              <?= Form::email("email", (isset($user)) ? $user->email : '', $attributes = array("class"=>"form-control")); ?>
                          </div>
                          <div class="form-group">
                              <?= Form::label('type', 'User Type'); ?>
                              <?= Form::select("type", $a_types, (isset($user)) ? $user->type->id : null, ['placeholder' => 'Choose one..', 'class'=>'form-control']); ?>
                          </div>
                          <?php if (isset($user)): ?>
                            @include('users.more_user_info')
                          <?php endif ?>
                          <button type="submit" class="btn btn-default">Save</button>
                     <?= Form::close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
