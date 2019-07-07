<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Volunteers-DB</title>
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
    <h2>Volunteer(s)</h2>
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
                      <th>Name of Volunteer</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Created at</th>
                      <th>Updated at</th>
                    </tr>
                  </thead>
                   @foreach($all_vols as $vol)
                   <tr data-toggle="modal" data-target="#status{{$vol['volun_id']}}">
                     <td>{{$vol['v_name']}}</td>
                     <td>{{$vol['v_email']}}</td>
                     <td>{{$vol['vol_status']}}</td>
                     <td>{{$vol['created_at']}}</td>
                     <td>{{$vol['updated_at']}}</td>
                   </tr>
                   <div class="modal fade" id="status{{$vol['volun_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                       <div class="modal-content">
                         <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                        </div>
                           <div class="modal-body">
                             @if($vol['vol_status']==="active")
                             Block Volunteer?
                             @endif
                             @if($vol['vol_status']==="inactive")
                             Activate Volunteer?
                             @endif
                           </div>
                             <center><a style="margin:10px;" href="/276281/admin/Samyog-DB/Volunteers/{{$vol['v_email']}}/{{$vol['vol_status']}}" type="button" class="btn btn-default">Yes</a> <button type="button" class="btn btn-default" data-dismiss="modal">No</button></center>
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
