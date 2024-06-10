<?php

use Illuminate\Support\Facades\Route;

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
  return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::group(['prefix' => 'admin'], function () {
  Route::get('/', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
  Route::get('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
  Route::post('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);
  Route::post('/logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');

  // Route::get('/register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
  // Route::post('/register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'register']);

  Route::post('/password/email', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.request');
  Route::post('/password/reset', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'reset'])->name('password.email');
  Route::get('/password/reset', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.reset');
  Route::get('/password/reset/{token}', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'showResetForm']);


  Route::get('/homeSettings', [App\Http\Controllers\Admin\AdminController::class, 'homeSettings'])->name('admin.homeSettings');
   Route::post('/updateHomeSettings', [App\Http\Controllers\Admin\AdminController::class, 'updateHomeSettings'])->name('admin.updateHomeSettings');

  Route::get('/about', [App\Http\Controllers\Admin\AdminController::class, 'about'])->name('admin.about');
  Route::post('/updateAbout', [App\Http\Controllers\Admin\AdminController::class, 'updateAbout'])->name('admin.updateAbout');

  
  Route::get('/education', [App\Http\Controllers\Admin\AdminController::class, 'education'])->name('admin.experience');
  Route::post('/addEducation', [App\Http\Controllers\Admin\AdminController::class, 'addEducation'])->name('admin.addEducation');
  Route::post('/editEducation', [App\Http\Controllers\Admin\AdminController::class, 'editEducation'])->name('admin.editEducation');
  Route::post('/deleteEducation', [App\Http\Controllers\Admin\AdminController::class, 'deleteEducation'])->name('admin.deleteEducation');


  Route::get('/experience', [App\Http\Controllers\Admin\AdminController::class, 'experience'])->name('admin.experience');
  Route::post('/addExperience', [App\Http\Controllers\Admin\AdminController::class, 'addExperience'])->name('admin.addExperience');
  Route::post('/editExperience', [App\Http\Controllers\Admin\AdminController::class, 'editExperience'])->name('admin.editExperience');
  Route::post('/deleteExperience', [App\Http\Controllers\Admin\AdminController::class, 'deleteExperience'])->name('admin.deleteExperience');

  Route::get('/skills', [App\Http\Controllers\Admin\AdminController::class, 'skills'])->name('admin.skills');
  Route::post('/addSkills', [App\Http\Controllers\Admin\AdminController::class, 'addSkills'])->name('admin.addSkills');
  Route::post('/editSkills', [App\Http\Controllers\Admin\AdminController::class, 'editSkills'])->name('admin.editSkills');
  Route::post('/deleteSkills', [App\Http\Controllers\Admin\AdminController::class, 'deleteSkills'])->name('admin.deleteSkills');

  Route::get('/tools', [App\Http\Controllers\Admin\AdminController::class, 'tools'])->name('admin.tools');
  Route::post('/addTools', [App\Http\Controllers\Admin\AdminController::class, 'addTools'])->name('admin.addTools');
  Route::post('/editTools', [App\Http\Controllers\Admin\AdminController::class, 'editTools'])->name('admin.editTools');
  Route::post('/deleteTools', [App\Http\Controllers\Admin\AdminController::class, 'deleteTools'])->name('admin.deleteTools');


  Route::get('/services', [App\Http\Controllers\Admin\AdminController::class, 'services'])->name('admin.services');
  Route::post('/addServices', [App\Http\Controllers\Admin\AdminController::class, 'addServices'])->name('admin.addServices');
  Route::post('/editServices', [App\Http\Controllers\Admin\AdminController::class, 'editServices'])->name('admin.editServices');
  Route::post('/deleteServices', [App\Http\Controllers\Admin\AdminController::class, 'deleteServices'])->name('admin.deleteServices');


  Route::get('/projects', [App\Http\Controllers\Admin\AdminController::class, 'projects'])->name('admin.projects');
  Route::post('/addProjects', [App\Http\Controllers\Admin\AdminController::class, 'addProjects'])->name('admin.addProjects');
  Route::post('/editProjects', [App\Http\Controllers\Admin\AdminController::class, 'editProjects'])->name('admin.editProjects');
  Route::post('/deleteProjects', [App\Http\Controllers\Admin\AdminController::class, 'deleteProjects'])->name('admin.deleteProjects');

  Route::get('/testimonials', [App\Http\Controllers\Admin\AdminController::class, 'testimonials'])->name('admin.testimonials');
  Route::post('/addTestimonials', [App\Http\Controllers\Admin\AdminController::class, 'addTestimonials'])->name('admin.addTestimonials');
  Route::post('/editTestimonials', [App\Http\Controllers\Admin\AdminController::class, 'editTestimonials'])->name('admin.editTestimonials');
  Route::post('/deleteTestimonials', [App\Http\Controllers\Admin\AdminController::class, 'deleteTestimonials'])->name('admin.deleteTestimonials');


  Route::get('/contacts', [App\Http\Controllers\Admin\AdminController::class, 'contact'])->name('admin.contact');
  Route::post('/addContacts', [App\Http\Controllers\Admin\AdminController::class, 'addContacts'])->name('admin.addContacts');
  Route::post('/editContacts', [App\Http\Controllers\Admin\AdminController::class, 'editContacats'])->name('admin.editContacts');
  Route::post('/deleteContacts', [App\Http\Controllers\Admin\AdminController::class, 'deleteContacts'])->name('admin.deleteContacts');





  Route::get('/home', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('home')->middleware(['auth:admin']);
});
