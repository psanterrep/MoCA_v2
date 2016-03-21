@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Follow a patient</div>
                <div class="panel-body">
                    @include('errors.messages')
                     <?= Form::open(array("url" => "/follow/save/","method" => "POST")); ?>
                          <div class="form-group">
                              <?= Form::label('username', 'Username of the patient'); ?>
                              <?= Form::text("username", '', $attributes = array("class"=>"form-control")); ?>
                          </div>
                      <button type="submit" class="btn btn-primary">Save</button>
                      <?= Form::close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
