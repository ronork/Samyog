<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Organizations-DB</title>
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
    <h2>Organization(s)</h2>
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
                      <th>Name of Org</th>
                      <th>Email</th>
                      <th>Last Login</th>
                      <th>Category</th>
                      <th>Status</th>
                      <th>Created at</th>
                      <th>Updated at</th>
                    </tr>
                  </thead>
                   @foreach($all_orgs as $org)
                   <tr data-toggle="modal" data-target="#status{{$org['id']}}">
                     <td>{{$org['name_of_org']}}</td>
                     <td>{{$org['email']}}</td>
                     <td>{{$org['last_login']}}</td>
                     <td>{{$org['category']}}</td>
                     <td>{{$org['org_status']}}</td>
                     <td>{{$org['created_at']}}</td>
                     <td>{{$org['updated_at']}}</td>
                   </tr>
                   <div class="modal fade" id="status{{$org['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                       <div class="modal-content">
                         <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                        </div>
                           <div class="modal-body">
                             @if($org['org_status']==="active")
                             Block Organization?
                             @endif
                             @if($org['org_status']==="inactive")
                             Activate Organization?
                             @endif
                           </div>
                             <center><a style="margin:10px;" href="/276281/admin/Samyog-DB/Organizations/{{$org['email']}}/{{$org['org_status']}}" type="button" class="btn btn-default">Yes</a> <button type="button" class="btn btn-default" data-dismiss="modal">No</button></center>
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
