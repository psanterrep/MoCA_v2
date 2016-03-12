@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><?= (isset($user)) ? "Edit user" : "Create user" ?></div>
                <div class="panel-body">
                      <form action="/user/save/<?= (isset($user)) ? $user->id : 0 ?>" method="POST">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <div class="form-group">
                              <label for="username">Username</label>
                              <input type="text" class="form-control" name="username" value="<?= (isset($user)) ? $user->username : '' ?>"/>
                          </div>

                          <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" name="email" value="<?= (isset($user)) ? $user->email : '' ?>"/>
                          </div>

                          <button type="submit" class="btn btn-default">Save</button>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
