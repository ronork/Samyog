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
</style>
<?php if(session()->has('AuthorizedVolunteer')){ ?>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <style>
  #notification_dropdown
  {
    padding: 0px;
    width:300%;
  }
  .notifier
  {
    padding: 12px;
    cursor: pointer;
    border-bottom: 0.2px solid #00000059;
  }
  .notifier:hover
  {
    background-color: #8080801a;
  }
  .clearlist
  {
    width:100%;
  }
  @media only screen and (max-width: 770px) and (min-width: 100px)  {
    .clearlist
    {
      width: 33%;
    }
  }

  .clearlist:hover
  {
    cursor: pointer;
  }
  </style>
  <script src="{{ asset('js/setup_pusher.min.js') }}"></script>

  <!-- TODO::Download the source file on deployment -->
  <script src="{{ asset('js/cookie.min.js') }}"></script>


<?php } ?>
@if(Session()->has('DB-Credentials'))
  <script src="{{ asset('js/setup_pusher.min.js') }}"></script>
@endif
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
      @if(!Session()->has('DB-Credentials'))
      <a class="navbar-brand" style="font-family: 'Noto Sans', sans-serif;font-size:32px;" href="/volunteer-search">समयोग&#2404;</a>
      @endif
      @if(Session()->has('DB-Credentials'))
      <a class="navbar-brand" style="font-family: 'Noto Sans', sans-serif;font-size:32px;">समयोग&#2404;</a>
      @endif
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if(Session()->has('DB-Credentials'))
        <li><a id="admin_logout" class="navers" href="/276281/admin/Samyog-DB/logout">Logout</a></li>
        <?php $path = Request::path();?>
        @if((Session()->has('Organization')||Session()->has('Volunteers')||Session()->has('Applications')||Session()->has('Statistics')) && ($path !== "276281/admin/Samyog-DB"))
        <li><a class="navers" href="/276281/admin/Samyog-DB">Go Back</a></li>
        @endif
        @endif
        @if(!Session()->has('DB-Credentials'))
        <li><a class="navers" href="/What-we-do">What we do</a></li>
        <li class="dropdown">
          <a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Organization<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a class="navers" href="/Organization(s)-list/Education">List of Organizations</a></li>
            @if(!session()->has('AuthorizedVolunteer'))
            <li><a class="navers" href="/register">Register/Sign Up</a></li>
            <li><a class="navers" href="/login">Login</a></li>
            @endif
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Volunteer<span class="caret"></span></a>
          <ul class="dropdown-menu">

            <li><a href="/view-applications">View Application Status</a></li>
            <li><a href="/volunteer-search">Search Organizations</a></li>

            <?php if(session()->has('AuthorizedVolunteer')) {?>
              <li><a id="vol_logout" href="/volunteer_logout">Logout</a></li>
            <?php } ?>
          </ul>
        </li>
       <?php if(session()->has('AuthorizedVolunteer')){ ?>
        <li class="dropdown">
          <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Notification <span id="notify_count" style="background-color:#f500009c;" class="badge badge-light">0</span></a>
          <ul id="notification_dropdown" class="dropdown-menu">
         </ul>
        </li>
      <?php } ?>

        <li><a class="navers" href="/Contact-Us">Contact Us</a></li>
      </ul>
    </div>
  </div>
  <?php if(session()->has('AuthorizedVolunteer')){
    $vol_id = session('AuthorizedVolunteer');
    $id = $vol_id['vol_id'];?>

  <script type="text/javascript">

 var count=0;
 if(parseInt(Cookies.get('count'))>0)
   count=parseInt(Cookies.get('count'));
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

window.onload = addNotifications();

function addNotifications()
{
  document.getElementById("notify_count").innerHTML=count.toString();
  var ul=document.getElementById('notification_dropdown');

  for(i=1;i<=count;i++)
  {
    var li=document.createElement('li');
    var k = "Notification"+i;
    li.classList.add('notifier');
    li.innerHTML="<a style='padding: 3px 3px;' href='/view-applications'>"+Cookies.get(k)+"</a>";
    li.style.width = "100%";
    ul.appendChild(li);
  }
  if(count>0){
  var li=document.createElement('li');
  li.classList.add('clearlist');
  li.innerHTML="<a onclick='markread()'><center><i class='glyphicon glyphicon-trash'></i></center></a>";
  ul.appendChild(li);
  }
}

function markread()
{
   $( ".notifier" ).remove();
   $( ".clearlist" ).remove();
   document.getElementById("notify_count").innerHTML=0;
    for(i=1;i<=count;i++)
    {
      var k = "Notification"+i;
      Cookies.remove(k);
    }
    count=0;
    Cookies.remove('count');
}


  var pusher = new Pusher('8f2d4d6df7919aa9d623', {
    cluster: 'ap2',
    encrypted: true
  });
  var channel = pusher.subscribe('OrganizationChannel{{$id}}');
  channel.bind('ApplicationStatusUpdated', function(data){
        count+=1;
        var thebody;
        var k = "Notification"+count;
        var dater = count + "Creation";
        Cookies.set('count',count.toString(),{ expires:365});
        var info = JSON.stringify(data);
        var obj = JSON.parse(info);

        if(obj.status === "Rejected")
          thebody = "Your application to " +obj.org_name+" has been "+obj.status;
        else if(obj.status === "Accepted-WC")
          thebody = "Your application to "+obj.org_name+" is waiting for confirmation";
        else if(obj.status === "Closed")
            thebody = "Your application to "+obj.org_name+" has been Closed"
        else
         thebody = "Your application to " +obj.org_name+" has been Reviewed";
       Cookies.set(k,thebody,{ expires: 365});
       $( ".notifier" ).remove();
       $( ".clearlist" ).remove();
       addNotifications();
        notifier(thebody);
  });
  var volAdminChannel = pusher.subscribe('AdminVolChannel{{$id}}');
  volAdminChannel.bind('AdminAction', function(data){
    alert("You have been blocked by Admin.");
    document.getElementById('vol_logout').click();
  });
  </script>
<?php } ?>
@endif

@if(Session()->has('DB-Credentials'))
<script type="text/javascript">
var pusher = new Pusher('8f2d4d6df7919aa9d623', {
  cluster: 'ap2',
  encrypted: true
});
<?php $db_data = Session()->get('DB-Credentials'); ?>
var AdminMasterChannel = pusher.subscribe('AdminMasterChannel{{$db_data['unique_id']}}');
AdminMasterChannel.bind('AdminAction', function(data){
  alert("You have been forced Logout by Master.");
  document.getElementById('admin_logout').click();
});

</script>
@endif


</nav>
