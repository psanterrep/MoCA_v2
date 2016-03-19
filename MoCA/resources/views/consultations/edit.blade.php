@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit consultation for <?= $consultation->patients()->get()->first()->profile->username ?></div>
                <div class="panel-body">
                      <?php 
                        $a_types;
                        foreach ($consultation->allTypes() as $type) {
                            $a_types[$type->id] = $type->name;
                        }
                      ?>
                      <?= Form::open(array("url" => "/consultation/update/".$consultation->id,"method" => "POST")) ?>
                        <div class="form-group">
                          <?= Form::label('date', 'Date'); ?>
                          <?= Form::date("date", $consultation->date, $attributes = array("class"=>"form-control")); ?>
                        </div>
                        <div class="form-group">
                          <?= Form::label('comment', 'Comment'); ?>
                          <?= Form::date("comment", isset($consultation->comment) ? $consultation->comment : "", $attributes = array("class"=>"form-control")); ?>
                        </div>
                        <div class="form-group">
                          <?= Form::label('type', 'Consultation Type'); ?>
                          <?= Form::select("type", $a_types, $consultation->type->id, ['placeholder' => 'Choose one..', 'class'=>'form-control','data-type'=>'consultation-'.$consultation->id]); ?>
                        </div>
                        <div class="form-group">
                          <?= Form::label('test', 'Tests'); ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                      <?= Form::close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
