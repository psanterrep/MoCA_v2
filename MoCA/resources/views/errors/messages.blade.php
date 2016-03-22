@foreach (['warning', 'success', 'info'] as $msg)
  @if(Session::has('alert-' . $msg))
      <div class="alert alert-{{ $msg }}">
          {{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      </div>
  @endif
@endforeach

<?php //  Error from validation ?>
@if (count($errors) > 0 || Session::has('alert-danger'))
<div class="alert alert-danger">
    @if(Session::has('alert-danger'))
        {{ Session::get('alert-danger') }}
    @endif
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    @if (count($errors) > 0 )
      <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
      </ul>
    @endif
</div>
@endif