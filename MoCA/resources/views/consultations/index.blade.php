@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">
                    Your Application's Consultation Page.
                    <table class="table table-striped">
                      <tr>
                          <th>Patient Name</th>
                          <th>Type</th>
                          <th>Date</th>
                          <th>Comment</th>
                          <th>Edit</th>
                          <th>Cancel</th>
                      </tr>  
                    <?php foreach($consultations as $consultation): ?>
                        <tr>
                            <td><?php echo isset($consultation->patients()->get()->first()->profile->username) ? $consultation->patients()->get()->first()->profile->username : ""; ?></td>
                            <td><?php echo isset($consultation->type) ? $consultation->type->name: ""; ?></td>
                            <td><?php echo $consultation->date; ?></td>
                            <td><?php echo isset($consultation->comment) ? $consultation->comment : ""; ?></td>
                            <td><a href="/consultation/edit/<?= $consultation->id ?>">Edit</a></td>
                            <td><a href="/consultation/cancel/<?= $consultation->id ?>">Cancel</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
