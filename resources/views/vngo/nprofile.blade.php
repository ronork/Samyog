<!DOCTYPE html>
<html>
<head>
  @include( 'layouts.resnavmenu' )
  <title>
    Applications
  </title>
  <style>
  h2 { text-align: center;} table caption { padding: .5em 0; } @media screen and (max-width: 767px) { table caption { border-bottom: 1px solid #ddd; } } .p { text-align: center; padding-top: 140px; font-size: 14px; }

  .vcon
  {
    font-weight: 400;
    font-size: 15px;
    color:#606060;
  }
  h4
  {
    font-weight: 400;
    font-size:18px;
  }
  th{
    text-align: center;
  }
  td{
    text-align: center;
  }
</style>
<body>

  <?php $date_now = Carbon\Carbon::now();//to get the current date ?>

  <div class="page-header" style="margin-top:80px;">
    @if(session('success'))
    <div class="alert alert-success">
      <center>{{ session('success') }}</center>
    </div>
    @endif
  </div>

  <div class="container">

    @if(!is_null($vol_applications))
    <div class="row">
      <div class="col-xs-12">
        <div style="min-height: 500px;" class="table-responsive">
          <h2 style="margin-bottom:30px;">Applications</h2>

          <table class="table table-bordered table-hover">
            <!-- <caption class="text-center">Use the navbar to filter:</caption> -->
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Applied on</th>
                @if($fstatus !== "Submitted")
                <th>Reviewed on</th>
                @endif
                <th>
                  <div class="dropdown">
                    <span>Status:  </span><button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">{{$fstatus}}
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                      <li><a href="/Organization-Profile/Applications/Filter/NF">NF</a></li>
                      <li><a href="/Organization-Profile/Applications/Filter/Submitted">Submitted</a></li>
                      <li><a href="/Organization-Profile/Applications/Filter/Pending">Pending</a></li>
                      <li><a href="/Organization-Profile/Applications/Filter/Accepted-WC">Accepted-WC</a></li>
                      <li><a href="/Organization-Profile/Applications/Filter/Confirmed">Confirmed</a></li>
                      <li><a href="/Organization-Profile/Applications/Filter/Closed">Closed</a></li>
                      <li><a href="/Organization-Profile/Applications/Filter/Rejected">Rejected</a></li>
                    </ul>
                  </div>
                </th>
                <th>Application</th>
              </tr>
            </thead>

            <tbody>
              @foreach($vol_applications as $vol_content)
              <?php
              $date_time_f = strtotime($vol_content['reviewed_on']);
              $date_rev = date("Y-m-d",$date_time_f);
              $no_rev="false";
              ?>
              <tr>
                <td>{{$vol_content['v_name']}}</td>
                <td>{{$vol_content['v_email']}}</td>
                <?php $date_time_f = strtotime($vol_content['applied_on']);
                 $date_time = date("d-m-y  g:i A",$date_time_f);?>
                <td>{{$date_time}}</td>
                @if($fstatus !== "Submitted")
                <?php $date_time_f = strtotime($vol_content['reviewed_on']);
                 $date_time = date("d-m-y  g:i A",$date_time_f);?>
                <td>{{$date_time}}</td>
                @endif
                <td>{{$vol_content['status']}}</td>
                @if($vol_content['status']=="Submitted")
                <?php $no_rev="true"; ?>
                @endif
                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#FormModal{{ $vol_content['application_id'] }}">
                  View Application</button></td>
                </tr>
                <?php $form= json_decode($vol_content['application_form'],true);?>
                <div class="modal fade" id="FormModal{{ $vol_content['application_id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="exampleModalLongTitle">Application Form</h3>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label style="font-weight:500" >Name</label>
                          <input class="form-control" value="{{$vol_content['v_name']}}" readonly>
                        </div>
                        <div class="form-group">
                          <label style="font-weight:500">Email address</label>
                          <input class="form-control" value="{{$vol_content['v_email']}}" readonly>
                        </div>

                        @if($form['Category']==="Education")
                        <div class="form-group">
                          <label style="font-weight:500">Highest Education:</label>
                          <input class="form-control" value="{{$form['Highest Education']}}" readonly>
                        </div>
                        @endif
                        <div class="form-group">
                          <label style="font-weight:500">Type of work interested in:</label>
                          <input class="form-control" value="{{$form['Type of Work']}}" readonly>
                        </div>
                        @if($form['Category']==="AnimalCare")
                        <div class="form-group">
                          <label style="font-weight:500">Have you been vaccinated?</label>
                          <input class="form-control" value="{{$form['Vaccinated']}}" readonly>
                        </div>
                        <div class="form-group">
                          <label style="font-weight:500">Do you have any allergies?</label>
                          <input class="form-control" value="{{$form['Allergies']}}" readonly>
                        </div>
                        <div class="form-group">
                          <label style="font-weight:500">Blood Group:</label>
                          <input class="form-control" value="{{$form['Blood Group']}}" readonly>
                        </div>
                        @endif

                        <div class="form-group">
                          <label style="font-weight:500">Have you previously volunteered for any organization?</label>
                          <input class="form-control" value={{$form['Previously Volunteered']}} readonly>
                        </div>
                        @if($form['Previously Volunteered'] === "Yes")
                        <div class="form-group">
                          <label style="font-weight:500">Brief Details of your Experience.</label>
                          <textarea class="form-control" readonly>{{$form['Past Experience']}}</textarea>
                        </div>
                        @endif
                        <div class="form-group">
                          <label style="font-weight:500">Days Available</label>
                          <input class="form-control" value="{{$form['Available Days']}}"readonly>
                        </div>
                        <div class="form-group">
                          <label style="font-weight:500">Time</label>
                          <input class="form-control" value="{{$form['Available Times']}}" readonly>
                        </div>

                        <div class="form-group">
                          <label style="font-weight:500">What made you decide that you would like to volunteer?</label>
                          <textarea class="form-control" rows="5" readonly>{{$form['Volunteer Reason']}}</textarea>
                        </div>

                        <div class="form-group">
                          <label style="font-weight:500">Experience,skills that you would use to support the organization.</label>
                          <textarea class="form-control" rows="5" readonly>{{$form['Volunteer Experience']}}</textarea>
                        </div>
                        <center>
                          @if($vol_content['status'] == "Pending" || $vol_content['status'] == "Submitted")
                          <!-- <a href="/Organization-Profile/Applications/{{$vol_content['volun_id']}}/Accepted" style="margin:15px;padding:10px;font-size:14px;"  class="btn btn-success">Accept</a> -->
                          <button style="margin:15px;padding:10px;font-size:14px;"  type="button" class="btn btn-default" data-toggle="modal" data-target="#Accept{{ $vol_content['application_id'] }}">
                            Accept</button>
                            <div class="modal fade" id="Accept{{ $vol_content['application_id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="panel-body" style="text-align:left">
                                      <div style="display:none"id="danger{{ $vol_content['application_id'] }}" class="alert alert-danger">
                                      </div>
                                      <form id="acceptform{{ $vol_content['application_id'] }}" action="/Organization-Profile/Applications/Filter/{{$fstatus}}/{{$vol_content['application_id']}}/{{$vol_content['volun_id']}}/Accepted-WC" method="post">
                                        {!! csrf_field() !!}
                                        <div class="form-group">
                                          <label style="font-weight:500;">Person to meet</label>
                                          <input class="form-control" name="pname" required>
                                        </div>
                                        <div class="form-group">
                                          <label style="font-weight:500;">Specify meeting Date</label>
                                          <input class="form-control" name="mdate" type="date" onchange="validate_days()" id="Date{{ $vol_content['application_id'] }}"  required>

                                          <script type="text/javascript">
                                          function validate_days()
                                          {
                                            var id_set,m_date,r_date,d1,d2,m1,m2,y1,y2;
                                            var id_set = "Date"+'<?php echo $vol_content['application_id'] ;?>';
                                            var d_set = "danger"+'<?php echo $vol_content['application_id'] ;?>';
                                            var m_date = document.getElementById(id_set).value;
                                              r_date = new Date();
                                            m_date = new Date(m_date);
                                            var diffDays = Math.ceil((m_date-r_date) / (1000 * 3600 * 24));//divide by number of msec in a day
                                            var l = document.getElementById(d_set);
                                            var d = document.getElementById(id_set);
                                            if(diffDays<0){
                                              l.style.display = "block";
                                              l.innerHTML = "Invalid Date";
                                              d.value="";}
                                             else if (diffDays>7) {
                                               l.style.display = "block";
                                              l.innerHTML = "The number of days cannot exceed 7";
                                               d.value="";
                                             }
                                             else {
                                               l.style.display = "none";
                                             }
                                           }
                                          </script>
                                        </div>
                                        <div class="form-group">
                                          <label style="font-weight:500;">Specify meeting Time</label>
                                          <input class="form-control" name="mtime" type="time" id="Time{{ $vol_content['application_id'] }}"  required>
                                        </div>
                                        <div class="form-group">
                                          <label style="font-weight:500;">Contact Number</label>
                                          <input id="Number{{ $vol_content['application_id'] }}"  class="form-control" type="tel" size="15" type="number" name="mnumber"  placeholder="Optional">
                                        </div>
                                        <div class="form-group">
                                          <label style="font-weight:500;">Documents Required</label>
                                          <input id="Doc{{ $vol_content['application_id'] }}"  class="form-control" name="documents"  placeholder="Specify if necessary">
                                        </div>
                                        <div class="form-group">
                                          <label style="font-weight:500;">Location</label>
                                          <input class="form-control" name="location" value="{{Sentinel::getUser()->location}}" required>
                                        </div>

                                        <div class="form-group">
                                          <label style="font-weight:500;">Email</label>
                                          <input class="form-control" type="email" name="email" value="{{Sentinel::getUser()->email}}" required>
                                        </div>
                                        <center>
                                          <button style="margin:15px;padding:10px;font-size:14px;" type="submit" class="btn btn-default">
                                            Accept and Send Details</button></center>
                                          </form>
                                          <script type="text/javascript">
                                          $("#acceptform{{ $vol_content['application_id'] }}").submit(function() {
                                            var num = document.getElementById("Number{{ $vol_content['application_id'] }}");
                                            var doc = document.getElementById("Doc{{ $vol_content['application_id'] }}");
                                            if(num.value.length==0)
                                            num.value="Not Specified";
                                            if(doc.value.length == 0)
                                            doc.value="None";
                                            return true; // return false to cancel form action
                                          });
                                          </script>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                @endif

                                @if($vol_content['status'] == "Submitted")
                                <a href="/Organization-Profile/Applications/Filter/{{$fstatus}}/{{$vol_content['volun_id']}}/Pending" style="margin:15px;padding:10px;font-size:14px;"  class="btn btn-default">Mark as Reviewed</a>
                                @endif

                                @if($vol_content['status'] == "Pending" || $vol_content['status'] == "Submitted")
                                <a href="/Organization-Profile/Applications/Filter/{{$fstatus}}/{{$vol_content['volun_id']}}/Rejected" style="margin:15px;padding:10px;font-size:14px;"  class="btn btn-danger">Reject</a></center>
                                @endif

                                @if($vol_content['status'] == "Accepted-WC")
                                <div class="alert alert-warning">
                                  Application has been accepted and awaiting Volunteer Confirmation.
                                </div>
                                @endif

                                @if($vol_content['status'] == "Rejected")
                                <div class="alert alert-warning">
                                  Status of Rejected Applications cannot be changed in case of any query <a href="/Contact-Us">Contact Us</a>.
                                </div>
                                @endif

                                @if($vol_content['status'] == "Confirmed")
                                <?php
                                $date_time_f = strtotime($vol_content['reviewed_on']);
                                $date_time = date("d-m-Y",$date_time_f);
                                $meeting_date = strtotime($form['meeting_date']);
                                $meeting_date = date("dS-F,Y",$meeting_date);
                                $d_now =$date_now->toDateString();
                                $k = $form['meeting_date'];
                                $dias = (strtotime($k) - strtotime($d_now)) / 86400;
                                $dias = floor($dias);
                                 ?>
                                @if($dias>=0)
                                <div style="word-spacing: 0.2rem;" class="alert alert-warning">
                                <center>Confirmed on {{$date_time}}, <span style="margin-top:2px;">Meeting Date:{{$meeting_date}} Time:{{$form['meeting_time']}}</span></center>
                                </div>
                                @endif

                                @if($dias<0)
                                <div class="alert alert-danger">
                                <center>Application Expired</center>
                               </div>
                                <a href="/Organization-Profile/Applications/Filter/{{$fstatus}}/{{$vol_content['volun_id']}}/Closed" style="margin:5px;padding:10px;font-size:14px;"  class="btn btn-default">Close Application</a></center>
                                @endif
                                @endif
                                @if($vol_content['status'] == "Closed")
                                <?php $date_time_f = strtotime($vol_content['reviewed_on']);
                                      $date_time = date("d-m-Y",$date_time_f); ?>
                                <div class="alert alert-danger">
                                  <center>Application Closed on {{$date_time}} </center>

                                </div>
                                @endif
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <!-- <button type="button" class="btn btn-danger">Revoke</button> -->
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </tbody>
                      <tfoot>

                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
              @endif
            </body>
            </html>
