@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><?= (isset($user)) ? "Edit user" : "Create user" ?></div>
                <div class="panel-body">
                    @include('errors.messages')
                      <?php 
                        $id = (isset($user)) ? $user->id : 0;
                        $a_types;
                        foreach ($types as $type) {
                            $a_types[$type->id] = $type->name;
                        }
                      ?>
                      <?= Form::open(array("url" => "/user/save/".$id,"method" => "POST")) ?>
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
                              <?= Form::select("type", $a_types, (isset($user)) ? $user->type->id : null, ['placeholder' => 'Choose one..', 'class'=>'form-control','data-type'=>'user-'.$id]); ?>
                          </div>
                          <div id="user-info">
                            <?php if (isset($user)): ?>
                              @include('users.more_user_info', ['idType' => $user->type->id])
                            <?php endif ?>
                          </div>
                          <button type="submit" class="btn btn-primary">Save</button>
                     <?= Form::close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/user.js') }}"></script>
@endsection 
