@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                <div class="panel-body">
                    @include('errors.messages')

                    <a href="/user/create">
                        <button type="button" class="btn btn-primary" aria-label="Left Align">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true">&nbsp;</span>New user
                        </button>
                    </a>
                    <table class="table table-striped">
                      <tr>
                          <th>Username</th>
                          <th>Type</th>
                          <th>Email</th>
                          <th class="text-center">Edit</th>
                          <th class="text-center">Delete</th>
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
