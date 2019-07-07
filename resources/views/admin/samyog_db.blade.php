<!doctype html>
<html>
    <head>

        <title>Admin-Login</title>
        @include( 'layouts.navmenu' )
        <style media="screen">
          .breadcrumb
          {
            margin-top: 80px;
            padding: 20px;
            font-size: 1.1em;
            cursor: default;
          }
          #vol_panel,#org_panel,#app_panel,#stat_panel
          {
          margin:10px 22% 0px 22%;
          }
          #vol_panel,#app_panel,#stat_panel,#org_panel
          {
            display:none;
          }
        </style>
        <script>
        $(document).ready(function(){
          $("#org").click(function(){
            $("#org_panel").show(500);
            $("#vol_panel").hide();
            $("#app_panel").hide();
            $("#stat_panel").hide();
            $("#org").css("color", "rgba(0, 0, 0, 0.79)");
            $("#vol").css("color", "#3977D0");
            $("#app").css("color", "#3977D0");
            $("#stat").css("color", "#3977D0");
          });
          $("#vol").click(function(){
            $("#vol_panel").show(500);
            $("#org_panel").hide();
            $("#app_panel").hide();
            $("#stat_panel").hide();
            $("#vol").css("color", "rgba(0, 0, 0, 0.79)");
            $("#org").css("color", "#3977D0");
            $("#app").css("color", "#3977D0");
            $("#stat").css("color", "#3977D0");
          });
          $("#app").click(function(){
            $("#app_panel").show(500);
            $("#org_panel").hide();
            $("#vol_panel").hide();
            $("#stat_panel").hide();
            $("#app").css("color", "rgba(0, 0, 0, 0.79)");
            $("#vol").css("color", "#3977D0");
            $("#org").css("color", "#3977D0");
            $("#stat").css("color", "#3977D0");
          });
            $("#stat").click(function(){
              $("#stat_panel").show(500);
              $("#org_panel").hide();
              $("#app_panel").hide();
              $("#vol_panel").hide();
              $("#stat").css("color", "rgba(0, 0, 0, 0.79)");
              $("#vol").css("color", "#3977D0");
              $("#app").css("color", "#3977D0");
              $("#org").css("color", "#3977D0");
            });
          });
        function checkOrgEmail()
        {
          var k=document.getElementById('org_email');
          var x = k.value;
          if(x.length>0)
          {
            document.getElementById("category").value = "";
            document.getElementById("org_status").value = "";
            document.getElementById("category").disabled = true;
            document.getElementById("org_status").disabled = true;
          }
          else {
            document.getElementById('org_email').disabled=true;
            document.getElementById("category").disabled = false;
            document.getElementById("org_status").disabled = false;
          }
        }
        function checkVolEmail()
        {
          var k=document.getElementById('vol_email');
          var x = k.value;
          if(x.length>0)
          {
            document.getElementById("vol_status").value = "";
            document.getElementById("vol_status").disabled = true;
          }
          else {
            document.getElementById('vol_email').disabled=true;
            document.getElementById("vol_status").disabled = false;
          }
        }
        function checkAppId()
        {
          var k=document.getElementById('app_id');
          var x = k.value;
          if(x.length>0)
          {
            document.getElementById("app_oe").value = "";
            document.getElementById("app_ve").value = "";
            document.getElementById("app_status").value = "";
            document.getElementById("app_oe").disabled = true;
            document.getElementById("app_ve").disabled = true;
            document.getElementById("app_status").disabled = true;
          }
          else {
            document.getElementById('app_id').disabled=true;
            document.getElementById("app_oe").disabled = false;
            document.getElementById("app_ve").disabled = false;
            document.getElementById("app_status").disabled = false;
          }
        }
        </script>
      </head>
      <body>
      @if(Session()->has('Volunteers'))
        <script>
        $(document).ready(function(){
          $( "#vol" ).click();
        });
        </script>
      @endif
      @if(Session()->has('Organization'))
      <script>
      $(document).ready(function(){
        $( "#org" ).click();
      });
      </script>
      @endif
      @if(Session()->has('Applications'))
      <script>
      $(document).ready(function(){
        $( "#app" ).click();
      });
      </script>
      @endif
      @if(Session()->has('Statistics'))
      <script>
      $(document).ready(function(){
        $( "#stat" ).click();
      });
      </script>
      @endif
        <center>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a id="org">Organizations</a></li>
            <li class="breadcrumb-item"><a id="vol">Volunteers</a></li>
            <li class="breadcrumb-item"><a id="app">Applications</a></li>
            <li class="breadcrumb-item"><a id="stat">Statistics</a></li>
          </ol>
        </center>

        <div id="org_panel" class="panel panel-default">
          <div class="panel panel-body">
            <form  action="/276281/admin/Samyog-DB/Organizations" method="post">
              @if(session('success_org'))
              <div class="alert alert-success">
                {{ session('success_org') }}
                  </div>
              @endif

              @if(session('error_org'))
              <div class="alert alert-danger">
              {{ session('error_org') }}
              </div>
              @endif
             {{ csrf_field() }}
            <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                          <input id="org_email" type="email" onchange="checkOrgEmail()" name="o_email"  class="form-control" placeholder="org@example.com" >
                  </div>
          </div>
          <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
             <select id="category" style="font-weight:400;color:#999999;" name="category" class="form-control" required>
              <option value=""  selected>Select Category</option>
               <option value="Education">Education</option>
               <option value="HealthCare">Health Care</option>
               <option value="Sanitation">Sanitation</option>
               <option value="AnimalCare">Animal Care</option>
             </select>
          </div>
          </div>
          <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
             <select id="org_status" style="font-weight:400;color:#999999;" name="status" class="form-control" required>
              <option value="" selected>Select Status</option>
               <option value="active">Active</option>
               <option value="inactive">Inactive</option>
             </select>
          </div>
          </div>

          <center>
           <button style="margin-top:10px;"  type="submit" class="btn btn-default">Filter</button>
         </center>
        </form>
        </div>
      </div>

      <div id="vol_panel" class="panel panel-default">
        <div id="" class="panel panel-body">
          <form action="/276281/admin/Samyog-DB/Volunteers" method="post">
            @if(session('success_vol'))
            <div class="alert alert-success">
              {{ session('success_vol') }}
                </div>
            @endif

            @if(session('error_vol'))
            <div class="alert alert-danger">
            {{ session('error_vol') }}
            </div>
            @endif
          {{ csrf_field() }}
          <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input id="vol_email" onchange="checkVolEmail()" type="email" name="vol_email" class="form-control" placeholder="vol@example.com" >
                </div>
        </div>
        <div class="form-group">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
           <select style="font-weight:400;color:#999999;" id="vol_status" name="vol_status" class="form-control" required>
            <option value="" disabled selected>Select Status</option>
             <option value="active">Active</option>
             <option value="inactive">Inactive</option>
           </select>
        </div>
        </div>
        <center>
         <button style="margin-top:10px;" type="submit" class="btn btn-default">Filter</button>
       </center>
      </form>
      </div>
    </div>

    <div id="app_panel" class="panel panel-default">
      <div id="" class="panel panel-body">
        <form class="" action="/276281/admin/Samyog-DB/Applications" method="post">
          @if(session('success_app'))
          <div class="alert alert-success">
            {{ session('success_app') }}
              </div>
          @endif

          @if(session('error_app'))
          <div class="alert alert-danger">
          {{ session('error_app') }}
          </div>
          @endif
         {{ csrf_field() }}
        <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                      <input id="app_id" onchange="checkAppId()" type="number" name="app_id" class="form-control" placeholder="Application Id" >
              </div>
      </div>
      <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input id="app_ve" type="email" name="vol_email" class="form-control" placeholder="vol@example.com" >
            </div>
    </div>
    <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input id="app_oe" type="email" name="org_email" class="form-control" placeholder="org@example.com" >
          </div>
  </div>
  <div class="form-group">
    <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
     <select id="app_status" style="font-weight:400;color:#999999;" name="status" class="form-control" required>
      <option value="" selected>Select Status</option>
       <option value="Submitted">Submitted</option>
       <option value="Accepted-WC">Accepted-WC</option>
       <option value="Confirmed">Confirmed</option>
       <option value="Closed">Closed</option>
       <option value="Rejected">Rejected</option>
       <option value="inactive">Inactive</option>
     </select>
  </div>
  </div>
      <center>
       <button style="margin-top:10px;" type="submit" class="btn btn-default">Filter</button>
     </center>
    </form>
    </div>
  </div>

  <div id="stat_panel" class="panel panel-default">
    <div id="" class="panel panel-body">
      <form action="/276281/admin/Samyog-DB/Statistics" method="post">
      {{ csrf_field() }}
    <div class="form-group">
      <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
       <select style="font-weight:400;color:#999999;" name="stat" class="form-control" required>
        <option value="">Select</option>
         <option value="orgs">Organizations</option>
         <option value="vols">Volunteers</option>
         <option value="apps">Applications</option>
         <option value="users">Online Users</option>
       </select>
    </div>
    </div>
    <center>
     <button style="margin-top:10px;" type="submit" class="btn btn-default">View Graph</button>
   </center>
  </form>
  </div>
</div>


        </body>
        @include( 'layouts.footer' )
      </html>
