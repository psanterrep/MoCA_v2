@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Tests</div>
                <div class="panel-body">
                    @include('errors.messages')
                    <a href="/test/add">
                        <button type="button" class="btn btn-primary" aria-label="Left Align">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true">&nbsp;</span>Add Test
                        </button>
                    </a>
                    <table class="table table-striped">
                      <tr>
                          <th>Name</th>
                          <th class="text-center">Version</th>
                          <th>Path</th>
                          <th class="text-center">Active</th>
                          <th class="text-center">Edit</th>
                      </tr>  
                    <?php foreach($tests as $test): ?>
                        <tr>
                            <td><?= $test->name; ?></td>
                            <td class="text-center"><?= $test->version; ?></td>
                            <td><?= $test->path; ?></td>
                            <td class="text-center"><?= ($test->active)? 'Yes' : 'No'; ?></td>
                            <td class="text-center">
                                <a class="text-orange" href="/test/edit/<?= $test->id ?>">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true">
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
