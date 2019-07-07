<html>
<head>
  @include( 'layouts.navmenu' )
  <title>Reset Password</title>
</head>
<body>
<div class="container" style="margin-top:100px;">
  <div class="row">
    <div class="col-md-7 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>
            Reset Your Password
          </h3>
        </div>
        <div class="panel-body">
          <form action="" method="POST">
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
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>

            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
            </div>

            </div>
</div>
<div class="form-group">
    <center><input type="submit" value="Reset Password" class="btn btn-default"></center>
</div>
</div>
    </div>
  </div>
</div>
</div>
        @include( 'layouts.footer' )
</body>
</html>
