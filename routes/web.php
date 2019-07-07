<?php

use App\Events\ApplicationStatusUpdated;
// use Pusher\Laravel\Facades\Pusher;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('homepage');
});

Route::get('/volunteer-search', function () {
    if(session()->has('vlat'))
     {
       session()->forget('vlat');
       session()->forget('vlng');
     }
    return view('welcome');
});

Route::get('/test', function () {
    return view('homepage');
});

Route::get('/What-we-do', function () {
    return view('spages.aboutus');
});

Route::post('/volunteer-search','SearchController@postSearch');

Route::get('/Search/{category}','SearchController@getSearchResults');//Fetching the possible results and then performing check



//TODO:: Set up Volunteer's Profile

Route::get('/volunteer-password-setup',function(){
  return view('volunteer.password-setup');
});

Route::post('/volunteer-password-setup','VolunteerController@setVolunteerPassword');


Route::get('/view-applications','VolunteerController@viewVolunteerApplications');

Route::get('/view-applications/{category}/{status}','VolunteerController@toggleVolunteerApplication_category');

Route::get('/view-applications/Volunteer_application/Cancel/{app_id}','VolunteerController@deactivateApplication');

Route::get('/view-applications/Volunteer_application/Confirmed/{app_id}','VolunteerController@confirmApplication');

Route::post('/view-applications','VolunteerController@authVolunAndViewApps');

Route::get('/volunteer/forgot-password','VolunteerController@resetPassword');
Route::post('/volunteer/forgot-password','VolunteerController@sendresetPasswordIns');

Route::get('/volunteer_logout','VolunteerController@volunteerLogout');


//Organization's profile

Route::get('/Organization-Profile','RegisterationController@getOrgData');

Route::get('/Organization-Profile/Applications','RegisterationController@viewVolunteerApplications');

Route::get('/Organization-Profile/Applications/Filter/{status}','RegisterationController@filterVolunteerApplications');

Route::get('/Organization-Profile/Applications/Filter/{fstatus}/{vol_id}/{nstatus}','RegisterationController@changeApplicationstatus');

Route::post('/Organization-Profile/Applications/Filter/{fstatus}/{application_id}/{vol_id}/Accepted-WC','RegisterationController@acceptApplication');

// function () {
//   $vol = App\Volunteerinfos::all();
//   return view('vngo.nprofile', ['all_vols' => $vol ]);
// });

//updating organization's profile
Route::post('/update-profile','RegisterationController@updateProfile');

//Handling volunteer's application
Route::get('/review/{ngo_email}/{vol_id}','VolunteerController@reviewVol');


 //Checking and reporting the status of volunteer's application
 Route::post('/status/submitted','VolunteerController@statusVol');



//the contact us page
Route::get('/Contact-Us', function () {
    return view('contact-us');
});
Route::post('/Contact-Us','ContactController@postContact');

//display organization-list

Route::get('/Organization(s)-list/{category}','RegisterationController@viewOrgList');



//storing volunteer's information.

Route::post('/volunteer-info/{category}','VolunteerController@postVregister');

//verifying volunteer's email
Route::get('/submit/{vemail}/{confirmation_code}','VolunteerController@confirmSubmit');


Route::get('/register','RegisterationController@register');
Route::post('/register','RegisterationController@postRegister');


Route::get('/login','LoginController@login');
Route::post('/login','LoginController@postLogin');

Route::get('/logout','LoginController@logout');

//activating organization's email
Route::get('/activate/{email}/{activationCode}','ActivationController@activate');

Route::get('/forgot-password','ForgotPasswordController@forgotPassword');
Route::post('/forgot-password','ForgotPasswordController@postForgotPassword');

Route::get('/reset/{email}/{resetCode}','ForgotPasswordController@resetPassword');

Route::post('/reset/{email}/{resetCode}','ForgotPasswordController@postResetPassword');


//ADMIN Routes

Route::get('/276281/admin/login','AdminController@adminLogin');
Route::post('/276281/admin/login','AdminController@postAdminLogin');

Route::get('/276281/admin/Samyog-DB','AdminController@viewSamyogDBForm');
Route::get('/276281/admin/Samyog-DB/logout','AdminController@logoutSamyogDB');


Route::post('/276281/admin/Samyog-DB/Organizations','AdminController@filterWithStatusOrgs');
Route::get('/276281/admin/Samyog-DB/Organizations','AdminController@displaytheOrgs');
Route::get('/276281/admin/Samyog-DB/Organizations/{email}/{old_status}','AdminController@toggleOrgStatus');


Route::post('/276281/admin/Samyog-DB/Volunteers','AdminController@filterWithStatusVols');
Route::get('/276281/admin/Samyog-DB/Volunteers','AdminController@displaytheVols');
Route::get('/276281/admin/Samyog-DB/Volunteers/{vol_email}/{old_status}','AdminController@toggleVolStatus');

Route::post('/276281/admin/Samyog-DB/Applications','AdminController@filterWithStatusApps');
Route::get('/276281/admin/Samyog-DB/Applications','AdminController@displaytheApps');
Route::get('/276281/admin/Samyog-DB/Applications/{app_id}/{old_status}','AdminController@toggleAppStatus');

Route::post('/276281/admin/Samyog-DB/Statistics','AdminController@viewWebsiteStats');


// forceAdminLogout
Route::get('/forceAdminLogout/{ip}/{uniquer}','AdminController@triggerAdminLogout');








//TODO::Change the api of organization end since much not organized and in use.











// Learning abiut pusher a working example below
// Route::get('event',function(){
//   \Debugbar::disable();
//   $message = "Hello";
//   Pusher::trigger('firstchannel', 'ApplicationStatusUpdated', ['message' => 'Rohan']);
// });
//
// Route::get('listen',function(){
//   \Debugbar::disable();
//   return view('listen_to_me');
// });
