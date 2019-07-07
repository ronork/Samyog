<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return True;
});

Broadcast::channel('organization_channel{id}', function ($id) {
    if(session()->has('AuthorizedVolunteer'))
    {
      $vol_id = session('AuthorizedVolunteer');
      if($id == $vol_id['vol_id'])
          return True;
    }
});


Broadcast::channel('volunteer_channel{id}', function ($id) {
  if(Sentinel::check())
  {
    $org_data = Sentinel::getUser();
    if($id == $org_data->id)
     return True;
    }
});

Broadcast::channel('AdminVolChannel{id}', function ($id) {
  if(session()->has('AuthorizedVolunteer'))
  {
    $vol_id = session('AuthorizedVolunteer');
    if($id == $vol_id['vol_id'])
        return True;
  }
});

Broadcast::channel('AdminOrgChannel{id}', function ($id) {
  if(Sentinel::check())
  {
    $org_data = Sentinel::getUser();
    if($id == $org_data->id)
     return True;
    }
});

Broadcast::channel('AdminMasterChannel{id}', function ($id) {
  if(session()->has('DB-Credentials'))
  {
     return True;
  }
});

Broadcast::channel('AdminOrgOnlineChannel', function () {
  if(session()->has('DB-Credentials'))
  {
     return True;
  }
});

Broadcast::channel('AdminOrgOfflineChannel', function () {
  if(session()->has('DB-Credentials'))
  {
     return True;
  }
});

Broadcast::channel('AdminVolOnlineChannel', function () {
  if(session()->has('DB-Credentials'))
  {
     return True;
  }
});

Broadcast::channel('AdminVolOfflineChannel', function () {
  if(session()->has('DB-Credentials'))
  {
     return True;
  }
});
