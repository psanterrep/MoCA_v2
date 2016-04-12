@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><?= Lang::get('follow.follow_a_patient') ?></div>
                <div class="panel-body">
                    @include('errors.messages')
                     <?= Form::open(array("url" => "/follow/save/","method" => "POST")); ?>
                          <div class="form-group">
                              <?= Form::label('username', Lang::get('follow.username_of_the_patient')); ?>
                              <?= Form::text("username", '', $attributes = array("class"=>"form-control")); ?>
                          </div>
                      <button type="submit" class="btn btn-primary pull-right"><?= Lang::get('commons.follow') ?></button>
                      <?= Form::close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
