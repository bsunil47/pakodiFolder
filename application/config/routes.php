<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$urlsegment = $_SERVER["REQUEST_URI"];
$urlsegment = explode('/', trim($urlsegment, '/'));
$route['default_controller'] = "frontend";
//print_r($urlsegment); exit;
if (empty($urlsegment[1])) {
    $urlsegment[1] = 0;
}
if ($urlsegment[0] == 'Admin' || $urlsegment[1] == 'Admin') {
    $url_se = ($urlsegment[0] == 'Admin') ? $urlsegment[0] : $urlsegment[1];
    $route['Admin'] = "{$url_se}/users";
    $route['Admin/users'] = "{$url_se}/admin/users";
    $route['Admin/useradd'] = "{$url_se}/admin/add";
    $route['Admin/useredit/(:num)'] = "{$url_se}/admin/edit/$1";
    $route['Admin/userdelete/(:num)'] = "{$url_se}/admin/delete/$1";
    $route['Admin/logout'] = "{$url_se}/admin/logout";
}

if ($urlsegment[0] == 'moderator' || $urlsegment[1] == 'moderator') {
    $url_se = ($urlsegment[0] == 'moderator') ? $urlsegment[0] : $urlsegment[1];
      $route['moderator'] = "{$url_se}/users";
    $route['moderator/users'] = "{$url_se}/moderator/users";
    $route['moderator/logout'] = "{$url_se}/moderator/logout";
}

if ($urlsegment[0] == 'dubsviewer' || $urlsegment[1] == 'dubsviewer') {
    $url_se = ($urlsegment[0] == 'dubsviewer') ? $urlsegment[0] : $urlsegment[1];
      $route['dubsviewer'] = "{$url_se}/users";
    $route['dubsviewer/users'] = "{$url_se}/dubsviewer/users";
    $route['dubsviewer/logout'] = "{$url_se}/dubsviewer/logout";
}


$route['404_override'] = '';

$route['terms'] = "frontend/terms";
$route['userlanguageslist']     = "apiusers/languageslist";
$route['usercategorylist']      = "apiusers/categorylist";
$route['apiuserregister']       = "apiusers/register";
$route['apiuserterms']          = "apiusers/terms";
$route['apiuseractivate']       = "apiusers/activate";
$route['apiuserresendpin']      = "apiusers/resend";
$route['apiuserdetails']        = "apiusers/userdetails";
$route['apiuserprofileupdate']  = "apiusers/profileupdate";
$route['devicedetailsregister'] = "apiusers/devicedetailsregister";
$route['apiuseraboutus']        = "apiusers/aboutus";
$route['contentpreferences']    = "apiusers/contentpreferences";
$route['landing']               = "apiusers/landing";
$route['trends']                = "apiusers/moretrends"; 
$route['recommonds']            = "apiusers/morerecommonds"; 
$route['contactus']             = "apiusers/contactus";
$route['apiuserscontentlist']   = "apiusers/contentlist"; 
$route['ratings']               = "apiusers/ratings";
$route['apiuserdubslist']       = "apiusers/dubslist";
$route['downloadlist']          = "apiusers/downloadlist"; 
$route['createdubs']            = "apiusers/dubs";
$route['apiuserrelatedlist']    = "apiusers/relatedcontentlist"; 
$route['privatetopublic']       = "apiusers/ptop";
$route['deletedub']             = "apiusers/deletedub";

