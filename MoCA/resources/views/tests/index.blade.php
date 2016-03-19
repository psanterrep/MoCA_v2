@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">
                    Your Application's Test Page.
                    <a href="/test/add">Add Test</a>
                    <table class="table table-striped">
                      <tr>
                          <th>Name</th>
                          <th>Version</th>
                          <th>Edit</th>
                      </tr>  
                    <?php foreach($tests as $test): ?>
                        <tr>
                            <td><?php echo $test->name; ?></td>
                            <td><?php echo $test->version; ?></td>
                            <td><a href="/test/edit/<?= $test->id ?>">Edit</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
