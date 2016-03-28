@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Patients</div>
                <div class="panel-body">
                    @include('errors.messages')

                    <a href="/follow/add">
                        <button type="button" class="btn btn-primary" aria-label="Left Align">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true">&nbsp;</span>Add Patient
                        </button>
                    </a>
                    <table class="table table-striped">
                      <tr>
                          <th>Username</th>
                          <th>Starting to follow at</th>
                          <th>Ended to follow at</th>
                          <th>Email</th>
                          <th class="text-center">Consultation</th>
                          <th class="text-center">Remove</th>
                      </tr>  
                    <?php 
                        if(count($follows)>0)
                            foreach($follows as $follow): ?>
                            <tr>
                                <td><?= $follow->patient->profile->username; ?></td>
                                <td><?= $follow->dateStartFollowed; ?></td>
                                <td><?= $follow->dateEndFollowed; ?></td>
                                <td><?= $follow->patient->profile->email; ?></td>
                                <td class="text-center">
                                    <a class="text-green" href="/consultation/add/<?= $follow->patient->id ?>">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a class="text-red" href="/follow/remove/<?= $follow->id ?>">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
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
