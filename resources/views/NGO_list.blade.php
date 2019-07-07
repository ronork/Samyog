<!doctype html>
<html>
    <head>

        <title>Organization(s) Connected</title>
          @include( 'layouts.navmenu' )
          <script type="text/javascript">
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
          document.getElementById('v-apply').style.display = 'block';
          document.getElementById('ngo-list').style.display = 'none';
          document.getElementById('category_f').style.display = 'none';
          document.getElementById("form-h").innerHTML = "Volunteer Application Form";
          }
          function onback()
          {
          document.getElementById('v-apply').style.display = 'none';
          document.getElementById('ngo-list').style.display = 'block';
          document.getElementById('category_f').style.display = 'block';
          document.getElementById("form-h").innerHTML = "Organization's connected with us";
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
          function displayAbout(a,b)
          {
            document.getElementById('about').innerHTML = a;
            document.getElementById('about-header').innerHTML = b;

          }
          </script>
          <style>
          #about
          {
            text-align: justify;
            text-justify: inter-word;
          }
          </style>

          <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" type="text/css"/>
      </head>
      <body>
<div class="container" style="width:90%;margin-top:100px;">
<div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <center>
        <h3 id="form-h">
          Organization's connected with us
        </h3>
      </center>
      </div>
<div class="panel-body">
  <div id="category_f" style="margin-top:5px;text-align:left;"class="container">
      <div class="dropdown">
      <button style="font-size: 14px;padding: 6px;"  class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
          <i style="margin:3px 5px 0px 0px;" class="glyphicon glyphicon-filter"></i>{{$category}}
      <span class="caret"></span></button>
      <ul style="font-size:1.1em;" class="dropdown-menu">
        <li><a href="/Organization(s)-list/Education">Education</a></li>
        <li><a href="/Organization(s)-list/HealthCare">Health Care</a></li>
        <li><a href="/Organization(s)-list/AnimalCare">Animal Care</a></li>
        <li><a href="/Organization(s)-list/Sanitation">Sanitation</a></li>
      </ul>
    </div>
  </div>
  <div id ="ngo-list">
    <div style="margin-bottom:30px;">
    <h4 id="about-header"></h4>
    <p id="about"></p>
  </div>
  <table style="cursor:default" class="table table-bordered table-hover" >
   <thead>
     <tr style="font-weight:bold;">
       <td>Name of Organisation</td>
       <!--<td>About</td>-->
       <td>Location</td>
     </tr>
   </thead>
   <tbody>
     @foreach($all_ngos as $ngo)
       <tr data-toggle="modal" data-target="#FormModal{{ $ngo->id }}">
         <td>{{$ngo->name_of_org}}</td>
         <!--<td>{{$ngo->about_org}}</td>-->
         <td>{{$ngo->location}}</td>
       </tr>
       <div class="modal fade" id="FormModal{{ $ngo->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title" id="exampleModalLongTitle">{{$ngo->name_of_org}}</h4>
             </div>
             <div class="modal-body">
               <div class="form-group">
                 <label style="font-weight:500">Name of head of Organization</label>
                 <input class="form-control" value="{{$ngo->name_of_head}}" readonly>
               </div>
               <div class="form-group">
                 <label style="font-weight:500">About the Organization</label>
                 <textarea class="form-control" style="text-align:justify;white-space: normal;" rows="6" readonly>{{$ngo->about_org}}</textarea>
               </div>
             </div>
           </div>
         </div>
       </div>
       <!-- Provides links for pages in case exceeds per-page limit -->
      @endforeach
     </tbody>
   </table>
          <div style="text-align:center">{{ $all_ngos->links() }}</div>
      <center><button style="margin:15px;padding:10px;font-size:14px;" onclick="onapply()" class="btn btn-default">Apply</button></center>
       </div>
     <form style="display:none;" id="v-apply" action="/volunteer-info/{{$category}}" method="POST">
     {!! csrf_field() !!}
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
       <label style="font-weight:500" for="ngos-applied">Select Organization(s)</label><br>
       <select name="orgsapplied[]" id="multiselect2" multiple="multiple" required>
         @foreach($all_ngos as $ngo)
       <?php  echo "<option value = '".$ngo->id."'>".$ngo->name_of_org . "</option>";?>
      @endforeach
    </select>
     </div>
     <div class="form-group">
       <label style="font-weight:500" for="prev_v">Have you previously volunteered for any organization?</label>
       <select name="prev_v" onchange="inform(this.value)" class="form-control" >
         <option value="Yes">Yes</option>
         <option value="No">No</option>
       </select>
     </div>

     <div class="form-group">
       <label style="font-weight:500" for="past-exp">If yes, give brief details.</label>
       <textarea id="pexp" name="exp_past" class="form-control" rows="3" maxlength="2000"></textarea>
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

     <center><button style="margin:15px;padding:10px;font-size:14px;" type="submit" class="btn btn-default">Submit</button>
     <a style="margin:15px;padding:10px;font-size:14px;" onclick="onback()" class="btn btn-default">Go Back</a></center>
   </form>
</div>
</div>
</div>
</div>
<!-- Modal -->

<script>
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
});
</script>
      </body>
      </html>
