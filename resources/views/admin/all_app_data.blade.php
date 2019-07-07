<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Applications-DB</title>
            @include( 'layouts.navmenu' )
    <style media="screen">
    h2 { text-align: center;margin-top: 100px;margin-bottom:35px;} table caption { padding: .5em 0; } @media screen and (max-width: 767px) { table caption { border-bottom: 1px solid #ddd; } } .p { text-align: center; padding-top: 140px; font-size: 14px; }
    th{
      text-align: center;
    }
    td{
      text-align: center;
    }
    </style>
  </head>
  <body>
    <h2>Application(s)</h2>
    <center>
    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
    {{ session('error') }}
    </div>
    @endif
  </center>
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div  style="min-height: 500px;" class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Application Id</th>
                      <th>Name of Volunteer</th>
                      <th>Volunteer Email</th>
                      <th>Volunteer Status</th>
                      <th>Organization Applied to</th>
                      <th>Organization Email</th>
                      <th>Organization Status</th>
                      <th>Application Status</th>
                      <th>Applied on</th>
                      <th>Reviewed on</th>
                    </tr>
                  </thead>
                   @foreach($all_apps as $app)
                   <tr data-toggle="modal" data-target="#status{{$app['application_id']}}">
                     <td>{{$app['application_id']}}</td>
                     <td>{{$app['v_name']}}</td>
                     <td>{{$app['v_email']}}</td>
                     <td>{{$app['vol_status']}}</td>
                      <td>{{$app['name_of_org']}}</td>
                     <td>{{$app['email']}}</td>
                      <td>{{$app['org_status']}}</td>
                     <td>{{$app['status']}}</td>
                     <td>{{$app['applied_on']}}</td>
                     <td>{{$app['reviewed_on']}}</td>
                   </tr>
                   <div class="modal fade" id="status{{$app['application_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                       <div class="modal-content">
                         <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                        </div>
                           <div class="modal-body">
                             @if($app['status']!=="inactive")
                             Block Application?
                             @endif
                             @if($app['status']==="inactive")
                             Activate Application?
                             @endif
                           </div>
                             <center><a style="margin:10px;" href="/276281/admin/Samyog-DB/Applications/{{$app['application_id']}}/{{$app['status']}}" type="button" class="btn btn-default">Yes</a> <button type="button" class="btn btn-default" data-dismiss="modal">No</button></center>
                         </div>
                       </div>
                     </div>
                   @endforeach
                 </table>
                </div>
              </div>
            </div>
          </div>

  </body>
</html>
