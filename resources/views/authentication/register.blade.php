<!doctype html>
<html>
    <head>

        <title>Register</title>
        @include( 'layouts.navmenu' )
        <style>
        .pac-container:after {
         background-image: none !important;
         height: 0px;
          }
          select {
  -webkit-appearance: none;
  -webkit-border-radius: 0px;
}
</style>
      </head>
      <body>
        <div class="container" style="width:80%;margin-top:100px;margin-bottom:60px;">
          <div class="row">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3>
                    Organization Registeration
                  </h3>
                </div>
  <div class="panel-body">
<form action="/register" method="POST">
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
              <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
              <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="org@example.com" required>
      </div>

    </div>

    <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        <input type="text" name="name_of_org" value="{{ old('name_of_org') }}" class="form-control" placeholder="Name of the Organization" required>
</div>

</div>

<div class="form-group">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-user"></i></span>
  <input type="text" name="name_of_head" value="{{ old('name_of_head') }}" class="form-control" placeholder="Name of the head of the Organization" required>
</div>

</div>

<div class="form-group">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
   <select style="font-weight:400;color:#999999;" name="category" class="form-control" id="organizationCategory" required>
    <option value="" disabled selected>Select Category</option>
     <option value="Education" value="">Education</option>
     <option value="HealthCare">Health Care</option>
     <option value="Sanitation">Sanitation</option>
     <option value="AnimalCare">Animal Care</option>
   </select>
</div>
</div>


<div class="form-group">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
  <input type="text" id="lautocomplete" name="location" value="{{ old('location') }}" class="form-control" onfocusout="codeAddress()" placeholder="Enter your location" required>
</div>
  <a style="cursor:default;" onclick="generateLocation()">Click to auto-generate your location.</a>
</div>

<div class="form-group">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
  <input type="password" name="password" class="form-control" placeholder="Password" required>
</div>

</div>

<div class="form-group">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
  <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>

</div>
</div>
<div class="form-group">
  <textarea class="form-control" name="about_org" maxlength="3000"  rows="6" placeholder="Tell us about your organization" required>{{ old('about_org') }}</textarea>
</div>
  <input style="display:none" id="nlatitude" type="text" name="lat" class="form-control">
  <input style="display:none" id="nlongitude" type="text" name="lng" class="form-control">
 <center>
 <button style="margin-top:30px;" type="submit" class="btn btn-default">Register</button>
</center>
</form>
</div>
</div>
</div>
</div>

<script type="text/javascript">
//----------AUTO-GENERATION-------------------------
function generateLocation() {
if (navigator.geolocation) {
    document.getElementById('lautocomplete').value = "We are working on it.....";
    navigator.geolocation.getCurrentPosition(displayAddress);
}else {
    document.getElementById('lautocomplete').value = "Sorry Geolocation is not supported by your browser:/";
}
 }
 function displayAddress(position) {
   var lat = position.coords.latitude;
   var lng = position.coords.longitude;
   var latlng = new google.maps.LatLng(lat, lng);
   var geocoder = geocoder = new google.maps.Geocoder();
   geocoder.geocode({ 'latLng': latlng }, function (results, status) {
       if (status == google.maps.GeocoderStatus.OK) {
           if (results[0]) {
              document.getElementById('lautocomplete').value=results[0].formatted_address;
           }
       }
   });
                 document.getElementById('nlatitude').value = lat;
                document.getElementById('nlongitude').value = lng;

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
                    @include( 'layouts.footer' )
      </body>
      </html>
