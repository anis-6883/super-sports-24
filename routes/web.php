<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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


//Auth::routes(['register' => false]);

//date_default_timezone_set('Asia/Dhaka');

Route::group(['middleware' => ['install']], function () {
    Route::get('/', 'App\Http\Controllers\HomeController@index');

    Route::get('/em-root', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
	Route::post('/em-root', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
    Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    //auth
    Route::group(['middleware' => ['auth']], function () {
    	Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    	
        //Profile Controller
        Route::get('profile/show', 'App\Http\Controllers\ProfileController@show')->name('profile.show');
        Route::get('profile/edit', 'App\Http\Controllers\ProfileController@edit')->name('profile.edit');
        Route::post('profile/update', 'App\Http\Controllers\ProfileController@update')->name('profile.update');
        Route::get('password/change', 'App\Http\Controllers\ProfileController@password_change')->name('password.change');
        Route::post('password/update', 'App\Http\Controllers\ProfileController@update_password')->name('password.update');
        //Settings Controller
        Route::any('general_settings', 'App\Http\Controllers\SettingController@general')->name('general_settings');
        Route::any('app_settings', 'App\Http\Controllers\SettingController@app')->name('app_settings');
        Route::any('cache_clear', 'App\Http\Controllers\SettingController@cache_clear')->name('cache_clear');
        Route::post('store_settings', 'App\Http\Controllers\SettingController@store_settings')->name('store_settings');
        
        //Backup Controller
        Route::any('database_backup', 'App\Http\Controllers\BackupController@index')->name('database_backup');
        Route::get('notifications/deleteall', 'App\Http\Controllers\NotificationController@deleteall');
        Route::post('notifications/delete/selectedNotifications', 'App\Http\Controllers\NotificationController@deleteSelectedNotifications')->name('delete.selected.notification');
        Route::resource('notifications', 'App\Http\Controllers\NotificationController');
                 
        //App Controller
        Route::resource('apps', 'App\Http\Controllers\AppController');
        Route::get('manage_app/{app_unique_id?}', 'App\Http\Controllers\ManageAppController@index');
        Route::post('store_app_settings/{app_id}/{platform}', 'App\Http\Controllers\ManageAppController@store_app_settings')->name('store_app_settings');

        Route::resource('sports_types', 'App\Http\Controllers\SportsTypeController');
        Route::match(['get', 'post'], 'live_matches/clone/{id?}', 'App\Http\Controllers\LiveMatchController@clone')->name('live_matches.clone');
        Route::post('live_matches/notification', 'App\Http\Controllers\NotificationController@sent_notification')->name('live_matches.notification');
        Route::post('live_matches/reorder', 'App\Http\Controllers\LiveMatchController@reorder');
        Route::post('live_matches/reorderStreamingSources', 'App\Http\Controllers\LiveMatchController@reorderStreamingSources');
        Route::resource('live_matches', 'App\Http\Controllers\LiveMatchController');
		Route::resource('highlights', 'App\Http\Controllers\HighlightController');
        Route::resource('promotions', 'App\Http\Controllers\PromotionController');
        Route::resource('popular_series', 'App\Http\Controllers\PopularSeriesController');
        Route::resource('fixures', 'App\Http\Controllers\FixureController');

        //UserController
        Route::get('users/app/{app_unique_id}', [App\Http\Controllers\UserController::class, 'index']);
        Route::resource('users', App\Http\Controllers\UserController::class);

        //SubscriptionController
        Route::get('subscriptions/app/{app_unique_id}', [App\Http\Controllers\SubscriptionController::class, 'index']);
        Route::resource('subscriptions', App\Http\Controllers\SubscriptionController::class);
        Route::get('subscriptions/get_subscriptions/{app_id}', [App\Http\Controllers\SubscriptionController::class, 'get_subscriptions']);

        //PaymentController
        Route::resource('payments', App\Http\Controllers\PaymentController::class);

        Route::get('update/{table}/{id}/{field}/{value}', function($table, $id, $field, $value){
            \DB::table($table)->where('id', $id)->update([$field => $value]);

            return response()->json(['result' => 'success', 'message' => _lang( $field . ' has been updated sucessfully.')]);
        });

    });

});

Route::get('/cache', function(){
	cache()->flush();
});

Route::get('/log-clear', function(){
    exec('rm -f ' . storage_path('logs/*.log'));
    exec('rm -f ' . base_path('*.log'));
});

Route::get('/ip', function(Request $request){
    return $request->getClientIp(true);
});


//Install Controller
Route::get('/installation', 'App\Http\Controllers\Install\InstallController@index');
Route::get('install/database', 'App\Http\Controllers\Install\InstallController@database');
Route::post('install/process_install', 'App\Http\Controllers\Install\InstallController@process_install');
Route::get('install/create_user', 'App\Http\Controllers\Install\InstallController@create_user');
Route::post('install/store_user', 'App\Http\Controllers\Install\InstallController@store_user');
Route::get('install/system_settings', 'App\Http\Controllers\Install\InstallController@system_settings');
Route::post('install/finish', 'App\Http\Controllers\Install\InstallController@final_touch');

Route::get('/server_cache_clear', 'App\Http\Controllers\WebsiteController@server_cache_clear');




