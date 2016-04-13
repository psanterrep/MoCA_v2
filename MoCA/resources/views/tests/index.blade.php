@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> <?= Lang::choice('commons.test',2) ?></div>
                <div class="panel-body">
                    @include('errors.messages')
                    <a href="/test/add">
                        <button type="button" class="btn btn-primary" aria-label="Left Align">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true">&nbsp;</span> <?= Lang::get('commons.add') ." ". Lang::choice('commons.test',1) ?>
                        </button>
                    </a>
                    <table class="table table-striped">
                      <tr>
                          <th><?= Lang::get('commons.name') ?></th>
                          <th class="text-center"><?= Lang::get('tests.version') ?></th>
                          <th><?= Lang::get('tests.path') ?></th>
                          <th class="text-center"><?= Lang::get('tests.active') ?></th>
                          <th class="text-center"><?= Lang::get('commons.view') ?></th>
                          <th class="text-center"><?= Lang::get('commons.edit') ?></th>
                          <th class="text-center"><?= Lang::get('commons.delete') ?></th>
                      </tr>  
                    <?php foreach($tests as $test): ?>
                        <tr>
                            <td><?= $test->name; ?></td>
                            <td class="text-center"><?= $test->version; ?></td>
                            <td><?= $test->path; ?></td>
                            <td class="text-center"><?= ($test->active)? Lang::get('commons.yes') : Lang::get('commons.no'); ?></td>
                            <td class="text-center"><a href="/test/view/<?= $test->id ?>"><?= Lang::get('commons.view') ?></a></td>
                            <td class="text-center">
                                <a class="text-orange" href="/test/edit/<?= $test->id ?>">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true">
                                </a>
                            </td>
                            <td class="text-center">
                                <a class="text-red" href="/test/delete/<?= $test->id ?>">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
