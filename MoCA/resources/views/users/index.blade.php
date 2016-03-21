@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                <div class="panel-body">
                    @include('errors.messages')
                    <a href="/user/create">New user</a>
                    <table class="table table-striped">
                      <tr>
                          <th>ID</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Type</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </tr>  
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><?php echo $user->id; ?></td>
                            <td><?php echo $user->username; ?></td>
                            <td><?php echo $user->email; ?></td>
                            <td><?php echo $user->type->name; ?></td>
                            <td><a href="/user/edit/<?= $user->id ?>">edit</a></td>
                            <td><a href="/user/delete/<?= $user->id ?>">delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
