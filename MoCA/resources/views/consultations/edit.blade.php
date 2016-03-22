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
                        $a_tests = [];
                        foreach ($consultation->allTypes() as $type) {
                            $a_types[$type->id] = $type->name;
                        }
                        foreach ($consultation->tests()->get() as $test) {
                            $a_tests[] = $test->id;
                        }
                      ?>
                      @include('errors.messages')
                      <?= Form::open(array("url" => "/consultation/update/".$consultation->id,"method" => "POST")) ?>
                        <div class="form-group">
                          <?= Form::label('date', 'Date'); ?>
                          <?= Form::date("date", $consultation->date, $attributes = array("class"=>"form-control")); ?>
                        </div>
                        <div class="form-group">
                          <?= Form::label('type', 'Consultation Type'); ?>
                          <?= Form::select("type", $a_types, $consultation->type->id, ['placeholder' => 'Choose one..', 'class'=>'form-control','data-type'=>'consultation-'.$consultation->id]); ?>
                        </div>
                        <div class="form-group">
                          <?= Form::label('test', 'Tests'); ?>
                          <select multiple="multiple" name="tests[]" id="tests" class="form-control">
                          @foreach($tests as $test)
                            @if($test->active || in_array($test->id,$a_tests))
                              <option value="{{$test->id}}" <?= (in_array($test->id,$a_tests)) ? 'selected="selected"': ''; ?>><?= $test->name." - Version_".$test->version ?></option>
                            @endif
                          @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <?= Form::label('comment', 'Comment'); ?>
                          <?= Form::textarea("comment", isset($consultation->comment) ? $consultation->comment : "", $attributes = array("class"=>"form-control")); ?>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                      <?= Form::close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/consultation.js') }}"></script>
@endsection 
