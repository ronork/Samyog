<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Profile</title>
              @include( 'layouts.navmenu' )
          <style>
          h2 { text-align: center;margin-top: 100px;margin-bottom:35px;} table caption { padding: .5em 0; } @media screen and (max-width: 767px) { table caption { border-bottom: 1px solid #ddd; } } .p { text-align: center; padding-top: 140px; font-size: 14px; }
         .form-info
         {
           text-align: justify;
         }
         th{
           text-align: center;
         }
         td{
           text-align: center;
         }
         /* input[readonly] {
            background-color: white!important;
                  } */
        #avatar {
               border-radius: 50%;
               border:0.3px solid black;
               width: 50px;
               height: auto;
            }
          </style>
  </head>
  <body>
    <?php   $vol_info = session('AuthorizedVolunteer');
            $date_now  = Carbon\Carbon::now();?>
<h2>Application History</h2>
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div  style="min-height: 500px;" class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>
                    Filter
                  </th>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">{{$category}}
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="/view-applications/Organizations-NF/{{ $status }}">Organizations-NF</a></li>
                        <li><a href="/view-applications/Education/{{ $status }}">Education</a></li>
                        <li><a href="/view-applications/AnimalCare/{{ $status }}">Animal Care</a></li>
                        <li><a href="/view-applications/HealthCare/{{ $status }}">Health Care</a></li>
                        <li><a href="/view-applications/Sanitation/{{ $status }}">Sanitation</a></li>
                      </ul>
                    </div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">{{$status}}
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="/view-applications/{{ $category }}/Status-NF">Status-NF</a></li>
                        <li><a href="/view-applications/{{ $category }}/Submitted">Submitted</a></li>
                        <li><a href="/view-applications/{{ $category }}/Pending">Pending</a></li>
                        <li><a href="/view-applications/{{ $category }}/Accepted-WC">Accepted-WC</a></li>
                        <li><a href="/view-applications/{{ $category }}/Confirmed">Confirmed</a></li>
                        <li><a href="/view-applications/{{ $category }}/Rejected">Rejected</a></li>
                        <li><a href="/view-applications/{{ $category }}/Closed">Closed</a></li>
                      </ul>
                    </div>
                  </td>
                  <td>
                    <a type="button" class="btn btn-default" href="/view-applications">No Filter</a>
                  </td>
                  <td colspan="2">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#ProfileModal">
                      Profile & Stats
                    </button>
                  </td>
                </tr>
                <div class="modal fade" id="ProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      <span><img id="avatar" src="{{ asset('img/12.png') }}" alt="Avatar"><h3 style="margin-left:60px;margin-top:-40px;" class="modal-title" id="exampleModalLongTitle">Details & Stats</h3></span>
                      </div>
                      <div class="modal-body">
                        <div class="panel-body">
                          <div class="form-group">
                            <label style="font-weight:500">Name</label>
                            <input class="form-control" value="{{ $vol_info['vol_name'] }}" readonly>
                          </div>
                          <div class="form-group">
                            <label style="font-weight:500">Email</label>
                            <input class="form-control" value="{{$vol_info['vol_email']}}" readonly>
                          </div>
                          <div class="form-group">
                            <?php if($status === "Status-NF"){ ?>
                              <label style="font-weight:500">Total Number of Applications</label>
                            <?php } ?>
                            <?php if($status != "Status-NF"){?>
                            @if($status != "Accepted-WC")
                            <label style="font-weight:500">Number of {{$status}} Applications</label>
                            @endif
                            @if($status == "Accepted-WC")
                            <label style="font-weight:500">Number of Accepted Applications waiting confirmation</label>
                            @endif
                          <?php } ?>
                            <input class="form-control" value="{{$all_filtered_ap->count()}}" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <tr>
                  <th>Application Id</th>
                  <th>Name of Organization</th>
                  <th>Status</th>
                 <th>Applied on</th>
                <?php if($status != "Submitted") {?>
                  <th>Reviewed on</th>
                <?php } ?>
                  <th>Application</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($all_filtered_ap as $application)
                <tr>
                  <td>{{$application['application_id']}}</td>
                  <td>{{$application['name_of_org']}}</td>
                  <td>{{$application['status']}}</td>
                  <?php $date_time_f = strtotime($application['applied_on']);
                        $date_time = date("d-m-y  g:i A",$date_time_f);?>
                  <td>{{$date_time}}</td>
                  <?php if($status != "Submitted") {
                    if(!is_null($application['reviewed_on'])){
                    $date_time_f = strtotime($application['reviewed_on']);
                    $date_time = date("d-m-y  g:i A",$date_time_f);}
                    else {
                      $date_time = "-";
                    }?>
                  <td>{{$date_time}} </td>
                  <?php } ?>
                  <?php $form= json_decode($application['application_form'],true);?>
                  <td>

                  @if($application['status'] == "Accepted-WC" || $application['status'] == "Confirmed")
                  <button style="padding-left:25px;padding-right:25px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#AcceptDetails{{ $application['application_id'] }}">
                    View Details
                  </button>
                  @endif

                  @if($application['status'] != "Accepted-WC" && $application['status'] != "Confirmed"  )
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#FormModal{{ $application['application_id'] }}">
                    View Application
                  </button>
                  @endif

                  </td>
                  @if($application['status'] !== "Accepted-WC" || $application['status'] !== "Confirmed")
                  <div class="modal fade" id="FormModal{{ $application['application_id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <h3 class="modal-title" id="exampleModalLongTitle">Application Form</h3>
                        </div>
                        <div class="modal-body">
                          <div class="panel-body">
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
                              <input class="form-control" value="{{$form['Previously Volunteered']}}" readonly>
                            </div>

                           <?php if( $form['Previously Volunteered'] === "Yes"){?>
                            <div class="form-group">
                              <label style="font-weight:500">Give brief details.</label>
                              <textarea class="form-control" rows="5" readonly>{{$form['Past Experience']}}</textarea>
                            </div>
                          <?php }?>
                            <div class="form-group">
                              <label style="font-weight:500">Days Available</label>
                              <input class="form-control" value="{{$form['Available Days']}}" readonly>
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
                          </div>
                        </div>

                        <!--Add revoke option to revert the submitted application and allow to edit and re submit-->
                    <?php if($application['status'] === "Submitted" || $application['status'] === "Pending") {?>
                        <div class="modal-footer">
                          <center> <button type="button" style="padding:10px" class="btn btn-danger" data-toggle="modal" data-target="#FormRevoke{{ $application['application_id'] }}">Cancel Application</button></center>
                        </div>

                        <div style="margin-top:200px" class="modal fade" id="FormRevoke{{ $application['application_id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                             </div>
                                <div class="modal-body">
                                  Permanently delete your application?
                                </div>
                                  <center><a style="margin:10px;" href="/view-applications/Volunteer_application/Cancel/{{ $application['application_id'] }}" type="button" class="btn btn-default">Yes</a> <button type="button" class="btn btn-default" data-dismiss="modal">No</button></center>
                              </div>
                            </div>
                          </div>
                    <?php } ?>
                    @if($application['status']==="Closed")
                    <div class="modal-footer">
                      <center>  <div class="alert alert-danger">
                          Application closed on {{$date_time}}
                        </div></center>
                    </div>
                    @endif
                      </div>
                    </div>
                  </div>
                  @endif

                  <!-- Modal for viewing Details for Accepted Applications -->

                  @if($application['status'] === "Accepted-WC" || $application['status'] === "Confirmed")
                  <div class="modal fade" id="AcceptDetails{{ $application['application_id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <h3 class="modal-title" id="exampleModalLongTitle">Additional Details</h3>
                        </div>
                        <div class="modal-body">
                          <div class="panel-body">
                            <div class="form-group">
                              <label style="font-weight:500">Person to meet</label>
                              <input class="form-control" value="{{$form['person_to_meet']}}" readonly>
                            </div>
                            <div class="form-group">
                              <label style="font-weight:500">Email</label>
                              <input class="form-control" value="{{$form['org_email']}}" readonly>
                            </div>
                            <div class="form-group">
                              <label style="font-weight:500">Contact Number</label>
                              <input class="form-control" value="{{$form['person_number']}}" readonly>
                            </div>

                            <div class="form-group">
                              <label style="font-weight:500">Location</label>
                              <input class="form-control" value="{{$form['org_location']}}" readonly>
                            </div>
                            <div class="form-group">
                              <label style="font-weight:500">Date</label>
                              <?php  $date_f = strtotime($form['meeting_date']);
                                     $date_t = date("d-m-Y",$date_f); ?>
                              <input class="form-control" value="{{$date_t}}" readonly>
                            </div>
                            <div class="form-group">
                              <label style="font-weight:500">Time</label>
                              <input class="form-control" value="{{$form['meeting_time']}}" readonly>
                            </div>
                            <div class="form-group">
                              <label style="font-weight:500">Documents Required</label>
                              <input class="form-control" value="{{$form['documents']}}" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                          @if($application['status'] === "Accepted-WC")
                          <center> <a href="/view-applications/Volunteer_application/Confirmed/{{ $application['application_id'] }}"type="button" class="btn btn-default">Confirm</a></center>
                          @endif
                          @if($application['status'] == "Confirmed")
                          <?php
                          $d_now =$date_now->toDateString();
                          $k = $form['meeting_date'];
                          $dias = (strtotime($k) - strtotime($d_now)) / 86400;
                          $dias = floor($dias);
                           ?>
                          @if($dias>=0)
                          <div style="word-spacing: 0.2rem;" class="alert alert-warning">
                          <center>Application Confirmed</center></div>
                          @endif

                          @if($dias<0)
                          <div class="alert alert-danger">
                          <center>Application Expired</center>
                         </div>
                          @endif
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif

                </tr>
                  @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="6" class="text-center" >In case of any query <a href="/Contact-Us">Contact us</a></td>
                </tr>
              </tfoot>
            </table>
          </div><!--end of .table-responsive-->
        </div>
      </div>
    </div>



<!-- Modal -->

<script>
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
// function getRandomInt(min, max) {
//   return Math.floor(Math.random() * (max - min + 1) + min);
// }
</script>

  </body>
</html>
