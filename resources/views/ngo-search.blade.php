<!doctype html>
<html>
    <head>

        <title>NGO-Search</title>
          @include( 'layouts.navmenu' )
          <script type="text/javascript">
           var mark = 1;
          $(document).ready(function() {
              $('#multiselect').multiselect({
                  buttonWidth: '100%'
              });
              $('#multiselect1').multiselect({
                  buttonWidth: '100%'
              });
              $('#multiselect2').multiselect({
                  buttonWidth: '100%'
              });
              $('#multiselect3').multiselect({
                  buttonWidth: '100%'
              });
          });
          function onapply()
          {
          document.getElementById('f-elements').style.display = 'block';
          document.getElementById('s-btn').style.display = 'block';
          document.getElementById('a-btn').style.display = 'none';
          // document.getElementById('ngo-select').style.display = 'none';
          document.getElementById('f-h').style.display = 'none';
          document.getElementById("form-h").innerHTML = "Volunteer Application Form";
          }
          function inform(a)
          {
            if(a=="Yes")
            {
              document.getElementById('pexp').disabled = false;
            }
            else {
              document.getElementById('pexp').disabled = true;
            }
          }
          </script>
          <style>
          #org_filter
          {
            font-size:1.1em;
            margin-bottom: 10px;
        }
          </style>
          <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" type="text/css"/>
      </head>
      <body>


<div style="margin-top:80px;text-align:center;"class="container">

    <div class="dropdown">
    <button style="font-size: 17px;padding: 8px;"  class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
        <i style="margin:3px 5px 0px 0px;" class="glyphicon glyphicon-filter"></i>{{$category}}
    <span class="caret"></span></button>
    <ul style="font-size:1.1em;left: 43%;" class="dropdown-menu">
      <li><a href="/Search/Education">Education</a></li>
      <li><a href="/Search/HealthCare">Health Care</a></li>
      <li><a href="/Search/AnimalCare">Animal Care</a></li>
      <li><a href="/Search/Sanitation">Sanitation</a></li>
    </ul>
  </div>

</div>

