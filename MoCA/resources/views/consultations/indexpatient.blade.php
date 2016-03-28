@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Consultations</div>
                <div class="panel-body">
                    <div id="consultationList">
                        @include('errors.messages')
                        <?= Form::token();?>
                        <table class="table table-striped">
                            <tr>
                                <th>Doctor</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th></th>
                            </tr>  
                            <?php foreach($consultations as $consultation): ?>
                            <tr>
                                <td><?= isset($consultation->doctors()->get()->first()->name) ? $consultation->doctors()->get()->first()->name : ""; ?></td>
                                <td><?= $consultation->type->name ?></td>
                                <td><?= $consultation->date; ?></td>
                                <td>
                                <?php foreach ($consultation->tests()->get() as $test): ?>
                                    <?php if (is_null($test->result)): ?>
                                        <button class="btn btn-primary" onclick="takeTest(<?= $consultation->id ?>,<?= $test->id ?>);" >Start <?= $test->name ?></button>
                                    <?php else: ?>
                                        Passed
                                    <?php endif ?>
                                <?php endforeach ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/consultation.js') }}"></script>
@endsection 
