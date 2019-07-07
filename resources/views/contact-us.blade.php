<!doctype html>
<html>
    <head>

        <title>Contact Us</title>
        @include( 'layouts.navmenu' )
        <style>

        </style>
      </head>
    <body>
        <div class="container" style="width:80%;margin-top:100px;">
          <div class="row">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3>
                    Let's get in touch
                  </h3>
                  <small class="form-text text-muted">We're open for any suggestions or just to have a chat.</small>
                </div>
  <div class="panel-body">
    <form id="conus" action="/Contact-Us" method="POST">
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
{{ csrf_field() }}
      <div class="form-group">
        <label style="font-weight:500" for="v-name">Full Name</label>
        <input type="text" name="g_name" class="form-control" required>
      </div>
      <div class="form-group">
        <label style="font-weight:500" for="v-email">Email address</label>
        <input type="email" name="g_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="abcd@example.com" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>

      <div class="form-group">
        <label style="font-weight:500" for="message-g">Message</label>
        <textarea name="g_message" class="form-control" rows="6" maxlength="2000" required></textarea>
      </div>

      <center><button style="margin:15px;padding:10px;font-size:14px;" type="submit" class="btn btn-default">Send Message<i style="margin:0px 10px 0px 10px" class="glyphicon glyphicon-send"></i></button></center>
    </form>
</div>
</div>
</div>
</div>
</body>
  </html>
