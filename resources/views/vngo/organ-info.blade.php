<!Doctype html>
<html>
<head>
  @include( 'layouts.resnavmenu' )
<title>
Profile
</title>
<style>
.pac-container:after {
 background-image: none !important;
 height: 0px;
  }
#changemade
{
  display:none;
}
.editor
{
  border:none;
  padding:7px;
  font-size: 17px;
  float:right;
}
#eedit
{
  text-align: center;
  display:none;
}
.editor:focus,.editor:active {
   outline: none !important;
}
.editor:hover
{
  color:rgba(11, 121, 11, 0.75);
}
</style>
</head>
<body>
  <div class="container" style="width:80%;margin-top:90px;">
    <div class="row">
      @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
          </div>
      @endif
  <div class="panel panel-default">
    <div class="panel-heading">
    <center><h1 style="font-size:25px;" class="panel-title">{{$org_data->name_of_org}}<a class="editor" onclick="enable_edit()"><i class="glyphicon glyphicon-pencil"></i></a></h1></center>
  </div>
  <div id="eedit" class="alert alert-success">
    Editing Enabled.
      </div>
  <div style="margin-top: 20px;" class="panel-body">

    <form action="/update-profile" method="POST">
                  {{ csrf_field() }}
    <div class="form-group">
      <label style="font-weight:500" >Name of the head of the Organization</label>
      <input id="org-head" style="background-color:white;" class="form-control" onfocusout="check(this.id)" name="org_head" value="{{$org_data->name_of_head}}" readonly>
    </div>
    <div class="form-group">
      <label style="font-weight:500">Location</label>
      <input id="lautocomplete" style="cursor:default;background-color:white;" class="form-control" onfocusout="check(this.id)" name="org_loc" value="{{$org_data->location}}" disabled>
    </div>
    <div class="form-group">
      <label style="font-weight:500">About your Organization</label>
      <textarea id="org_about" style="background-color:white;" class="form-control" onfocusout="check(this.id)" name="org_abt" rows="5" readonly>{{$org_data->about_org}}</textarea>
    </div>

    <div class="form-group">
      <label style="font-weight:500">
        <div class="dropdown">
          <span>Number of Applications: </span><button class="btn btn-default dropdown-toggle" type="button"  data-toggle="dropdown">
            <span style="margin-right:7px;" id="status">All</span><span class="caret"></span></button>
            <ul  class="dropdown-menu dropdown-menu-right">
              <li><a onclick="changeStatus('All')">All</a></li>
              <li><a onclick="changeStatus('Submitted')" >Submitted</a></li>
              <li><a onclick="changeStatus('Pending')" >Pending</a></li>
              <li><a onclick="changeStatus('Accepted-WC')" >Accepted-WC</a></li>
              <li><a onclick="changeStatus('Confirmed')" >Confirmed</a></li>
              <li><a onclick="changeStatus('Closed')" >Closed</a></li>
              <li><a onclick="changeStatus('Rejected')" >Rejected</a></li>
            </ul>
          </div></label>
      <input id="count_app" style="background-color:white;" class="form-control" value="{{$total_count}}" readonly>
    </div>
    <script type="text/javascript">
    function changeStatus(status)
    {
       document.getElementById("status").innerHTML = status;
       if(status==="All")
        document.getElementById("count_app").value = "{{$total_count}}";
       else if(status==="Submitted")
        document.getElementById("count_app").value = "{{$count_of_submitted}}";
       else if(status==="Pending")
        document.getElementById("count_app").value = "{{$count_of_pending}}";
       else if(status==="Accepted-WC")
        document.getElementById("count_app").value = "{{$count_of_accepted_wc}}";
       else if(status==="Confirmed")
        document.getElementById("count_app").value = "{{$count_of_confirmed}}";
       else if(status==="Closed")
        document.getElementById("count_app").value = "{{$count_of_closed}}";
       else if(status==="Rejected")
        document.getElementById("count_app").value = "{{$count_of_rejected}}";
    }
    </script>
    <input style="display:none" id="nlatitude" type="text" name="lat" class="form-control">
    <input style="display:none" id="nlongitude" type="text" name="lng" class="form-control">

</div>
<div id="changemade"><center><button type="submit" style="margin:15px;padding:10px;font-size:14px;" class="btn btn-default">Save Changes</button>OR<a style="margin:15px;padding:10px 15px 10px 15px;font-size:14px;" onclick="revert('{{$org_data->name_of_head}}','{{$org_data->email}}','{{$org_data->about_org}}','{{$org_data->location}}')"  class="btn btn-danger">Revert</a></center>
</form>
</div>
</div>
</div>
</div>
<script>
function enable_edit()
{
  document.getElementById('org-head').removeAttribute('readonly');
  document.getElementById('org_about').removeAttribute('readonly');
  document.getElementById('lautocomplete').removeAttribute('disabled');
  document.getElementById("eedit").style.display="block";
  document.getElementById("changemade").style.display="block";
  setTimeout(function() { document.getElementById("eedit").style.display="none"; }, 2000);
}
function check(a)//function to check if changes have been made
{
  if(a=='lautocomplete')
  codeAddress();

  var ids=['org-head','org_about','lautocomplete'];
  var values = ['{{$org_data->name_of_head}}','{{$org_data->about_org}}','{{$org_data->location}}'];
    var chng="none";//for appearing and disappearing buttons
  for(i=0;i<3;i++)
  {
    var a = document.getElementById(ids[i]).value;
    if(a!=values[i])
    {
      chng="block";
      break;
    }
  }
    document.getElementById("changemade").style.display=chng;
}
function revert(h,e,a,ln)
{
document.getElementById("org-head").value = h;
document.getElementById("org_about").value  = a;
document.getElementById("lautocomplete").value  = ln;
document.getElementById("changemade").style.display="none";
}

//----------AUTO-COMPLETION-------------------------
var placeSearch, autocomplete;

function initAutocomplete() {

 var myplace = document.getElementById('lautocomplete');

 var options = {
   componentRestrictions: {country: 'in'}
 };

autocomplete = new google.maps.places.Autocomplete(myplace,options);
}
//function to get the latitude and longitude in case autocompletion is used
function codeAddress() {
  geocoder = new google.maps.Geocoder();
  var address = document.getElementById("lautocomplete").value;
  geocoder.geocode( { 'address': address}, function(results, status) {
    document.getElementById('nlatitude').value = results[0].geometry.location.lat();
    document.getElementById('nlongitude').value = results[0].geometry.location.lng();
  });
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkpNRsMBeDOKXS8qcJBryjU5s0VDh7Us8&libraries=places&callback=initAutocomplete"
    async defer></script>
</body>
</html>
