@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><?= Lang::choice('commons.user',2) ?></div>
                <div class="panel-body">
                    @include('errors.messages')

                    <a href="/user/create">
                        <button type="button" class="btn btn-primary" aria-label="Left Align">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true">&nbsp;</span><?= Lang::get('commons.create')." ".Lang::choice('commons.user',1)  ?>
                        </button>
                    </a>
                    <table class="table table-striped">
                      <tr>
                          <th><?= Lang::get('users.username') ?></th>
                          <th><?= Lang::get('commons.type') ?></th>
                          <th><?= Lang::get('commons.email') ?></th>
                          <th class="text-center"><?= Lang::get('commons.edit') ?></th>
                          <th class="text-center"><?= Lang::get('commons.delete') ?></th>
                      </tr>  
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><?= $user->username; ?></td>
                            <td><?= $user->type->name; ?></td>
                            <td><?= $user->email; ?></td>
                            <td class="text-center">
                                <a class="text-orange" href="/user/edit/<?= $user->id ?>">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                            </td>
                            <td class="text-center">
                                <a class="text-red" href="/user/delete/<?= $user->id ?>">
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
