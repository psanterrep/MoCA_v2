@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Patients</div>
                <div class="panel-body">
                    @include('errors.messages')
                    <a href="/follow/add">Add Patient</a>
                    <table class="table table-striped">
                      <tr>
                          <th>ID</th>
                          <th>Username</th>
                          <th>Starting to follow at</th>
                          <th>Ended to follow at</th>
                          <th>Email</th>
                          <th>Consultation</th>
                          <th>Remove</th>
                      </tr>  
                    <?php foreach($follows as $follow): ?>
                        <tr>
                            <td><?php echo $follow->patient->id; ?></td>
                            <td><?php echo $follow->patient->profile->username; ?></td>
                            <td><?php echo $follow->dateStartFollowed; ?></td>
                            <td><?php echo $follow->dateEndFollowed; ?></td>
                            <td><?php echo $follow->patient->profile->email; ?></td>
                            <td><a href="/consultation/add/<?= $follow->patient->id ?>">Add</a></td>
                            <td><a href="/follow/remove/<?= $follow->id ?>">Stop follow</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
