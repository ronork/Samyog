<!doctype html>
<html>
    <head>

        <title>{{$data}}-Statistics</title>
        @include( 'layouts.navmenu' )

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js">
        </script>
        <style media="screen">
        .chart-container {
          position: relative;
          margin: auto;
          height: 80vh;
          width: 80vw;
        }
        </style>
      </head>
      <body>
<div style="margin-top:100px;">

</div>
<div class="chart-container">
<canvas id="web_data"></canvas>
</div>
@if($data=="Users")
<script>
var online_orgs=0;
var online_vols=0;
var AdminOrgOnlineChannel = pusher.subscribe('AdminOrgOnlineChannel');
AdminOrgOnlineChannel.bind('AdminAction', function(data){
  online_orgs+=1;
	web_data.data.datasets[0].data[1] = online_orgs;
  web_data.update();
});
// var AdminOrgOfflineChannel = pusher.subscribe('AdminOrgOfflineChannel');
// AdminOrgOfflineChannel.bind('AdminAction', function(data){
//   online_orgs-=1;
// });
var AdminVolOnlineChannel = pusher.subscribe('AdminVolOnlineChannel');
AdminVolOnlineChannel.bind('AdminAction', function(data){
  online_vols+=1;
  web_data.data.datasets[0].data[0] = online_vols;
  web_data.update();
});
// var AdminVolOfflineChannel = pusher.subscribe('AdminVolOfflineChannel');
// AdminVolOfflineChannel.bind('AdminAction', function(data){
//   online_vols-=1;
// });
var ctx = document.getElementById("web_data").getContext('2d');
var web_data = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Volunteers", "Organizations"],
        datasets: [{
            label: 'Online',
            data: [online_vols,online_orgs],
            backgroundColor: [
                'rgba(255, 99, 132, 0.4)',
                'rgba(54, 162, 235, 0.4)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
          }]
        },
    options: {
        scales: {
          yAxes: [{
              ticks: {
                  stepSize : 1,
                  beginAtZero:true,
                  display: false
              },
              gridLines: {
                display: false
              }
          }],
            xAxes: [{
  gridLines: {
    display: false
  }
}]
        }
    }
});
</script>
@endif
@if($data=="Volunteers" || $data=="Organizations")
<script>
var ctx = document.getElementById("web_data").getContext('2d');
var web_data = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Verified", "Not Verified", "Blocked"],
        datasets: [{
            label: 'Number of '+'{{$data}}',
            data: [{{$verified}}, {{$not_verified}}, {{$blocked}}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.4)',
                'rgba(54, 162, 235, 0.4)',
                'rgba(255, 206, 86, 0.4)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
          }]
        },
    options: {
        scales: {
          yAxes: [{
              ticks: {
                  stepSize : 1,
                  beginAtZero:true,
                  display: false
              },
              gridLines: {
                display: false
              }
          }],
            xAxes: [{
  gridLines: {
    display: false
  }
}]
        }
    }
});
</script>
@endif

@if($data == "Applications")
<script>
var ctx = document.getElementById("web_data").getContext('2d');
var web_data = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Submitted","Pending","Accepted-WC","Confirmed","Rejected","Closed","Inactive"],
        datasets: [{
            label: 'Number of '+'{{$data}}',
            data: [{{$Submitted}},{{$Pending}},{{$Accepted_WC}},{{$Confirmed}},{{$Rejected}},{{$Closed}},{{$inactive}}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.4)',
                'rgba(54, 162, 235, 0.4)',
                'rgba(25, 111, 61, 0.4)',
                'rgba(99, 57, 116, 0.4)',
                'rgba(84, 110, 122, 0.4)',
                'rgba(194, 24, 91, 0.4)',
                'rgba(255, 206, 86, 0.4)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(39, 174, 96,1)',
                'rgba(155, 89, 182, 1)',
                'rgba(144, 164, 174,1)',
                'rgba(240, 98, 146, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
          }]
        },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    stepSize : 1,
                    beginAtZero:true,
                    display: false
                },
                gridLines: {
                  display: false
                }
            }],
            xAxes: [{
  gridLines: {
    display: false
  }
}]
        }
    }
});
</script>
@endif


      </body>
        @include( 'layouts.footer' )
  </html>
