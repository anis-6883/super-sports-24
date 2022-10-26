<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\LiveMatch;
use App\Models\Prediction;
use App\Models\Setting;
use App\Models\StreamingSource;
use App\Models\AppContent;
use App\Models\AppModel;
use App\Models\Promotion;
use App\Models\PopularSeries;
use App\Models\SportsType;
use Illuminate\Http\Request;
use App\Models\Fixure;
use App\Models\Highlight;
use App\Models\HighlightStreamingSource;
use DB;
use Cache;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiController extends Controller
{
    public function live_matches(Request $request, $app_unique_id) 
    {
		$base_url = url('/');
        $status = true;
        $live_matches = Cache::rememberForever('live_matches_' . $app_unique_id, function () use($base_url, $app_unique_id) {
                return LiveMatch::select('live_matches.*', \DB::raw("CASE WHEN team_one_image_type = 'url' THEN team_one_url WHEN team_one_image_type = 'image' THEN CONCAT('$base_url/', team_one_image) ELSE '$base_url/public/default/default-team.png' END AS team_one_image"), \DB::raw("CASE WHEN team_two_image_type = 'url' THEN team_two_url WHEN team_two_image_type = 'image' THEN CONCAT('$base_url/', team_two_image) ELSE '$base_url/public/default/default-team.png' END AS team_two_image"), \DB::raw("CASE WHEN cover_image_type = 'url' THEN cover_url WHEN cover_image_type = 'image' THEN CONCAT('$base_url/', cover_image) ELSE '$base_url/public/default/default-team.png' END AS cover_image"))
                        ->join('live_match_apps', 'live_match_apps.match_id', 'live_matches.id')
                        ->join('apps', 'apps.id', 'live_match_apps.app_id')
                        ->where('apps.app_unique_id', $app_unique_id)
                        ->orderBy('position', 'ASC')
                        ->get()
                        ->makeHidden(['status', 'created_at', 'updated_at']);
        });

        $data = array();
        $ip = $request->ip();
        $i = 0;

        foreach ($live_matches as $key => $value) {

            $data[$i] = $value->makeHidden(['sports_type_id', 'team_one_image_type', 'team_one_url', 'team_two_image_type', 'team_two_url']);
            
            $streaming_sources = array();
            $streamingSources = Cache::rememberForever('streamingSources_' . $value->id, function () use ($value){
            	return StreamingSource::where('match_id', $value->id)->orderBy('position', 'ASC')->get();
            });
            foreach ($streamingSources as $key2 => $source) {
                if ($source->stream_type == 'root_stream') {
                    $source->stream_url = getGeneratedToken($source->stream_url, $source->stream_key, $ip);
					
                    $streaming_sources[] = $source->makeHidden(['block_country', 'is_block_them', 'created_at', 'updated_at']);
                }else{
					if($request->platform == 'android' && $source->stream_type == 'restricted'){
						$headers = array();
						$i2 = 0;
						foreach(json_decode($source->headers, true) AS $key => $value){

							if($key != 'User-Agent'){
								$headers[$i2]['name'] = $key;
								$headers[$i2]['value'] = $value;
								$i2 ++;
							}else{
								$source->$key = $value;
							}


						}
						$source->headers = $headers;
					}
					
					
                    $streaming_sources[] = $source->makeHidden(['block_country', 'is_block_them', 'created_at', 'updated_at']);
                }
            }
            $data[$i]['streaming_sources'] = $streaming_sources;

            $i++;
        }
        return response()->json(['status' => $status, 'data' => $data]);
    }
	
	public function live_matches_by_type(Request $request, $app_unique_id)
	{
		$base_url = url('/');
        $status = true;

        $data = Cache::rememberForever('sports_types', function () use ($base_url){
			return SportsType::select('*', \DB::raw("CONCAT('$base_url/public/uploads/sports_images/', sports_skq, '.png') AS sports_image"))
								->get();
		});

        if($request->skq != '' && $request->skq != 'all'){
        	$types = $data->where('sports_skq', $request->skq)->pluck('id')->toArray();
        }else{
        	$types = $data->pluck('id')->toArray();
        }
			
        $live_matches = Cache::rememberForever('live_matches_' . $app_unique_id, function () use($base_url, $app_unique_id) {
                return LiveMatch::select('live_matches.*', \DB::raw("CASE WHEN team_one_image_type = 'url' THEN team_one_url WHEN team_one_image_type = 'image' THEN CONCAT('$base_url/', team_one_image) ELSE '$base_url/public/default/default-team.png' END AS team_one_image"), \DB::raw("CASE WHEN team_two_image_type = 'url' THEN team_two_url WHEN team_two_image_type = 'image' THEN CONCAT('$base_url/', team_two_image) ELSE '$base_url/public/default/default-team.png' END AS team_two_image"), \DB::raw("CASE WHEN cover_image_type = 'url' THEN cover_url WHEN cover_image_type = 'image' THEN CONCAT('$base_url/', cover_image) ELSE '$base_url/public/default/default-team.png' END AS cover_image"))
                        ->join('live_match_apps', 'live_match_apps.match_id', 'live_matches.id')
                        ->join('apps', 'apps.id', 'live_match_apps.app_id')
                        ->where('apps.app_unique_id', $app_unique_id)
                        ->orderBy('position', 'ASC')
                        ->get()
                        ->makeHidden(['status', 'created_at', 'updated_at']);
        });

        

        $live_matches = $live_matches->whereIn('sports_type_id', $types);

        $data = array();
        $ip = $request->ip();
        $i = 0;

        foreach ($live_matches as $key => $value) {

            $data[$i] = $value->makeHidden(['sports_type_id', 'team_one_image_type', 'team_one_url', 'team_two_image_type', 'team_two_url']);
            
            $streaming_sources = array();
            $streamingSources = Cache::rememberForever('streamingSources_' . $value->id, function () use ($value){
            	return StreamingSource::where('match_id', $value->id)->orderBy('position', 'ASC')->get();
            });
            foreach ($streamingSources as $key2 => $source) {
                if ($source->stream_type == 'root_stream') {
                    $source->stream_url = getGeneratedToken($source->stream_url, $source->stream_key, $ip);
					
                    $streaming_sources[] = $source->makeHidden(['block_country', 'is_block_them', 'created_at', 'updated_at']);
                }else{
					if($request->platform == 'android' && $source->stream_type == 'restricted'){
						$headers = array();
						$i2 = 0;
						foreach(json_decode($source->headers, true) AS $key => $value){

							if($key != 'User-Agent'){
								$headers[$i2]['name'] = $key;
								$headers[$i2]['value'] = $value;
								$i2 ++;
							}else{
								$source->$key = $value;
							}


						}
						$source->headers = $headers;
					}
					
					
                    $streaming_sources[] = $source->makeHidden(['block_country', 'is_block_them', 'created_at', 'updated_at']);
                }
            }
            $data[$i]['streaming_sources'] = $streaming_sources;

            $i++;
        }
        return response()->json(['status' => $status, 'data' => $data]);
	}
	
	public function streaming_sources(Request $request, $app_unique_id, $match_id) 
    {
		$base_url = url('/');
        $status = true;
        $live_match = Cache::rememberForever('live_match_' . $match_id, function () use ($match_id, $app_unique_id){
            return LiveMatch::select('live_matches.*')
                        ->join('live_match_apps', 'live_match_apps.match_id', 'live_matches.id')
                        ->join('apps', 'apps.id', 'live_match_apps.app_id')
						->where('live_matches.id', $match_id)
                        ->where('apps.app_unique_id', $app_unique_id)
                        ->orderBy('id', 'DESC')
                        ->first();
        });
		
		if(!$live_match){
			return response()->json(['status' => false, 'message' => 'No matches found.']);
		}

        $ip = $request->ip_address ?? $request->getClientIp(true);
        //$location = get_location($ip);
		
        $streaming_sources = array();
        $streamingSources = Cache::rememberForever('streamingSources_' . $live_match->id, function () use ($live_match){
        	return StreamingSource::where('match_id', $live_match->id)->orderBy('position', 'ASC')->get();
        });
        foreach ($streamingSources as $key2 => $source) {

			//if($source->block_country != '' || $source->block_country != null){
				//if($source->is_block_them == 1 && str_contains($source->block_country, $location['country'])){
					//continue;
				//}

				//if($source->is_block_them == 0 && !str_contains($source->block_country, $location['country'])){
					//continue;
				//}
			//}

			if ($source->stream_type == 'root_stream') {
				$source->stream_url = getGeneratedToken($source->stream_url, $source->stream_key, $ip);
				$streaming_sources[] = $source->makeHidden(['block_country', 'is_block_them', 'created_at', 'updated_at']);
			}else{
				//if($request->headers_type == 'array' && $source->stream_type == 'restricted'){
					//$headers = array();
					//$i2 = 0;
					//foreach(json_decode($source->headers) AS $key => $value){
						//$headers[$i2]['name'] = $key;
						//$headers[$i2]['value'] = $value;
						
						//$i2 ++;
					//}
					//$source->headers = $headers;
				//}
				if($request->platform == 'android' && $source->stream_type == 'restricted'){
					$headers = array();
					$i2 = 0;
					foreach(json_decode($source->headers, true) AS $key => $value){

						if($key != 'User-Agent'){
							$headers[$i2]['name'] = $key;
							$headers[$i2]['value'] = $value;
							$i2 ++;
						}else{
							$source->$key = $value;
						}
						
						
					}
					$source->headers = $headers;
				}
				if($request->platform == 'ios' && $source->stream_type == 'restricted'){
					//$headers = array();
					//$i2 = 0;
					//foreach(json_decode($source->headers, true) AS $key => $value){

						//if($key != 'User-Agent'){
							//$headers[$i2] = (array) ['name' => $key, 'value' => $value];
							//$i2 ++;
						//}else{
							//$source->$key = $value;
						//}
						
						
					//}
					$source->headers = json_decode($source->headers, true);
				}
				$streaming_sources[] = $source->makeHidden(['block_country', 'is_block_them', 'created_at', 'updated_at']);
			}
        }
        return response()->json(['status' => $status, 'data' => $streaming_sources]);
    }
	
	public function highlights(Request $request, $app_unique_id) 
    {
		$base_url = url('/');
        $status = true;
        $highlights = Cache::rememberForever('highlights_' . $app_unique_id, function () use($base_url, $app_unique_id) {
                return Highlight::select('highlights.*', \DB::raw("CASE WHEN team_one_image_type = 'url' THEN team_one_url WHEN team_one_image_type = 'image' THEN CONCAT('$base_url/', team_one_image) ELSE '$base_url/public/default/default-team.png' END AS team_one_image"), \DB::raw("CASE WHEN team_two_image_type = 'url' THEN team_two_url WHEN team_two_image_type = 'image' THEN CONCAT('$base_url/', team_two_image) ELSE '$base_url/public/default/default-team.png' END AS team_two_image"), \DB::raw("CASE WHEN cover_image_type = 'url' THEN cover_url WHEN cover_image_type = 'image' THEN CONCAT('$base_url/', cover_image) ELSE '$base_url/public/default/default-team.png' END AS cover_image"))
                        ->join('highlight_apps', 'highlight_apps.highlight_id', 'highlights.id')
                        ->join('apps', 'apps.id', 'highlight_apps.app_id')
                        ->where('apps.app_unique_id', $app_unique_id)
                        ->orderBy('id', 'DESC')
                        ->get()
                        ->makeHidden(['status', 'created_at', 'updated_at']);
        });

        $data = array();
        $ip = $request->ip();
        $i = 0;

        foreach ($highlights as $key => $value) {

            $data[$i] = $value->makeHidden(['sports_type_id', 'team_one_image_type', 'team_one_url', 'team_two_image_type', 'team_two_url']);
            
            $streaming_sources = array();
            $streamingSources = Cache::rememberForever('highlightStreamingSources_' . $value->id, function () use ($value){
            	return HighlightStreamingSource::where('highlight_id', $value->id)->get();
            });
            foreach ($streamingSources as $key2 => $source) {

                if ($source->stream_type == 'root_stream') {
                    $source->stream_url = getGeneratedToken($source->stream_url, $source->stream_key, $ip);
					
                    $streaming_sources[] = $source->makeHidden(['block_country', 'is_block_them', 'created_at', 'updated_at']);
                }else{

					if($request->platform == 'android' && $source->stream_type == 'restricted'){
						$headers = array();
						$i2 = 0;
						foreach(json_decode($source->headers, true) AS $key => $value){

							if($key != 'User-Agent'){
								$headers[$i2]['name'] = $key;
								$headers[$i2]['value'] = $value;
								$i2 ++;
							}else{
								$source->$key = $value;
							}


						}
						$source->headers = $headers;
					}
					
					
                    $streaming_sources[] = $source->makeHidden(['block_country', 'is_block_them', 'created_at', 'updated_at']);
                }
            }
            $data[$i]['streaming_sources'] = $streaming_sources;

            $i++;
        }
        return response()->json(['status' => $status, 'data' => $data]);
    }

    public function promotions(Request $request, $app_unique_id) {
        $status = false;
		$app = Cache::rememberForever('app_' . $app_unique_id, function () use ($app_unique_id){
			return AppModel::where('app_unique_id', $app_unique_id)->first();
		});

        $promotions = [];
		$base_url = url('/');
		
		$promotionData = Cache::rememberForever('promotions_' . $app_unique_id, function (){
			return Promotion::select('*')->where('status', 1)->orderBy('id', 'DESC')->get();
		});
        foreach ($promotionData as $key => $promotion) {
            if(in_array($app->id, json_decode($promotion->apps) ?? ['n/a'])){
                $promotions[] = $promotion->makeHidden(['apps', 'created_at', 'updated_at', 'status']);
            }
        }
        $status = true;
        return response()->json(['status' => $status, 'data' => $promotions]);
    }

    public function popular_series(Request $request, $app_unique_id) {
        $status = false;
		$app = Cache::rememberForever('app_' . $app_unique_id, function () use ($app_unique_id){
			return AppModel::where('app_unique_id', $app_unique_id)->first();
		});
		
		$popularSeries = Cache::rememberForever('popular_series_' . $app_unique_id, function (){
			return PopularSeries::where('status', 1)->orderBy('id', 'DESC')->get();
		});
		$popular_series = [];
        foreach ($popularSeries as $key => $series) {
            if(in_array($app->id, json_decode($series->apps) ?? ['n/a'])){
                $popular_series[] = $series->makeHidden(['apps', 'created_at', 'updated_at', 'status']);
            }
        }
        $status = true;
        return response()->json(['status' => $status, 'data' => $popular_series]);
    }

    public function settings(Request $request, $app_unique_id, $platform = '') {
        $status = false;

        $app = Cache::rememberForever('app_' . $app_unique_id, function () use ($app_unique_id){
			return AppModel::where('app_unique_id', $app_unique_id)->first();
		});
		if($app){
			if ($platform) {
				$settings = Cache::rememberForever('settings_' . $app->id, function () use ($platform, $app){
                	return AppContent::where('platform', $platform)
								->where('app_id', $app->id)
								->pluck('value', 'name')
								->toArray();
                });
			}else{
			    $settings = Cache::rememberForever('settings_' . $app->id, function () use ($app){
                	return AppContent::where('app_id', $app->id)
								->pluck('value', 'name')
								->toArray();
                });
			}

            $settings['ip'] = get_option('server');
			$status = true;
        	return response()->json(['status' => $status, 'data' => $settings]);
		}
		abort(404);
        
    }

	
	//SportsType.php
	public function sports_type(Request $request) {
        $status = false;
		$base_url = url('/');

		$data = Cache::rememberForever('sports_types', function () use ($base_url){
			return SportsType::select('*', \DB::raw("CONCAT('$base_url/public/uploads/sports_images/', sports_skq, '.png') AS sports_image"))
								->where('status', 1)
								->get();
		});
		
		$status = true;
		return response()->json(['status' => $status, 'data' => $data]);
        
    }
	
	public function fixtures(Request $request)
	{
		
		$status = true;
		$base_url = url('/');
		$time = time();
		$data = Cache::rememberForever('fixures', function () use ($base_url, $time){
			return Fixure::join('sports_types', 'fixures.sports_type_id', 'sports_types.id')
				   ->select('fixures.series_name','fixures.team_one_name', 'fixures.team_two_name', 'timestamp', 'sports_name as type_name', \DB::raw("CASE WHEN fixures.image_one_type = 'url' THEN fixures.image_one_value WHEN fixures.image_one_type = 'image' THEN CONCAT('$base_url/', image_one_value) ELSE '$base_url/public/default/default-team.png' END AS team_one_image"), \DB::raw("CASE WHEN fixures.image_two_type = 'url' THEN fixures.image_two_value WHEN fixures.image_two_type = 'image' THEN CONCAT('$base_url/', fixures.image_two_value) ELSE '$base_url/public/default/default-team.png' END AS team_two_image"))
				   ->where('fixures.timestamp', '>', $time)
				   ->orderBy('fixures.date_time', 'ASC')
				   ->take(20)
				   ->get();
		});
		return response()->json(['status'=>$status, 'data'=>$data]);
	}
	
	public function fixures_by_type(Request $request)
	{
	    $status = true;
		$base_url = url('/');
		$time = time();
		$get_data = SportsType::where('sports_skq',$request->skq)->first();
		$data = Fixure::join('sports_types', 'fixures.sports_type_id', 'sports_types.id')->select('fixures.series_name','fixures.team_one_name', 'fixures.team_two_name', 'timestamp', 'sports_name as type_name', \DB::raw("CASE WHEN fixures.image_one_type = 'url' THEN fixures.image_one_value WHEN fixures.image_one_type = 'image' THEN CONCAT('$base_url/', image_one_value) ELSE '$base_url/public/default/default-team.png' END AS team_one_image"), \DB::raw("CASE WHEN fixures.image_two_type = 'url' THEN fixures.image_two_value WHEN fixures.image_two_type = 'image' THEN CONCAT('$base_url/', fixures.image_two_value) ELSE '$base_url/public/default/default-team.png' END AS team_two_image"))->where('fixures.timestamp', '>', $time)->where('fixures.sports_type_id',$get_data->id)->orderBy('fixures.date_time', 'ASC')->get();
		return response()->json(['status'=>$status, 'data'=>$data]);
	}
	
	public function promotion_by_type(Request $request)
	{    
		$status = true;
	    $app = AppModel::where('app_unique_id', $request->app_unique_id)->first();

        $promotions = [];
		$base_url = url('/');
        $get_data = SportsType::where('sports_skq',$request->skq)->first();
		
        foreach (Promotion::select('*', \DB::raw("CASE WHEN promotions.image_type = 'image' THEN CONCAT('$base_url/', promotions.image) ELSE '$base_url/public/default/default-team.png' END AS image"))->where('promotions.status', 1)->where('promotions.sports_type_id', '!=', NULL)->where('promotions.sports_type_id', $get_data->id)->orderBy('promotions.id', 'DESC')->get() as $key => $promotion) {
			 if(in_array($app->id, json_decode($promotion->apps))){
                $promotions[] = $promotion->makeHidden(['apps', 'created_at', 'updated_at', 'status']);
            } 
		}
		return response()->json(['status'=>$status, 'data'=>$promotions]);
	}
	
	//====================================================================//
	//------------------------v2 Api (Mamun) Start------------------------//
	//====================================================================//
	
	public function settings_v2(Request $request) {
        $status = false;

        $app = AppModel::where('app_unique_id', $request->app_unique_id)->first();
		if($app){
			$settings = AppContent::where('app_id', $app->id)
								->pluck('value', 'name')
								->toArray();
			$status = true;
        	return response()->json(['status' => $status, 'data' => $settings]);
		}
		abort(404);
        
    }
	
	public function live_matches_v2(Request $request) 
    {
		$base_url = url('/');
        $status = true;
        $live_matches = LiveMatch::select('live_matches.*', \DB::raw("CASE WHEN team_one_image_type = 'url' THEN team_one_url WHEN team_one_image_type = 'image' THEN CONCAT('$base_url/', team_one_image) ELSE '$base_url/public/default/default-team.png' END AS team_one_image"), \DB::raw("CASE WHEN team_two_image_type = 'url' THEN team_two_url WHEN team_two_image_type = 'image' THEN CONCAT('$base_url/', team_two_image) ELSE '$base_url/public/default/default-team.png' END AS team_two_image"), \DB::raw("CASE WHEN cover_image_type = 'url' THEN cover_url WHEN cover_image_type = 'image' THEN CONCAT('$base_url/', cover_image) ELSE '$base_url/public/default/default-team.png' END AS cover_image"))
                        ->join('live_match_apps', 'live_match_apps.match_id', 'live_matches.id')
                        ->join('apps', 'apps.id', 'live_match_apps.app_id')
                        ->where('apps.app_unique_id', $request->app_unique_id)
                        ->orderBy('id', 'DESC')
                        ->get()
                        ->makeHidden(['status', 'created_at', 'updated_at']);

        $data = array();
        $ip = $request->ip();
        $i = 0;

        foreach ($live_matches as $key => $value) {

            $data[$i] = $value->makeHidden(['sports_type_id', 'team_one_image_type', 'team_one_url', 'team_two_image_type', 'team_two_url']);
            
            $streaming_sources = array();
            $streamingSources = StreamingSource::where('match_id', $value->id)->get();
            foreach ($streamingSources as $key2 => $source) {

                if ($source->stream_type == 'root_stream') {
                    $source->stream_url = getGeneratedToken($source->stream_url, $source->stream_key, $ip);
					
                    $streaming_sources[] = $source->makeHidden(['block_country', 'is_block_them', 'created_at', 'updated_at']);
                }else{
					
					if($request->platform == 'android' && $source->stream_type == 'restricted'){
						$headers = array();
						$i2 = 0;
						foreach(json_decode($source->headers, true) AS $key => $value){

							if($key != 'User-Agent'){
								$headers[$i2]['name'] = $key;
								$headers[$i2]['value'] = $value;
								$i2 ++;
							}else{
								$source->$key = $value;
							}


						}
						$source->headers = $headers;
					}
					
					
                    $streaming_sources[] = $source->makeHidden(['block_country', 'is_block_them', 'created_at', 'updated_at']);
                }
            }
            $data[$i]['streaming_sources'] = $streaming_sources;

            $i++;
        }
        return response()->json(['status' => $status, 'data' => $data]);
    }
	
	public function streaming_sources_v2(Request $request) 
    {
		$base_url = url('/');
        $status = true;
        $live_match = LiveMatch::select('live_matches.*')
                        ->join('live_match_apps', 'live_match_apps.match_id', 'live_matches.id')
                        ->join('apps', 'apps.id', 'live_match_apps.app_id')
						->where('live_matches.id', $request->match_id)
                        ->where('apps.app_unique_id', $request->app_unique_id)
                        ->orderBy('id', 'DESC')
                        ->first();
		
		if(!$live_match){
			return response()->json(['status' => false, 'message' => 'No matches found.']);
		}

        $ip = $request->ip();
		
        $streaming_sources = array();
        $streamingSources = StreamingSource::where('match_id', $live_match->id)->get();
        foreach ($streamingSources as $key2 => $source) {

			if ($source->stream_type == 'root_stream') {
				$source->stream_url = getGeneratedToken($source->stream_url, $source->stream_key, $ip);
				$streaming_sources[] = $source->makeHidden(['block_country', 'is_block_them', 'created_at', 'updated_at']);
			}else{
				if($request->platform == 'android' && $source->stream_type == 'restricted'){
					$headers = array();
					$i2 = 0;
					foreach(json_decode($source->headers, true) AS $key => $value){

						if($key != 'User-Agent'){
							$headers[$i2]['name'] = $key;
							$headers[$i2]['value'] = $value;
							$i2 ++;
						}else{
							$source->$key = $value;
						}
						
						
					}
					$source->headers = $headers;
				}
				if($request->platform == 'ios' && $source->stream_type == 'restricted'){
					$source->headers = json_decode($source->headers, true);
				}
				$streaming_sources[] = $source->makeHidden(['block_country', 'is_block_them', 'created_at', 'updated_at']);
			}
        }
        return response()->json(['status' => $status, 'data' => $streaming_sources]);
    }
	
	public function live_matches_by_type_v2(Request $request)
	{
		$base_url = url('/');
        $status = true;
		
		$type = SportsType::where('sports_skq',$request->skq)->first();
			
        $live_matches = LiveMatch::select('live_matches.*', \DB::raw("CASE WHEN team_one_image_type = 'url' THEN team_one_url WHEN team_one_image_type = 'image' THEN CONCAT('$base_url/', team_one_image) ELSE '$base_url/public/default/default-team.png' END AS team_one_image"), \DB::raw("CASE WHEN team_two_image_type = 'url' THEN team_two_url WHEN team_two_image_type = 'image' THEN CONCAT('$base_url/', team_two_image) ELSE '$base_url/public/default/default-team.png' END AS team_two_image"), \DB::raw("CASE WHEN cover_image_type = 'url' THEN cover_url WHEN cover_image_type = 'image' THEN CONCAT('$base_url/', cover_image) ELSE '$base_url/public/default/default-team.png' END AS cover_image"))
                        ->join('live_match_apps', 'live_match_apps.match_id', 'live_matches.id')
                        ->join('apps', 'apps.id', 'live_match_apps.app_id')
                        ->where('apps.app_unique_id', $request->app_unique_id)
						->where('live_matches.sports_type_id', $type->id)
                        ->orderBy('id', 'DESC')
                        ->get()
                        ->makeHidden(['status', 'created_at', 'updated_at']);

        $data = array();
        $ip = $request->ip();
        $i = 0;

        foreach ($live_matches as $key => $value) {

            $data[$i] = $value->makeHidden(['sports_type_id', 'team_one_image_type', 'team_one_url', 'team_two_image_type', 'team_two_url']);
            
            $streaming_sources = array();
            $streamingSources = StreamingSource::where('match_id', $value->id)->get();
            foreach ($streamingSources as $key2 => $source) {
                if ($source->stream_type == 'root_stream') {
                    $source->stream_url = getGeneratedToken($source->stream_url, $source->stream_key, $ip);
					
                    $streaming_sources[] = $source->makeHidden(['block_country', 'is_block_them', 'created_at', 'updated_at']);
                }else{
					if($request->platform == 'android' && $source->stream_type == 'restricted'){
						$headers = array();
						$i2 = 0;
						foreach(json_decode($source->headers, true) AS $key => $value){

							if($key != 'User-Agent'){
								$headers[$i2]['name'] = $key;
								$headers[$i2]['value'] = $value;
								$i2 ++;
							}else{
								$source->$key = $value;
							}


						}
						$source->headers = $headers;
					}
					
					
                    $streaming_sources[] = $source->makeHidden(['block_country', 'is_block_them', 'created_at', 'updated_at']);
                }
            }
            $data[$i]['streaming_sources'] = $streaming_sources;

            $i++;
        }
        return response()->json(['status' => $status, 'data' => $data]);
	}
	
	//====================================================================//
	//------------------------v2 Api (Mamun) END------------------------//
	//====================================================================//


	// public function newsapi(Request $request)
    // {
    //     $status = false;
    //     $type = $request->type ?? 'football';
    //     $seconds = (60 * 60);
    //     $api_key = env('NEWS_API_KEY');
        
    //     $news = \Cache::remember("news_$type", $seconds, function () use($type, $api_key) {
            
    //         try {
    //             $client = new Client();
    //             $guzzleResponse = $client->get(
    //                 "https://newsapi.org/v2/everything?q=$type&pageSize=100&apiKey=$api_key&sortBy=publishedAt&language=en", [
    //                 "headers" => [
    //                     //'APP_KEY'=>'QAWLhIK2p5'
    //                 ],
    //             ]);
    //             if ($guzzleResponse->getStatusCode() == 200) {
    //                 return json_decode($guzzleResponse->getBody(),true)['articles'];
    //             }
                
    //         } catch (RequestException $e) {
    //             return [];
    //         } catch(Exception $e){
    //             return [];
    //         }
    //     });

        
    //     return $news;
    // }
	
	public function newsapi(Request $request)
    {
        $status = false;
        $type = $request->type ?? 'football';
        $language = $request->language ?? 'en';
        $seconds = (60 * 60);
        $api_key = env('NEWS_API_KEY');
        
        $news = \Cache::remember("news_{$type}_$language", $seconds, function () use($type, $language, $api_key) {
            
            try {
                $client = new Client();
                $guzzleResponse = $client->get(
                    "https://newsapi.org/v2/everything?q=$type&pageSize=100&apiKey=$api_key&sortBy=publishedAt&language=$language", [
                    "headers" => [
                        //'APP_KEY'=>'QAWLhIK2p5'
                    ],
                ]);
                if ($guzzleResponse->getStatusCode() == 200) {
                    return json_decode($guzzleResponse->getBody(),true)['articles'];
                }
                
            } catch (RequestException $e) {
                return [];
            } catch(Exception $e){
                return [];
            }
        });
        return $news;
    }
}
