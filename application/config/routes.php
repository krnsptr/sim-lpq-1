<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'beranda';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

$route['user/program/tambah'] = 'user/program_tambah';
$route['user/program/tambah/([1-2][1-3])'] = 'user/program_tambah/$1';
$route['user/program/([a-z]+)/(1|2)/([0-3])'] = 'user/program_$1/$2/$3';

$route['user/tambah/program'] = 'user/tambah_program';
$route['user/edit/program'] = 'user/edit_program';
$route['user/hapus/program'] = 'user/hapus_program';

$route['user/jadwal/hapus/([1-3])/(:num)'] = 'user/penjadwalan_pengajar_hapus/$1/$2';

$route['user/tambah/jadwal/2'] = 'user/tambah_penjadwalan_pengajar';
$route['user/edit/jadwal/2'] = 'user/edit_penjadwalan_pengajar';
$route['user/hapus/jadwal/2'] = 'user/hapus_penjadwalan_pengajar';
$route['user/edit/jumlah-kelompok'] = 'user/edit_jumlah_kelompok';

$route['user/edit/akun'] = 'user/edit_akun';
$route['user/edit/password'] = 'user/edit_password';
