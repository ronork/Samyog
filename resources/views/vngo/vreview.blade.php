<!Doctype html>
<html>
<head>
  @include( 'layouts.resnavmenu' )
<title>
  Review
</title>
<script>
function inform(a)
{
  if(a=="Accepted")
  {
    document.getElementById('pnum').style.display = 'block';
  }
  else {
    document.getElementById('pnum').style.display = 'none';
  }
}
</script>
</head>
<body>
  <div class="container" style="width:80%;margin-top:100px;">
    <div class="row">
  <div class="panel panel-default">
    <div class="panel-heading">
    <center><h1 style="font-size:25px;" class="panel-title">Review</h1></center>
  </div>
  <div class="panel-body">
    <div class="form-group">
      <label style="font-weight:500" >Name</label>
      <input class="form-control" value={{$vrow->v_name}} readonly>
    </div>
    <div class="form-group">
      <label style="font-weight:500">Email address</label>
      <input class="form-control" value={{$vrow->v_email}} readonly>
    </div>
    <div class="form-group">
      <label style="font-weight:500">Have you previously volunteered for any organization?</label>
      <input class="form-control" value={{$vrow->prev_v}} readonly>
    </div>
    <div class="form-group">
      <label style="font-weight:500">If yes give brief details.</label>
      <textarea class="form-control" rows="5" readonly>{{$vrow->exp_past}}</textarea>
    </div>
    <div class="form-group">
      <label style="font-weight:500">Days Available</label>
      <input class="form-control" value={{$vrow->days}} readonly>
    </div>
    <div class="form-group">
      <label style="font-weight:500">Time</label>
      <input class="form-control" value={{$vrow->times}} readonly>
    </div>

    <div class="form-group">
      <label style="font-weight:500">What made you decide that you would like to volunteer?</label>
      <textarea class="form-control" rows="5" readonly>{{$vrow->volun_decision}}</textarea>
    </div>

    <div class="form-group">
      <label style="font-weight:500">Experience,skills that you would use to support the organization.</label>
      <textarea class="form-control" rows="5" readonly>{{$vrow->volun_experience}}</textarea>
    </div>
  <form action="/status/submitted" method="POST" >
      {!! csrf_field() !!}
      <div class="form-group">
        <label style="font-weight:500">Specify the staus of the Application</label>
        <select name="status" onchange="inform(this.value)" class="form-control">
          <option value="Rejected">Rejected</option>
          <option value="Accepted">Accepted</option>
        </select>
      </div>
      <div style="display:none" id="pnum" class="form-group">
        <label style="font-weight:500" >Contact Number</label>
        <input type="tel" class="form-control" name="ngo_phone">
        <small id="emailHelp" class="form-text text-muted">We will send this contact number to the applicant</small>
      </div>
      <input style="display:none" type="text" name="vol_id" value={{$vrow->id}} >
      <input style="display:none" type="text" name="n_email" value={{$nrow->email}} >
<center><button style="margin:15px;padding:10px;font-size:14px;" type="submit" class="btn btn-default">Submit</button>OR<a style="margin:15px;padding:10px 15px 10px 15px;font-size:14px;" href="/Applications"  class="btn btn-danger">Review Later</a></center>
</form>
</div>
</div>
</div>
</div>
</body>
</html>
