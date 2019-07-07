<!-- Fixed navbar -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
@import url('https://fonts.googleapis.com/css?family=Noto+Sans');

.footer {
position: fixed;
bottom: 0;
margin-top: 20px;
width: 100%;
/* Set the fixed height of the footer here */
height: 50px;
background-color: #f5f5f5;
}
#notification_dropdown
{
  padding: 0px;
  width:250%;
}
.notifier
{
  padding: 10px;
  cursor: pointer;
}
.notifier:hover
{
  background-color: #8080801a;
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{ asset('css/samyog.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" ></script>



<!-- getting the logged in volunteer -->
<?php $vol_id = session('AuthorizedVolunteer');
      $id = $vol_id['vol_id'];
?>

<script src="{{ asset('js/setup_pusher.min.js') }}"></script>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
      <a class="navbar-brand" style="font-family: 'Noto Sans', sans-serif;font-size:32px;" href="/volunteer-search">समयोग&#2404;</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Organization<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/Organization(s)-list">List Organizations</a></li>
            <li><a href="/volunteer-search">Search</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Notification <span id="notify_count" style="background-color:#f500009c;" class="badge badge-light">0</span></a>
          <ul id="notification_dropdown" class="dropdown-menu">
         </ul>
        </li>



        <li><a href="/volunteer_logout">Logout</a></li>
      </ul>
    </div>
    <!--/.nav-collapse -->
  </div>
  <script type="text/javascript">
  var count=0;
  var vol = {{$id}};

function notifier(thebody,theTitle="Application Status")
{
if ('Notification' in window)
 Notification.requestPermission();

  var options={
    body:thebody,
    icon:"{{ asset('img/notification.png') }}",
    tag:"NEVERGRIND",
  };

  if (Notification.permission === "granted") {
  var n = new Notification(theTitle,options);
  setTimeout(n.close.bind(n), 5000);
}
}

  var pusher = new Pusher('8f2d4d6df7919aa9d623', {
    cluster: 'ap2'
  });
  var channel = pusher.subscribe('OrganizationChannel{{$id}}');
  channel.bind('ApplicationStatusUpdated', function(data){
        count+=1;
        var thebody;
        document.getElementById("notify_count").innerHTML=""+count;
        var info = JSON.stringify(data);
        var obj = JSON.parse(info);
        console.log(obj.status);
        var ul=document.getElementById('notification_dropdown');
        var li=document.createElement('li');
        li.classList.add('notifier')
        if(obj.status != "Pending"){
          thebody = "Your application to " +obj.org_name+" has been "+obj.status;
         li.innerHTML=thebody;}
        else{
         thebody = "Your application to " +obj.org_name+" has been Reviewed";
         li.innerHTML=thebody;}

        li.style.width = "100%";
        ul.appendChild(li);
        notifier(thebody);

  });
  </script>
</nav>
<!-- /container -->
