<!doctype html>
<html>
    <head>

        <title>Admin-Login</title>
        @include( 'layouts.navmenu' )
      </head>
      <body>
        <div class="container" style="width:80%;margin-top:100px;margin-bottom:60px;">
          <div class="row">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3>
                   Admin Login
                  </h3>
                </div>
  <div class="panel-body">
<form action="/276281/admin/login" method="POST">
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
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        <input type="text" name="admin_name" class="form-control" placeholder="Name" value="{{ old('admin_name') }}" required>
</div>
</div>
<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
    <input type="text" name="db_name" class="form-control" placeholder="Database Name" value="{{ old('db_name') }}" required>
</div>
</div>

<div class="form-group">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
  <input type="password" name="db_password" class="form-control" placeholder="Database Password" required>
</div>
</div>

 <center>
 <button style="margin-top:30px;" type="submit" class="btn btn-default">Login</button>
</center>
</form>
</div>
</div>
</div>
</div>
  @include( 'layouts.footer' )
      </body>
      </html>
