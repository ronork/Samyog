<!Doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>समयोग&#2404;</title>
        @include( 'layouts.navmenu' )
        <style>

            .content {
              color: #636b6f;
              font-family: 'Noto Sans', sans-serif;
              text-align: center;
            }

            .title {
                font-size: 74px;
                cursor: default;
            }
            .pac-container:after {
             background-image: none !important;
             height: 0px;
              }
              .getins
              {
                border:solid rgba(0, 0, 0, 0.3) 1px;
                width:100%;
                padding:30px;
                font-size:18px;
              }
              @media screen and (max-width: 450px){
                .title {
                    font-size: 50px;
                }
                .getins
                {
                  padding:20px;
                }

              }
        </style>
    </head>
    <body>
                  <div style="margin-top:60px;margin-bottom:-60px;" class="content">
                    @if(session('success'))
                    <div class="alert alert-success">
                      {{ session('success') }}
                        </div>
                    @endif
                    @if(session('info'))
                    <div class="alert alert-info">
                      {{ session('info') }}
                        </div>
                    @endif

                  @if(session('error'))
                  <div class="alert alert-danger">
                    {{ session('error') }}
                  </div>
                  @endif
                  </div>
            <div style="margin-top:180px;margin-bottom:50px;" class="content">
                <div class="title">
                    समयोग&#2404;
                </div>
            </div>

            <div style="margin-top:25px;margin-bottom:100px;" class="container">
              <form id="searcher" action="/volunteer-search" method="POST">
                {{ csrf_field() }}
            <div class="form-group">
            <div class="input-group">
              <input class="getins" type="text" id="lautocomplete" name="vol_location" onfocusout="codeAddress()" placeholder="Enter your location" required>
              <span class="input-group-addon"><i style="padding:15px;" class="glyphicon glyphicon-globe"></i></span>
            </div>
              <a style="cursor:default;"onclick="generateLocation()">Click to auto-generate your location.</a>
            </div>
             <br>
            <div class="form-group">
            <div class="input-group">
              <input class="getins" type="number" min="1" max="1000"  name="vradius" placeholder="Specify the radius(in km)" required>
              <span class="input-group-addon"><i style="padding:15px;" class="glyphicon glyphicon-filter"></i></span>
            </div>
            </div>
             <!--getting volunteer's latitude and longitude -->

            <input style="display:none" id="vlatitude" type="text" name="vlat" class="form-control">
            <input style="display:none" id="vlongitude" type="text" name="vlng" class="form-control">

            <center>
            <div class="btn-group">
            <button style="margin-top:20px;" id="search-b" class="btn btn-default btn-lg" type="submit" disabled>Search<i style="font-size:15px;margin-left:10px" class="glyphicon glyphicon-search"></i></button>
            </div>
          </center>
          </form>
        </div>

            <script type="text/javascript">
            var ulatitude = -1;
            var ulongitude = -1;//for storing user's latitude nad longitude
            var check=0;
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
               var geocoder  = new google.maps.Geocoder();
               geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                   if (status == google.maps.GeocoderStatus.OK) {
                       if (results[0]) {
                          document.getElementById('lautocomplete').value=results[0].formatted_address;
                       }
                   }
               });
               ulatitude = lat;
               ulongitude = lng;
               postIt();
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
              document.getElementById("search-b").disabled = true;
              if(document.getElementById("lautocomplete").value!= "")
               {
                geocoder = new google.maps.Geocoder();
                var address = document.getElementById("lautocomplete").value;
                geocoder.geocode( { 'address': address}, function(results, status) {
                  ulatitude = results[0].geometry.location.lat();
                  ulongitude = results[0].geometry.location.lng();
                });
                setTimeout(postIt, 1500);
              }
              }
             function postIt()
             {
               if(ulatitude!=-1 && ulongitude !=-1){
               document.getElementById('vlatitude').value = ulatitude;
               document.getElementById('vlongitude').value = ulongitude;
               document.getElementById("search-b").disabled = false;
              }
             }
            </script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkpNRsMBeDOKXS8qcJBryjU5s0VDh7Us8&libraries=places&callback=initAutocomplete"
                        async defer></script>
        @include( 'layouts.footer' )
    </body>
</html>
