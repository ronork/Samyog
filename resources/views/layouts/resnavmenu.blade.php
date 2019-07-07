<!-- Fixed navbar -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
@import url('https://fonts.googleapis.com/css?family=Noto+Sans');
</style>
  <script src="{{ asset('js/setup_pusher.min.js') }}"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{ asset('css/samyog.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" ></script>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
      <a class="navbar-brand" style="cursor:default;font-family: 'Noto Sans', sans-serif;font-size:32px;">समयोग&#2404;</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
      </ul>

      <ul class="nav navbar-nav navbar-right">
            <li><a href="/Organization-Profile">Profile</a></li>
            <li><a href="/Organization-Profile/Applications">View Applications</a></li>
        <li><a id="org_logout" href="/logout">Logout</a></li>
      </ul>
    </div>
    <!--/.nav-collapse -->
  </div>
  <?php if(Sentinel::check()){
    $user = Sentinel::getUser();
    $id = $user->id;
    ?>
    <script type="text/javascript">
    var pusher = new Pusher('8f2d4d6df7919aa9d623', {
      cluster: 'ap2'
    });
    var channel = pusher.subscribe('VolunteerChannel{{$id}}');
    channel.bind('OrgNotifier', function(data){
      var info = JSON.stringify(data);
      var obj = JSON.parse(info);
    location.reload();
    });
    var channel2 = pusher.subscribe('AdminOrgChannel{{$id}}');
    channel2.bind('AdminAction', function(data){
      alert("Organization has been blocked by Admin.");
      document.getElementById('org_logout').click();
    });


    </script>
  <?php } ?>
</nav>
<!-- /container -->
