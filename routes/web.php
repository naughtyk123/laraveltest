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
Route::get('/', 'Front@index')->name('front');
Route::get('front', 'Front@index')->name('front');

Route::get('create_user', 'Users@index')->name('create_user');
Route::post('add_user', 'Users@add_user')->name('add_user');




Route::get('blog/{id}', 'Front@blog')->name('blog');









Route::get('login/{id?}', 'Admin@login')->name('login');
Route::get('logout/{id?}',  'Admin@login');
Route::post('attempt_login', 'Login@login')->name('attempt_login');

Route::get('forget-password', 'Admin@forget_password')->name('forget-password');


Route::post('resetemail', 'Login@resetemail')->name('resetemail');
Route::get('change-password-view/{id}', 'Login@change_password_view')->name('change_password_view');
Route::post('resetpassword', 'Login@resetpassword')->name('resetpassword');




// Route::get('/', 'Admin@login');

Route::group(['middleware' => ['admincheck']], function () {
    Route::get('create_blog', 'Users@create_blog')->name('create_blog');
    Route::get('blog_list', 'Users@blog_list')->name('blog_list');
    Route::get('dashboard', 'AdminController@Index')->name('dashboard');
    Route::post('update_details', 'Users@update_details')->name('update_details');
    Route::post('delete_blog', 'Users@delete_blog')->name('delete_blog');
    Route::post('uploads', 'Tinymce@uploads')->name('uploadstiny');
    Route::post('remove_tiny_image', 'Tinymce@remove_tiny_image')->name('remove_tiny_image');
    Route::post('add_blog', 'Users@add_blog')->name('add_blog');
    Route::get('blog_update/{id}', 'Users@blog_update')->name('blog_update');

    // Route::get('create_user', 'Users@index')->name('create_user');
  
    Route::get('user-list', 'Users@user_list')->name('user-list');
    Route::get('get_users_list', 'Users@get_users_list')->name('get_users_list');
    Route::get('edit-user/{id}', 'Users@edit_user')->name('edit-user');
    Route::post('edit_user_details', 'Users@edit_user_details')->name('edit_user_details');
    Route::post('delete_user', 'Users@delete_user')->name('delete_user');

    
    Route::get('create-groups', 'Group@index')->name('create-groups');
    Route::post('save_group', 'Group@save_group')->name('save_group');
    Route::post('edit_group', 'Group@edit_group')->name('edit_group');
    Route::get('get_user_groups', 'Group@get_user_groups')->name('get_user_groups');

    Route::get('system-menu', 'System@index')->name('system-menu');
    Route::get('group-permission/{id}', 'System@system_permission')->name('group-permission');
    Route::get('user-permission/{id}', 'System@system_permission')->name('user-permission');

    Route::post('add_permission', 'System@add_permission')->name('add_permission');
    Route::post('edit_parent_permission', 'System@edit_parent_permission')->name('edit_parent_permission');

    Route::get('get_maine_menus', 'System@get_maine_menus')->name('get_maine_menus');
    Route::post('add_sub_function', 'System@add_sub_function')->name('add_sub_function');
    Route::post('edit_sub_function', 'System@edit_sub_function')->name('edit_sub_function');

    Route::get('getmenus', 'System@getmenus')->name('getmenus');
    Route::get('get_permission_table', 'System@get_permission_table')->name('get_permission_table');
    Route::post('add_group_permission', 'System@add_group_permission')->name('add_group_permission');
    Route::get('getpermissions_to_show', 'System@getpermissions_to_show')->name('getpermissions_to_show');
    /*rout to edit group*/
    Route::post('edit_group', 'Group@edit_group')->name('edit_group');
    Route::get('get_user_groups', 'Group@get_user_groups')->name('get_user_groups');
    Route::post('status_change', 'Users@status_change')->name('status_change');
});
