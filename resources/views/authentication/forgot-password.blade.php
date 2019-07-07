<html>
<head>
  @include( 'layouts.navmenu' )
  <title>Recover Password</title>
</head>
<body>
<div class="container" style="margin-top:100px;">
  <div class="row">
    <div class="col-md-7 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>
            Forgot Your Password ?
          </h3>
        </div>
        <div class="panel-body">
          <form action="/forgot-password" method="POST">
            {{ csrf_field() }}

            @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
            @endif

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Enter your registered Email" required>
        </div>
      </div>
      <a href="/forgot-password">Didn't receive confirmation instructions?</a>
</div>
<div class="form-group">
    <center><input type="submit" value="Send Me Reset Password Instructions" class="btn btn-default"></center>
</div>

</div>



    </div>

  </div>
</div>
</div>
        @include( 'layouts.footer' )
</body>
</html>
