@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><?= Lang::choice('commons.patient',2) ?></div>
                <div class="panel-body">
                    @include('errors.messages')

                    <a href="/follow/add">
                        <button type="button" class="btn btn-primary" aria-label="Left Align">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true">&nbsp;</span><?= Lang::get('follow.add_patient') ?>
                        </button>
                    </a>
                    <table class="table table-striped">
                      <tr>
                          <th><?= Lang::get('commons.username') ?></th>
                          <th><?= Lang::get('follow.starting_follow') ?></th>
                          <th><?= Lang::get('follow.ended_follow') ?></th>
                          <th><?= Lang::get('commons.email') ?></th>
                          <th class="text-center"><?= Lang::get('commons.result') ?></th>
                          <th class="text-center"><?= Lang::choice('commons.consultation',1) ?></th>
                          <th class="text-center"><?= Lang::get('commons.remove') ?></th>
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
                                    <a href="/follow/showresults/<?= $follow->patient->id ?>"><?= Lang::get('commons.view') ?></a>
                                </td>
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
