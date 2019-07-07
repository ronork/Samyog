<html>
<head>
  @include( 'layouts.navmenu' )
  <title>Password Setup</title>
</head>
<body>
<div class="container" style="margin-top:100px;">
  <div class="row">
    <div class="col-md-7 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>
            Volunteer Registeration
          </h3>
        </div>
        <div class="panel-body">
          <form action="/volunteer-password-setup" method="POST">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                  @foreach($errors->all() as
                  $error)
                  <li>
                    {{ $error }}
                  </li>
                  @endforeach
                </ul>
                </div>
              @endif
            {{ csrf_field() }}
<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
    <input type="password" name="password" class="form-control" placeholder="New Password" size="6" required>
</div>

</div>
<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
</div>

</div>
<div class="form-group">
    <center><input type="submit" value=Register class="btn btn-default"></center>
</div>

</div>
    </div>
  </div>
</div>
</div>
        @include( 'layouts.footer' )
</body>
</html>
