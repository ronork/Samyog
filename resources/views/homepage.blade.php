<!Doctype html>
<html>
<head>
  <title>
  Volunteer|Organization
</title>
    @include( 'layouts.comresnav' )
<style>
.center-div
{
  position: absolute;
  background-image: url('/img/build.jpg');
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  margin: auto;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.btn
{
  margin-top: 0px;
  width:200px;
  background-color: rgba(241, 241, 241, 0.58);
}
.btn:hover
{
  background-color: rgba(228, 66, 15, 0.31);
  color:#f7f7f7;
}
.ora
{
  letter-spacing: 4px;
  font-weight:400;
  color:#f7f7f7;
  font-size:25px;
}
.ab
{
  margin-top:20%;
}
@media screen and (max-width: 550px){
  .btn
  {
    font-size:17px;
  }
  .ab
  {
    margin-top:55%;
  }
.ora
{
  padding: 15px;
  letter-spacing: 4px;
  font-weight:400;
  font-size:20px;

}

}

</style>
</head>
<body>

<div class="center-div"><center><div class="ab"><a type="button" href="/volunteer-search" class="btn btn-default btn-lg">I am a Volunteer</a><br><br><span class="ora">OR</span><br><br><a type="button" href="/login" class="btn btn-default btn-lg">I am an Organization</a></div></center></div>
        @include( 'layouts.footer' )
</body>
</html>
