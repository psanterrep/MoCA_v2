@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">
                    Your Application's Patient Page.
                    <a href="/follow/add">Add Patient</a>
                    <table class="table table-striped">
                      <tr>
                          <th>ID</th>
                          <th>Username</th>
                          <th>Starting to follow at</th>
                          <th>Ended to follow at</th>
                          <th>Email</th>
                          <th>Remove</th>
                      </tr>  
                    <?php foreach($follows as $follow): ?>
                        <tr>
                            <td><?php echo $follow->patient->id; ?></td>
                            <td><?php echo $follow->patient->profile->username; ?></td>
                            <td><?php echo $follow->dateStartFollowed; ?></td>
                            <td><?php echo $follow->dateEndFollowed; ?></td>
                            <td><?php echo $follow->patient->profile->email; ?></td>
                            <td><a href="/follow/remove/<?= $follow->id ?>">Remove</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
