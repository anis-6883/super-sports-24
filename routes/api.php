<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FixureApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::Group(['middleware' => 'check_api_key'], function() {

	//ip
    Route::post('/v1/ip', function(Request $request){
        return $request->getClientIp(true);
    });

	Route::post('/v1/live_matches/{app_unique_id}', 'App\Http\Controllers\Api\v1\ApiController@live_matches');
	Route::post('/v1/highlights/{app_unique_id}', 'App\Http\Controllers\Api\v1\ApiController@highlights');
	Route::post('/v1/live_matches_by_type/{app_unique_id}', 'App\Http\Controllers\Api\v1\ApiController@live_matches_by_type');
	Route::post('/v1/streaming_sources/{app_unique_id}/{match_id}', 'App\Http\Controllers\Api\v1\ApiController@streaming_sources');
	Route::post('/v1/settings/{app_unique_id}/{platform?}', 'App\Http\Controllers\Api\v1\ApiController@settings');
	Route::post('/v1/promotions/{app_unique_id}', 'App\Http\Controllers\Api\v1\ApiController@promotions');
	Route::post('/v1/popular_series/{app_unique_id}', 'App\Http\Controllers\Api\v1\ApiController@popular_series');
	Route::post('/v1/support', 'App\Http\Controllers\Api\v1\ApiController@support');
	Route::post('/v1/sports/type', 'App\Http\Controllers\Api\v1\ApiController@sports_type');
	Route::post('/v01/live_matches/count/{app_unique_id}', 'App\Http\Controllers\Api\v1\ApiController@live_matches_count');
	
	//--------v2 Apis--------
	Route::post('/v2/settings', 'App\Http\Controllers\Api\v1\ApiController@settings_v2');
	Route::post('/v2/live_matches', 'App\Http\Controllers\Api\v1\ApiController@live_matches_v2');
	Route::post('/v2/streaming_sources', 'App\Http\Controllers\Api\v1\ApiController@streaming_sources_v2');
	Route::post('/v2/live_matches_by_type', 'App\Http\Controllers\Api\v1\ApiController@live_matches_by_type_v2');
  
	//-------------------------------------------// 
  	//-------------Live Streaming App--------------// 
	Route::post('/v01/bing/sport/matches', 'App\Http\Controllers\Api\v1\FootballApiController@bingsport_matches');
	Route::post('/v01/bing/sport/m3u8', 'App\Http\Controllers\Api\v1\FootballApiController@bingsport_m3u8');
	Route::post('/v01/bing/sport/news', 'App\Http\Controllers\Api\v1\FootballApiController@bingsport_news');
	//-------------Football App Api--------------// 
	//-------------------------------------------//
	Route::post('/v1/football/schedules', 'App\Http\Controllers\Api\v1\FootballApiController@match_schedules');
	Route::post('/v1/football/liveFT/match', 'App\Http\Controllers\Api\v1\FootballApiController@liveAndFtMatch');
  	Route::post('/v1/football/preview', 'App\Http\Controllers\Api\v1\FootballApiController@match_preview');
	Route::post('/v1/football/header', 'App\Http\Controllers\Api\v1\FootballApiController@header');
  	Route::post('/v1/football/lineups', 'App\Http\Controllers\Api\v1\FootballApiController@lineups');
  	Route::post('/v1/football/commentary', 'App\Http\Controllers\Api\v1\FootballApiController@commentary');
  	Route::post('/v1/football/statistics', 'App\Http\Controllers\Api\v1\FootballApiController@statistics');
	Route::post('/v1/football/standing/league', 'App\Http\Controllers\Api\v1\FootballApiController@standingLeague');
	Route::post('/v1/football/standing/year', 'App\Http\Controllers\Api\v1\FootballApiController@standingYear');
	Route::post('/v1/football/standing/details', 'App\Http\Controllers\Api\v1\FootballApiController@standingDetails');
	Route::post('/v1/football/news', 'App\Http\Controllers\Api\v1\FootballApiController@news');
	Route::post('/v1/football/news_details', 'App\Http\Controllers\Api\v1\FootballApiController@newsDetails');
	
	Route::post('/v2/football/liveFT/match', 'App\Http\Controllers\Api\v1\FootballApiController@liveAndFtMatch2');
	
	// 
	//--------v2 Apis-------- 
	Route::post('/v2/football/news', 'App\Http\Controllers\Api\v1\FootballApiController@news_v2');
	
	//-------------------------------------------//
	//-------Cricket App Api upcomingMatch-------//
	//-------------------------------------------//
	Route::post('/v1/cricket/live-match', 'App\Http\Controllers\Api\v1\CricketApiController@liveMatch');
	Route::post('/v1/cricket/today/match', 'App\Http\Controllers\Api\v1\CricketApiController@todayMatch'); //(v02-Api)
	Route::post('/v1/cricket/match/schedule', 'App\Http\Controllers\Api\v1\CricketApiController@upcomin_v2Match'); //(v02-Api)
	Route::post('/v1/cricket/upcoming/match', 'App\Http\Controllers\Api\v1\CricketApiController@upcomingMatch');
	Route::post('/v1/cricket/recent/match', 'App\Http\Controllers\Api\v1\CricketApiController@recentMatch');
	//-------News
	Route::post('/v1/cricket/home-news', 'App\Http\Controllers\Api\v1\CricketApiController@homeNews');
	Route::post('/v1/cricket/all-news', 'App\Http\Controllers\Api\v1\CricketApiController@allNews');
	//-------Point Table
	Route::post('/v1/cricket/point-table', 'App\Http\Controllers\Api\v1\CricketApiController@pointTableList');
	Route::post('/v1/cricket/point-table/details', 'App\Http\Controllers\Api\v1\CricketApiController@pointTableDetails');
	//-------Ai Predictions
	Route::post('/v1/cricket/ai/predictions', 'App\Http\Controllers\Api\v1\CricketApiController@aiPredictions');
	
	//-------New Api-------
	Route::post('/v2/cricket/upcoming/match', 'App\Http\Controllers\Api\v1\CricketApiController@v2UpcomingMatch');
	Route::post('/v2/cricket/live/match', 'App\Http\Controllers\Api\v1\CricketApiController@v2LiveMatch');
	Route::post('/v2/cricket/details/match', 'App\Http\Controllers\Api\v1\CricketApiController@v2MatchDetails');
	
	
	//fixures api
	Route::post('fixtures', 'App\Http\Controllers\Api\v1\ApiController@fixtures');
	Route::post('fixures_by_type', 'App\Http\Controllers\Api\v1\ApiController@fixures_by_type');
	
	//promotion by type
	Route::post('/v2/promotion_by_type', 'App\Http\Controllers\Api\v1\ApiController@promotion_by_type');

	//--------------------------------//
	//--------Football New Api -> WindFootball--------//
	//--------------------------------// 
	//-> Home Api
	Route::post('/v3/football/home', 'App\Http\Controllers\Api\v1\FotbalNewApiController@football_home');
	Route::post('/v3/football/home/details/news', 'App\Http\Controllers\Api\v1\FotbalNewApiController@fbal_home_dtls_news');
	//-------Team Details Api-------//
	Route::post('/v3/football/team/fixtures', 'App\Http\Controllers\Api\v1\FotbalNewApiController@fbal_team_fixtures');
	Route::post('/v3/football/team/squad', 'App\Http\Controllers\Api\v1\FotbalNewApiController@fbal_team_squad');
	Route::post('/v3/football/team/stats', 'App\Http\Controllers\Api\v1\FotbalNewApiController@fbal_team_stats');
	Route::post('/v3/football/team/transfers', 'App\Http\Controllers\Api\v1\FotbalNewApiController@fbal_team_transfers');
	//-------END Team Details Api-------//
	
	//-------League Details Api-------//
	Route::post('/v3/football/league/fixtures', 'App\Http\Controllers\Api\v1\FotbalNewApiController@fbal_league_fixtures');
	Route::post('/v3/football/league/table', 'App\Http\Controllers\Api\v1\FotbalNewApiController@fbal_league_table');
	Route::post('/v3/football/league/stats', 'App\Http\Controllers\Api\v1\FotbalNewApiController@fbal_league_stats');
	Route::post('/v3/football/league/team', 'App\Http\Controllers\Api\v1\FotbalNewApiController@fbal_league_team');
	Route::post('/v3/football/league/transfers', 'App\Http\Controllers\Api\v1\FotbalNewApiController@fbal_league_transfers');
	//-------END League Details Api-------//
	
	//-------All Teams Start Api-------//
	Route::post('/v3/football/all/teams', 'App\Http\Controllers\Api\v1\FotbalNewApiController@fbal_all_teamsl');
	Route::post('/v3/football/tournament/teams', 'App\Http\Controllers\Api\v1\FotbalNewApiController@fbal_turnament_teamsls');
	//-------All Teams End Api-------//
	
	//--------------------------------//
	//--------Tennis Api -> TennisAction--------//
	//--------------------------------// 
	//-> Home Api
	Route::post('/v3/tennis/schedules', 'App\Http\Controllers\Api\v1\TennisApiController@tennis_schedules');
	Route::post('/v3/tennis/ranking', 'App\Http\Controllers\Api\v1\TennisApiController@tennis_ranking');
	Route::post('/v3/tennis/schedulet/details', 'App\Http\Controllers\Api\v1\TennisApiController@tennis_schedule_details');

	Route::post('/v1/newsapi', 'App\Http\Controllers\Api\v1\ApiController@newsapi');


	//AuthController
    Route::post('/v1/signup', 'App\Http\Controllers\Api\v1\AuthController@signup');
    Route::post('/v1/signin', 'App\Http\Controllers\Api\v1\AuthController@signin');
    Route::post('/v1/forget_password', 'App\Http\Controllers\Api\v1\AuthController@forget_password');

    //SubscriptionController
    Route::post('/v1/subscriptions', 'App\Http\Controllers\Api\v1\SubscriptionController@subscriptions');
    
    //optiona_auth
    Route::middleware('optiona_auth')->group( function () {
        //HomeController
        // Route::post('/v1/home', 'App\Http\Controllers\Api\v1\HomeController@home');
    });

    //auth
    Route::middleware('auth:sanctum')->group( function () {

        //AuthController
        Route::post('/v1/user', 'App\Http\Controllers\Api\v1\AuthController@user');
        Route::post('/v1/user_update', 'App\Http\Controllers\Api\v1\AuthController@user_update');
        Route::post('/v1/change_password', 'App\Http\Controllers\Api\v1\AuthController@change_password');

        //SubscriptionController
        Route::post('/v1/subscription_update', 'App\Http\Controllers\Api\v1\SubscriptionController@subscription_update');
        Route::post('/v1/subscription_expired', 'App\Http\Controllers\Api\v1\SubscriptionController@subscription_expired');
        Route::post('/v1/subscription_restore', 'App\Http\Controllers\Api\v1\SubscriptionController@subscription_restore');
        Route::post('/v1/payments', 'App\Http\Controllers\Api\v1\SubscriptionController@payments');
    });

	//--------------------------------//
	//--------FIFA--------//
	//--------------------------------// 
	Route::post('/v1/fifa2022/home', 'App\Http\Controllers\Api\v1\Fifa2022Controller@fifa2022home');
	Route::post('/v1/fifa2022/team/fixtures', 'App\Http\Controllers\Api\v1\Fifa2022Controller@fifa2022_fixtures');
	Route::post('/v1/fifa2022/team/squad', 'App\Http\Controllers\Api\v1\Fifa2022Controller@fifa22_team_squad');
	Route::post('/v1/fifa2022/stadium', 'App\Http\Controllers\Api\v1\Fifa2022Controller@stadiumList22');
	Route::post('/v1/fifa2022/table', 'App\Http\Controllers\Api\v1\Fifa2022Controller@fifa22standing');
	
	//--------TV Guide APi--------//
	Route::post('/v1/tv/guide/country', 'App\Http\Controllers\Api\v1\Fifa2022Controller@tvGuideCountry');
	Route::post('/v1/tv/guide/fixtures', 'App\Http\Controllers\Api\v1\Fifa2022Controller@tvGuideFixtures');
	Route::post('/v2/tv/guide/fixtures', 'App\Http\Controllers\Api\v1\Fifa2022Controller@tvGuideFixturesv2');
	Route::post('/v2/tv/guide/details', 'App\Http\Controllers\Api\v1\Fifa2022Controller@tvGuideDetailsv2');
	//-------//

	//FootballfanstvController
	Route::post('/v1/footballfanstv/news', 'App\Http\Controllers\Api\v1\FootballfanstvController@news');

	//--------TV Guide APi--------//
	Route::post('/v1/tv/guide/country', 'App\Http\Controllers\Api\v1\Fifa2022Controller@tvGuideCountry');
	Route::post('/v1/tv/guide/fixtures', 'App\Http\Controllers\Api\v1\Fifa2022Controller@tvGuideFixtures');
	//-------//

	//--------------------------------//
	//--------v6 Cricket World--------//
	//--------------------------------// 
	Route::post('/v6/cricket/fixtures', 'App\Http\Controllers\Api\v1\CricketApiController@v6CricketFixtures');
	Route::post('/v6/cricket/preview', 'App\Http\Controllers\Api\v1\CricketApiController@v6CricketPreview');
	Route::post('/v6/cricket/live', 'App\Http\Controllers\Api\v1\CricketApiController@v6CricketLive');
	Route::post('/v6/cricket/complete', 'App\Http\Controllers\Api\v1\CricketApiController@v6CricketComplete');
	//------END------//
	

});

Route::post('/v1/cricket/today/match/demo', 'App\Http\Controllers\Api\v1\CricketApiController@todayMatch');
Route::post('/v1/cricket/match/schedule/demo', 'App\Http\Controllers\Api\v1\CricketApiController@upcomin_v2Match');

Route::post('/v1/app/user/ip', 'App\Http\Controllers\Api\v1\CricketApiController@userIp');
//Test Apis
Route::post('/v1/cricket/manage/app1', 'App\Http\Controllers\Api\v1\CricketApiController@rexApp01');

