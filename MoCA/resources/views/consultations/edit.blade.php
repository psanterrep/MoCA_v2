@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><?= Lang::get('consultations.edit_consultation_for') ." ". $consultation->patients()->get()->first()->profile->username ?></div>
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
                          <?= Form::label('date', Lang::get('commons.date')); ?>
                          <?= Form::date("date", $consultation->date, $attributes = array("class"=>"form-control")); ?>
                        </div>
                        <div class="form-group">
                          <?= Form::label('type', Lang::get('consultations.consultation_type')); ?>
                          <?= Form::select("type", $a_types, $consultation->type->id, ['placeholder' =>  Lang::get('consultations.choose_one'), 'class'=>'form-control','data-type'=>'consultation-'.$consultation->id]); ?>
                        </div>
                        <div class="form-group">
                          <?= Form::label('test',  Lang::choice('commons.test',2)); ?>
                          <select multiple="multiple" name="tests[]" id="tests" class="form-control">
                          @foreach($tests as $test)
                            @if($test->active || in_array($test->id,$a_tests))
                              <option value="{{$test->id}}" <?= (in_array($test->id,$a_tests)) ? 'selected="selected"': ''; ?>><?= $test->name." - Version_".$test->version ?></option>
                            @endif
                          @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <?= Form::label('comment',  Lang::get('consultations.comment')); ?>
                          <?= Form::textarea("comment", isset($consultation->comment) ? $consultation->comment : "", $attributes = array("class"=>"form-control")); ?>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right"><?= Lang::get('commons.save'); ?></button>
                      <?= Form::close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/consultation.js') }}"></script>
@endsection 