<?php if (session()->has('vlat')){?>


    <?php $latitudeFrom = session('vlat'); ?>
    <?php $longitudeFrom = session('vlng'); ?>
    <?php $prefdist = session('vradius'); ?>

    <?php
      $earthRadius = 6371;
      $check=-1;
      $check2=-1;
      $k = 0;

      //Function to request google map api to get the driving distance between given two locations

      function GetDrivingDistance($lat1, $lat2, $long1, $long2)
     {
         $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=en-GB";
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
         $response = curl_exec($ch);
         curl_close($ch);
         $response_a = json_decode($response, true);
         $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
         $time = $response_a['rows'][0]['elements'][0]['duration']['text'];

         return array('distance' => $dist, 'time' => $time);
     }
    foreach($all_activated_records as $ngo)
    {
      // convert from degrees to radians
      $latFrom = deg2rad($latitudeFrom);
      $lonFrom = deg2rad($longitudeFrom);
      $latTo = deg2rad($ngo->lat);
      $lonTo = deg2rad($ngo->lng);

      $latDelta = $latTo - $latFrom;
      $lonDelta = $lonTo - $lonFrom;

      $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

      $reqdist = $angle * $earthRadius;?>
       <?php if($reqdist<=$prefdist){$check=1; ?>
                <?php if($check2==-1){$check2=8;?>


         <div class="page-header" style="margin-top:10px;">
          <h1 id="f-h" style="font-weight:400;"><center>Organization(s) near you</center></h1>
          </div>
          <?php } ?>
          <?php $ngos[$k] = $ngo->name_of_org;
                $ngos_id[$k] = $ngo->id;
          $k+=1;  ?>
         <div id="search-res" class="container">
         <div class="panel panel-default">
         <!-- Default panel contents -->
         <div class="panel-heading" style="text-transform:capitalize;font-size:2em;">{{$ngo->name_of_org}}</div>
         <div class="panel-body">
           <h4>About the organization</h4>
           <p style="text-align: justify;">{{$ngo->about_org}}</p>

           <!-- <h4>Location</h4>
           <p>{{$ngo->location}}</p>
           <h4>Exact Distance<span style="font-weight:400;font-size:14px;">(in case you fly:)</span></h4>
           <p>{{round($reqdist,1)}}<b>km</b></p> -->
           <?php
           $dist = GetDrivingDistance($latitudeFrom, $ngo->lat, $longitudeFrom, $ngo->lng);
           echo '<h4>Distance on Road:</h4> <b>'.$dist['distance'].'</b><br><h4>Travel time duration:</h4> <b>'.$dist['time'].'</b>';
           $link = "https://www.google.es/maps/dir/".$latitudeFrom.",".$longitudeFrom."/".$ngo->lat.",".$ngo->lng;
           ?>
           <center><p><?php echo "<a target='_blank' style='margin:10px;' class='btn btn-default btn-md' role='button' href='$link'>View it in Map</a>"; ?></p></center>

          </div>
       </div>
     </div>

<?php }}?>

   <!-- Provides links for pages in case exceeds per-page limit -->
   <div style="text-align:center">{{ $all_activated_records->links() }}</div>

 <?php if($check==1){ ?>
   <div class="container">
   <div class="panel panel-default">
   <!-- Default panel contents -->
   <div id="form-h" class="panel-heading" style="font-size:2em;">Select the Organization(s)</div>
   <div class="panel-body">
   <form action="/volunteer-info/{{$category}}" method="POST" >
     {!! csrf_field() !!}
     <div style="display:none" id="f-elements">
     <div class="form-group">
       <label style="font-weight:500" for="v_name">Name</label>
       <input type="text" name="v_name" class="form-control" required>
     </div>
     <div class="form-group">
       <label style="font-weight:500" for="v_email">Email Address</label>
       <input type="email" name="v_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="abcd@example.com" required>
       <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
     </div>
       <div class="form-group">
       <label style="font-weight:500" for="gender">Gender</label>
        <select class="form-control" name="gender" required>
           <option>Male</option>
           <option>Female</option>
           <option>Other</option>
          </select>
        </div>
     <div class="form-group">
       <label style="font-weight:500" for="prev_v">Have you previously volunteered for any organization?</label>
       <select onchange="inform(this.value)" name="prev_v" class="form-control" required>
         <option value="Yes">Yes</option>
         <option value="No">No</option>
       </select>
     </div>

     <div class="form-group">
       <label style="font-weight:500" for="past-exp">If yes, give brief details.</label>
       <textarea id="pexp" name="exp_past" class="form-control" rows="3" maxlength="2000" required></textarea>
     </div>
     <div class="form-group">
       <label style="font-weight:500" for="days-available">Available Days</label>
      <select name="days[]" id="multiselect" multiple="multiple" required>
      <option>Monday</option>
      <option>Tuesday</option>
      <option>Wednesday</option>
      <option>Thursday</option>
      <option>Friday</option>
      <option>Saturday</option>
      <option>Sunday</option>
      </select>
     </div>
     <div class="form-group">
       <label style="font-weight:500" for="times-available">Available Times</label>
       <select name="times[]" id="multiselect1" multiple="multiple" required>
         <option>Morning</option>
         <option>Afternoons</option>
         <option>Evenings</option>
       </select>
     </div>

     @if($category === "Education")
     <div class="form-group">
       <label style="font-weight:500" for="worktype">Type of Work:</label>
        <select id="multiselect3" name="worktype[]" multiple="multiple" required>
         <option>Classroom Volunteering</option>
         <option>Staff Support</option>
         <option>Community Engagement</option>
         <option>Extracurricular Workshop</option>
        </select>
      </div>
      <div class="form-group">
      <label style="font-weight:500" for="eduhighest">Highest Education</label>
       <select class="form-control" name="eduhighest" required>
          <option>School</option>
          <option>Graduation</option>
          <option>Post Graduation</option>
       </select>
       </div>
     @endif

     @if($category === "AnimalCare")
     <div class="form-group">
       <label style="font-weight:500" for="worktype">Type of Work:</label>
        <select id="multiselect3" name="worktype[]" multiple="multiple" required>
         <option>Foster Animal from Shelter</option>
         <option>Shelter Operation</option>
         <option>Campaign & Program Awarness</option>
        </select>
      </div>
      <div class="form-group">
      <label style="font-weight:500" for="vaccinated">Have you been vaccinated?</label>
       <select class="form-control" name="vaccinated" required>
          <option>Yes</option>
          <option>No</option>
       </select>
       </div>
       <div class="form-group">
       <label style="font-weight:500" for="allergies">Do you have any allergies?</label>
        <select class="form-control" name="allergies" required>
           <option>Yes</option>
           <option>No</option>
        </select>
       </div>
       <div class="form-group">
       <label style="font-weight:500" for="blood_group">Blood Group</label>
        <select class="form-control" name="blood_group" required>
           <option>Group A</option>
           <option>Group B</option>
           <option>Group AB</option>
           <option>Group O</option>
           <option>Other</option>
        </select>
       </div>
     @endif
     @if($category == "HealthCare" || $category == "Sanitation")
     <div class="form-group">
     <label style="font-weight:500" for="worktype">Type of Work:</label>
      <select id="multiselect3" name="worktype[]" multiple="multiple" required>
         <option>Fund Raising</option>
         <option>Event Management</option>
         <option>Tech Support</option>
         <option>Promotional Activities</option>
         <option>Adminstration</option>
         <option>Community Engagement</option>
        </select>
      </div>
     @endif

     <div class="form-group">
       <label style="font-weight:500" for="vol_dec">Why do you want to volunteer?</label>
       <textarea name="volun_decision" class="form-control" rows="4" maxlength="2000" required></textarea>
     </div>

     <div class="form-group">
       <label style="font-weight:500" for="vol-exp">Experience,skills that you would use to support the organization.</label>
       <textarea name="volun_experience" class="form-control" rows="4" maxlength="2000" required></textarea>
     </div>
   </div>

     <div id="ngo-select" class="form-group">
        <label style="font-weight:500">Select Organization(s)</label>
       <select id="multiselect2" name="orgsapplied[]" multiple="multiple" required>
   <?php for ($x = 0; $x < $k; $x++) {?>
      <?php  echo "<option value = '".$ngos_id[$x]."'>".$ngos[$x] . "</option>";?>
 <?php } ?>
</select>
 </div>
 <center><button id="s-btn" style="display:none;margin:15px;padding:10px;font-size:14px;" type="submit" class="btn btn-default">Submit</button></center>
</form>
<center><button id="a-btn" style="margin:15px;padding:10px;font-size:14px;" onclick="onapply()" class="btn btn-default">Apply</button></center>
</div>
</div>
</div>
 <?php } ?>
 <?php if($check==-1){?>
   <div class="page-header" style="margin-top:40px;">
    <h1 style="font-weight:300;"><center>Sorry! No organizations in entered radius</center></h1>
        <h4 style="font-weight:300;"><center>Tip: Try increasing the radius</center></h4>
    </div>
 <?php } ?>
  <?php } ?>

<?php if(!session()->has('vlat')){?>
    <div class="page-header" style="margin-top:120px;">
     <h1 style="font-weight:300;letter-spacing:2px;"><center>Try Re-submitting.</center></h1>
         <h4 style="font-weight:300;"><center>We don't store your co-ordinates:)</center></h4>
     </div>
   <?php } ?>


      </body>
      </html>
