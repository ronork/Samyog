<html>
<head>
  @include( 'layouts.navmenu' )
  <title>View Application Status</title>
</head>
<body>
<div class="container" style="margin-top:100px;">
  <div class="row">
    <div class="col-md-7 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>
            Authorize Yourself
          </h3>
        </div>
        <div class="panel-body">
          <form action="/view-applications" method="POST">
            {{ csrf_field() }}

              @if(session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
                  </div>
              @endif

            @if(session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
            @endif

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Enter your Email" required>
        </div>

      </div>
<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
    <input type="password" name="password" class="form-control" placeholder="Enter your Password" required>
</div>
</div>
<a href="/volunteer/forgot-password">Forgot Your Password?</a>
<br><br>
<div class="form-group">
    <center><input type="submit" value="Submit" class="btn btn-default"></center>
</div>

</div>



    </div>

  </div>
</div>
</div>
        @include( 'layouts.footer' )
</body>
</html>
