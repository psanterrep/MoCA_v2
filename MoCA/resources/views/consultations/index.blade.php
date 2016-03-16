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
                          <th>ID</th>
                          <th>Patient Name</th>
                          <th>Date</th>
                          <th>Comment</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </tr>  
                    <?php foreach($consultations as $consultation): ?>
                        <tr>
                            <td><?php echo $consultation->id; ?></td>
                            <td><?php echo isset($consultation->patients()->get()->first()->profile->username) ? $consultation->patients()->get()->first()->profile->username : ""; ?></td>
                            <td><?php echo $consultation->date; ?></td>
                            <td><?php echo $consultation->comment; ?></td>
                            <td><a href="/consultation/edit/<?= $consultation->id ?>">edit</a></td>
                            <td><a href="/consultation/delete/<?= $consultation->id ?>">delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
