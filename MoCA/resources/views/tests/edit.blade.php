@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><?= isset($test) ? "Edit" : "Add"; ?> <?= Lang::get('tests.a_test') ?></div>
                <div class="panel-body">
                    @include('errors.messages')
                    <?php 
                        $id = isset($test) ? $test->id : 0; 
                        $edit = isset($test) ? $test->isLatestVersion() : true; 
                      ?>
                      Instruction for the test file
                      <ul>
                          <?php if (App::getLocale()== 'fr'): ?>
                              <li>Vérifiez que vous avez ajouter toutes les plugins de JsPsych dans le haut de votre page HTML</li>
                              <li>Vérifiez que vous avez bien l'appel a la fonction "saveResult(Result)" dans le bloc debrief et ou le Result est un tableau de vos résultats</li>
                          <?php else: ?>
                              <li>Be sure every plugins is loaded at the top of you HTML file</li>
                              <li>Be sure you have the call "saveResult(Result)" in your debrief block and where result is an array of your result"</li>
                          <?php endif ?>
                      </ul>
                     <?= Form::open(array("url" => "/test/save/{$id}","method" => "POST", 'files' => true)); ?>
                          <div class="form-group">
                              @if($edit)
                                  <?= Form::label('name', Lang::get('commons.name')); ?>
                                  <?= Form::text('name', isset($test) ? $test->name : '', $attributes = array("class"=>"form-control")); ?>
                              @else
                                  <?= Form::label('name', Lang::get('commons.name').' : '. $test->name); ?>
                                  <?= Form::hidden('name', isset($test) ? $test->name : '', $attributes = array("class"=>"form-control")) ?>
                              @endif
                          </div>
                          <div class="form-group">
                              <?php $version =  isset($test) ? $test->version : '1'; ?>
                              <?= Form::label('', Lang::get('tests.version').' '.$version ) ?>
                          </div>
                          <div class="form-group">
                              <?= Form::checkbox('active', null, isset($test) ? $test->active : true) ?>
                              <?= Form::label('active', Lang::get('tests.active')) ?>
                          </div>
                          <div class="form-group">
                              <?= Form::label('file', Lang::get('tests.file_path')."(html)") ?>
                              <?php if(isset($test)): ?>
                                  <br  />
                                  <p>
                                  <?=  Lang::get('tests.current_path') ." ". $test->path; ?>
                                  </p>
                              <?php endif; ?>
                              @if($edit)
                                  <?= Form::file('file') ?>
                              @endif
                          </div>
                          @if($edit)
                              <div class="form-group">
                                  <?= Form::label('file', Lang::get('tests.test_images')." (jpeg,bmp,png)") ?>
                                  <?= Form::file('images[]', array('multiple'=>true)) ?>
                              </div>
                          @endif
                      <button type="submit" class="btn btn-primary"><?= Lang::get('commons.save') ?></button>
                      <?= Form::close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
