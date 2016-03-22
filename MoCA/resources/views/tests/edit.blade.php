@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><?= isset($test) ? "Edit" : "Add"; ?> a test</div>
                <div class="panel-body">
                    @include('errors.messages')
                    <?php $id = isset($test) ? $test->id : 0; ?>
                     <?= Form::open(array("url" => "/test/save/{$id}","method" => "POST", 'files' => true)); ?>
                          <div class="form-group">
                              <?= Form::label('name', 'Name'); ?>
                              <?= Form::text('name', isset($test) ? $test->name : '', $attributes = array("class"=>"form-control")); ?>
                          </div>
                          <div class="form-group">
                              <?php $version =  isset($test) ? $test->version : '1'; ?>
                              <?= Form::label('', 'Version '.$version ); ?>
                          </div>
                          <div class="form-group">
                              <?= Form::checkbox('active', null, isset($test) ? $test->active : true); ?>
                              <?= Form::label('active', 'Active'); ?>
                          </div>
                          <div class="form-group">
                              <?= Form::label('file', 'File Path'); ?>
                              <?php if(isset($test)): ?>
                                  <br  />
                                  <p>
                                  <?= "Current test path is '{$test->path}'"; ?>
                                  </p>
                              <?php endif; ?>
                              <?= Form::file('file') ?>
                          </div>
                      <button type="submit" class="btn btn-primary">Save</button>
                      <?= Form::close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
