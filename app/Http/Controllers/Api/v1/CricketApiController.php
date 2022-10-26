<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\UserInfo;

class CricketApiController extends Controller {
    
    //require_once(public_path('php/rex-tools.php'));
    
	//---Live Match---
    public function liveMatch(Request $request) {
        
        require_once(public_path('php/rex-tools.php'));
        
        $html = file_get_html('https://www.cricketworld.com/cricket/live');

        $liveMatchs = $html->find('.matches-table');
        
        $score_array = array();
        $t1ScoreArray = array();
        $t2ScoreArray = array();
        $odds_array = array();

        $t1Img = "";
        $t2Img = "";

        $m1Scr = "";
        $m1Over = "";
        $m2Scr = "";
        $m2Over = "";
        
        foreach($liveMatchs as $article) {

            foreach ($article->find('.match-row') as $value) {
        
                $link2 = $value->href;
                $link = "https://www.cricketworld.com".$link2;
        
                $status = $value->find('.status', 0)->innertext;
                $seriesName = $value->find('.title', 1)->innertext;
                $match = $value->find('.subtitle', 0)->innertext;
                $series = $seriesName.', '.$match;
                $timestamp = $value->find('.time', 1)->innertext;
                $vanue = $value->find('.title', 0)->innertext;
        
               //team----A
                foreach ($value->find('.column-teams .teams .teama .teamLogo') as $teamA) {
                    $image1 = $teamA->innertext;
                }
                if ($image1 != "") {
                    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image1, $image421);
                    $t1Img = $image421['src'];
                } else {
                    $t1Img = "https://www.cricbuzz.com/a/img/v1/72x54/i1/c174284/defult.jpg";
                }
        
                $t1Name = $value->find('.teamName', 0)->innertext;
                $t1Scrs = $value->find('.teamScore', 0)->innertext;

                if(strpos($t1Scrs, "&") !== false){
                    $t1Score = substr($t1Scrs, strpos($t1Scrs, "&") + 1);
                    $m1Scr = trim(strtok($t1Score, "("));
                    $m1Over = trim(substr($t1Score, strpos($t1Score, '(')), "()");
                } else{
                     $t1Score = $t1Scrs;
                     $m1Scr = trim(strtok($t1Score, "("));
                     $m1Over = trim(substr($t1Score, strpos($t1Score, '(')), "()");
                }
        
                //team----B
                foreach ($value->find('.column-teams .teams .teamb .teamLogo') as $teamA) {
                    $image2 = $teamA->innertext;
                }
                if ($image2 != "") {
                    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image2, $image422);
                    $t2Img = $image422['src'];
                } else {
                    $t2Img = "https://www.cricbuzz.com/a/img/v1/72x54/i1/c174284/defult.jpg";
                }
        
                $t2Name = $value->find('.teamName', 1)->innertext;
                $t2Scrss = $value->find('.teamScore', 1)->innertext;
                if(strpos($t2Scrss, "&") !== false){
                    $t2Score = substr($t2Scrss, strpos($t2Scrss, "&") + 1);
                    $m2Scr = trim(strtok($t2Score, "("));
                    $m2Over = trim(substr($t2Score, strpos($t2Score, '(')), "()");
                } else{
                     $t2Score = $t2Scrss;
                     $m2Scr = trim(strtok($t2Score, "("));
                     $m2Over = trim(substr($t2Score, strpos($t2Score, '(')), "()");
                }

                $status_note = $value->find('.status_note', 1)->innertext;

                $t1ScrArray = array('t1Name' => $this->hpt($t1Name), 't1Img' => $t1Img, 'score' => $this->hpt($m1Scr), 'over' => $this->hpt($m1Over));
                $t2ScrArray = array('t2Name' => $this->hpt($t2Name), 't2Img' => $t2Img, 'score' => $this->hpt($m2Scr), 'over' => $this->hpt($m2Over));
        
                $score_array[] = array('series' => $this->hpt($series), 'match-id' => $link, 'timestamp' => $timestamp, 'status' => $this->hpt($status), 'vanue' => $this->hpt($vanue), 'note' => $this->hpt($status_note), 't1scr' => $t1ScrArray, 't2scr' => $t2ScrArray);

            }
    
        }
    
         $response = array('score'=>$score_array);
         return json_encode($response);
        
    }
    
	//---Home Top Story And Top News---
    public function homeNews(Request $request) {
        
        require_once(public_path('php/rex-tools.php'));
        
        $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
            )
        );
    
        $htmlcb = file_get_html('https://www.cricbuzz.com/', false, $context);
        $mHtmlBig = $htmlcb->find('.big-crd-main');
        $mHtmlSmal = $htmlcb->find('.sml-crd-main');
    
        $homeBig_array = array();
        $homeSml_array = array();
        $cbimage = "";
        $mLink = "";
        $index = 1;
        $baseUrl = "https://www.cricbuzz.com";
    
        foreach($mHtmlBig as $cbvalue) {
    
            $mIntro = $cbvalue->find('span', 0)->innertext ?? '';

            $links = $cbvalue->find('a', 0) ?? '';
            $link = $links->href ?? '';
            $mLink = $link;
    
            $images = $cbvalue->find('img', 0) ?? '';
            $image = $images->src ?? '';
            $cbimage=$image;
            if ($image=='') {
                  $images1 = $cbvalue->find('img', 0) ?? '';
                  $image1 = $images1->source ?? '';
                  $cbimage=$image1;
            }
    
            $title = $cbvalue->find('h2 a', 0)->innertext ?? '';
            $intr = $cbvalue->find('.cb-nws-intr', 0)->innertext ?? '';
    
            $m_index = (string) $index;
            $date = "";
            
            if (strpos($mLink, 'live-cricket-scores') !== false) {
                //-------------//
            }else {
                $homeBig_array[] = array('sl_no' => $m_index, 'mIntro' => $mIntro, 'link' => $link, 'link' => $baseUrl.$link, 'image' => $baseUrl.$cbimage, 'title' => $title, 'intr' => $intr, 'date' => $date, 'show' => "BIG");
            }
            $index++;
        
        }
    
        foreach($mHtmlSmal as $cbvalue) {
    
            $mIntro = $cbvalue->find('.crd-cntxt', 0)->innertext ?? '';
			
            $links = $cbvalue->find('a', 0) ?? '';
            $link = $links->href ?? '';
    
            $images = $cbvalue->find('img', 0) ?? '';
            $image = $images->src ?? '';
            $cbimage=$image;
            if ($image=='') {
                  $images1 = $cbvalue->find('img', 0) ?? '';
                  $image1 = $images1->source ?? '';
                  $cbimage=$image1;
            }
    
            $title = $cbvalue->find('h3 a', 0)->innertext ?? '';
            $intr = $cbvalue->find('.cb-nws-intr', 0)->innertext ?? '';
            $date = $cbvalue->find('.sml-crd-subtxt', 0)->innertext ?? '';
            $m_index = (string) $index;
            
            $homeSml_array[] = array('sl_no' => $m_index, 'mIntro' => $mIntro, 'link' => $link, 'link' => $baseUrl.$link, 'image' => $baseUrl.$cbimage, 'title' => $title, 'intr' => $intr, 'date' => $date, 'show' => "SML");
    
            $index++;
        }
    
        $object = array('topStores'=>$homeBig_array, 'more'=>$homeSml_array);
        return json_encode($object);
        
    }
	
	//---Today Match---
	public function todayMatch(Request $request){
		
		require_once(public_path('php/rex-tools.php'));
		
		$html = file_get_html('https://www.cricketworld.com/cricket/calendar');
        $liveMatchs = $html->find('.col-sm-24');
    
        $test_array = array();
        $rexImage1 = "";
        $rexImage2 = "";
    
        foreach($liveMatchs as $article) {
    
            foreach ($article->find('.match-row') as $value) {

				$link2 = $value->href;
                $link = "https://www.cricketworld.com".$link2;
				
                $statuse = $value->find('.status', 0);
                $status = $statuse->innertext;
        
                $days = $value->find('.day', 0);
                $day = $days->innertext;
        
                $vanues = $value->find('.title', 0);
                $vanue = $vanues->innertext;
        
                $subtitles = $value->find('.subtitle', 0);
                $subtitle = $subtitles->innertext;
        
                $titles = $value->find('.title', 1);
                $title = $titles->innertext;
        
                $times = $value->find('.time', 0);
                $time = $times->innertext;
        
                $localTimes = $value->find('.localTime', 0);
                $localTime = $localTimes->innertext;
        
                $startAts = $value->find('.time', 1);
                $startat = $startAts->innertext;
        
                if(($value->find('.teamLogo', 0))) {
                    $images = $value->find('.teamLogo', 0);
                    $image1 = $images->innertext;
                    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image1, $image421);
                    $testRexUrl1 = $image421['src'];
                    $rexImage1 = $testRexUrl1;
                } else{
                    $rexImage1 = "isEmpty";
                }
        
                $teamNames = $value->find('.teamName', 0);
                $teamName1 = $teamNames->innertext;
                
                if(($value->find('.teamLogo', 1))) {
                    $imagesg = $value->find('.teamLogo', 1);
                    $image2 = $imagesg->innertext;
                    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image2, $image422);
                    $testRexUrl2 = $image422['src'];
                    $rexImage2 = $testRexUrl2;
                } else{
                    $rexImage2 = "isEmpty";
                }
                
                $teamNamess = $value->find('.teamName', 1);
                $teamName2 = $teamNamess->innertext;
        
                $status_notes = $value->find('.status_note', 1);
                $status_note = $status_notes->innertext;
				
				if ($status == "Scheduled") {
                	$test_array[] = array('match-id' => $link, 'status' => $status, 'day' => $day, 'vanue' => $this->hpt($vanue), 'subtitle' => $subtitle, 'series_name' => $this->hpt($title), 'time' => $time, 'localTime' => $localTime, 'startat' => $startat, 'image1' => $rexImage1, 'teamName1' => $this->hpt($teamName1), 'image2' => $rexImage2, 'teamName2' => $this->hpt($teamName2));
				}
				
              }
        }
          
        $object = array('upcoming'=>$test_array);
        return json_encode($object);
	}
	
	//---v02 Api TEST, ODI, T20, Women - Upcoming Match---
	public function upcomin_v2Match(Request $request){
		
		require_once(public_path('php/rex-tools.php'));
		
		$dType = $request->type;
		$mLink = "";
		if ($dType == "international") {
			$mLink = "https://www.cricketworld.com/cricket/upcoming/international";
		} else if ($dType == "domestic") {
			$mLink = "https://www.cricketworld.com/cricket/upcoming/domestic";
		} else if ($dType == "t20") {
			$mLink = "https://www.cricketworld.com/cricket/upcoming/t20";
		} else if ($dType == "womens") {
			$mLink = "https://www.cricketworld.com/cricket/upcoming/womens";
		} else if ($dType == "allmatch") {
			$mLink = "https://www.cricketworld.com/cricket/upcoming";
		} 
		$html = file_get_html($mLink);
        $liveMatchs = $html->find('.col-sm-24');
    
        $test_array = array();
        $rexImage1 = "";
        $rexImage2 = "";
        //$limit = 0;
    
        foreach($liveMatchs as $article) {
    
            foreach ($article->find('.match-row') as $value) {
        
                //$limit++;
                
                //if($limit > 60) {
                //    break;
                //}
                
                $statuse = $value->find('.status', 0);
                $status = $statuse->innertext;
        
                $days = $value->find('.day', 0);
                $day = $days->innertext;
        
                $vanues = $value->find('.title', 0);
                $vanue = $vanues->innertext;
        
                $subtitles = $value->find('.subtitle', 0);
                $subtitle = $subtitles->innertext;
        
                $titles = $value->find('.title', 1);
                $title = $titles->innertext;
        
                $times = $value->find('.time', 0);
                $time = $times->innertext;
        
                $localTimes = $value->find('.localTime', 0);
                $localTime = $localTimes->innertext;
        
                $startAts = $value->find('.time', 1);
                $startat = $startAts->innertext;
        
                if(($value->find('.teamLogo', 0))) {
                    $images = $value->find('.teamLogo', 0);
                    $image1 = $images->innertext;
                    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image1, $image421);
                    $testRexUrl1 = $image421['src'];
                    $rexImage1 = $testRexUrl1;
                } else{
                    $rexImage1 = "isEmpty";
                }
        
                $teamNames = $value->find('.teamName', 0);
                $teamName1 = $teamNames->innertext;
                
                if(($value->find('.teamLogo', 1))) {
                    $imagesg = $value->find('.teamLogo', 1);
                    $image2 = $imagesg->innertext;
                    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image2, $image422);
                    $testRexUrl2 = $image422['src'];
                    $rexImage2 = $testRexUrl2;
                } else{
                    $rexImage2 = "isEmpty";
                }
                
                $teamNamess = $value->find('.teamName', 1);
                $teamName2 = $teamNamess->innertext;
        
                $status_notes = $value->find('.status_note', 1);
                $status_note = $status_notes->innertext;
        
                $test_array[] = array('status' => $status, 'day' => $day, 'vanue' => $this->hpt($vanue), 'subtitle' => $subtitle, 'series_name' => $this->hpt($title), 'time' => $time, 'localTime' => $localTime, 'startat' => $startat, 'image1' => $rexImage1, 'teamName1' => $this->hpt($teamName1), 'image2' => $rexImage2, 'teamName2' => $this->hpt($teamName2));
        
              }
        }
          
        $object = array('upcoming'=>$test_array);
        return json_encode($object);

	}
	
	//---Upcoming Match---
	public function upcomingMatch(Request $request){
		
		require_once(public_path('php/rex-tools.php'));
        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );
    
        $html = file_get_html('https://www.cricketworld.com/cricket/upcoming/', false, $context);
        $liveMatchs = $html->find('.col-sm-24');
    
        $test_array = array();
        $rexImage1 = "";
        $rexImage2 = "";
        $limit = 0;
    
        foreach($liveMatchs as $article) {
    
            foreach ($article->find('.match-row') as $value) {
                
                $status = $value->find('.status', 0)->innertext ?? '';    
                $day = $value->find('.day', 0)->innertext ?? '';
                $vanue = $value->find('.title', 0)->innertext ?? '';
                $subtitle = $value->find('.subtitle', 0)->innertext ?? '';
                $title = $value->find('.title', 1)->innertext ?? '';
                $time = $value->find('.time', 0)->innertext ?? '';
                $localTime = $value->find('.localTime', 0)->innertext ?? '';
        
                $startat = $value->find('.time', 1)->innertext ?? '';
        
                if(($value->find('.teamLogo', 0))) {
                    $image1 = $value->find('.teamLogo', 0)->innertext ?? '';
                    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image1, $image421);
                    $testRexUrl1 = $image421['src'];
                    $rexImage1 = $testRexUrl1;
                } else{
                    $rexImage1 = "https://cricket.entitysport.com/assets/plugins/cricket-engine/assets/images/team.png";
                }
        
                $teamName1 = $value->find('.teamName', 0)->innertext ?? '';
                
                if(($value->find('.teamLogo', 1))) {
                    $image2 = $value->find('.teamLogo', 1)->innertext ?? '';
                    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image2, $image422);
                    $testRexUrl2 = $image422['src'];
                    $rexImage2 = $testRexUrl2;
                } else{
                    $rexImage2 = "https://cricket.entitysport.com/assets/plugins/cricket-engine/assets/images/team.png";
                }
                
                $teamName2 = $value->find('.teamName', 1)->innertext ?? '';
                $status_notes = $value->find('.status_note', 1)->innertext ?? '';
    
                $test_array[] = array('status' => $status, 'day' => $day, 'vanue' => $this->hpt($vanue), 'subtitle' => $subtitle, 'series_name' => $this->hpt($title), 'time' => $time, 'localTime' => $localTime, 'startat' => $startat, 'image1' => $rexImage1, 'teamName1' => $this->hpt($teamName1), 'image2' => $rexImage2, 'teamName2' => $this->hpt($teamName2));
              
            }
        
        }
          
        $object = array('upcoming'=>$test_array);
        return json_encode($object);
		
		// $html = file_get_html('https://www.cricketworld.com/cricket/upcoming');
        // $liveMatchs = $html->find('.col-sm-24');
    
        // $test_array = array();
        // $rexImage1 = "";
        // $rexImage2 = "";
        // $limit = 0;
    
        // foreach($liveMatchs as $article) {
    
        //     foreach ($article->find('.match-row') as $value) {
        
        //         $limit++;
                
        //         if($limit > 60) {
        //             break;
        //         }
                
        //         $statuse = $value->find('.status', 0);
        //         $status = $statuse->innertext;
        
        //         $days = $value->find('.day', 0);
        //         $day = $days->innertext;
        
        //         $vanues = $value->find('.title', 0);
        //         $vanue = $vanues->innertext;
        
        //         $subtitles = $value->find('.subtitle', 0);
        //         $subtitle = $subtitles->innertext;
        
        //         $titles = $value->find('.title', 1);
        //         $title = $titles->innertext;
        
        //         $times = $value->find('.time', 0);
        //         $time = $times->innertext;
        
        //         $localTimes = $value->find('.localTime', 0);
        //         $localTime = $localTimes->innertext;
        
        //         $startAts = $value->find('.time', 1);
        //         $startat = $startAts->innertext;
        
        //         if(($value->find('.teamLogo', 0))) {
        //             $images = $value->find('.teamLogo', 0);
        //             $image1 = $images->innertext;
        //             preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image1, $image421);
        //             $testRexUrl1 = $image421['src'];
        //             $rexImage1 = $testRexUrl1;
        //         } else{
        //             $rexImage1 = "isEmpty";
        //         }
        
        //         $teamNames = $value->find('.teamName', 0);
        //         $teamName1 = $teamNames->innertext;
                
        //         if(($value->find('.teamLogo', 1))) {
        //             $imagesg = $value->find('.teamLogo', 1);
        //             $image2 = $imagesg->innertext;
        //             preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image2, $image422);
        //             $testRexUrl2 = $image422['src'];
        //             $rexImage2 = $testRexUrl2;
        //         } else{
        //             $rexImage2 = "isEmpty";
        //         }
                
        //         $teamNamess = $value->find('.teamName', 1);
        //         $teamName2 = $teamNamess->innertext;
        
        //         $status_notes = $value->find('.status_note', 1);
        //         $status_note = $status_notes->innertext;
        
        //         $test_array[] = array('status' => $status, 'day' => $day, 'vanue' => $this->hpt($vanue), 'subtitle' => $subtitle, 'series_name' => $this->hpt($title), 'time' => $time, 'localTime' => $localTime, 'startat' => $startat, 'image1' => $rexImage1, 'teamName1' => $this->hpt($teamName1), 'image2' => $rexImage2, 'teamName2' => $this->hpt($teamName2));
        
        //       }
        // }
          
        // $object = array('upcoming'=>$test_array);
        // return json_encode($object);
	}
	
	//---Completed Match---
	public function recentMatch(Request $request){
		
		require_once(public_path('php/rex-tools.php'));
		
		$html = file_get_html('https://www.cricketworld.com/cricket/completed');
        $liveMatchs = $html->find('.matches-table');
        
        $score_array = array();
        $t1ScoreArray = array();
        $t2ScoreArray = array();
        $odds_array = array();

        $t1Img = "";
        $t2Img = "";

        $m1Scr = "";
        $m1Over = "";
        $m2Scr = "";
        $m2Over = "";
        
        foreach($liveMatchs as $article) {
			
            foreach ($article->find('.match-row') as $value) {
        
                $link2 = $value->href;
                $link = "https://www.cricketworld.com".$link2;
        
                $status = $value->find('.status', 0)->innertext;
                $seriesName = $value->find('.title', 1)->innertext;
                $match = $value->find('.subtitle', 0)->innertext;
                $series = $seriesName.', '.$match;
                $timestamp = $value->find('.time', 1)->innertext;
                $vanue = $value->find('.title', 0)->innertext;
        
                //team----A
                foreach ($value->find('.column-teams .teams .teama .teamLogo') as $teamA) {
                    $image1 = $teamA->innertext;
                }
                if ($image1 != "") {
                    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image1, $image421);
                    $t1Img = $image421['src'];
                } else {
                    $t1Img = "https://www.cricbuzz.com/a/img/v1/72x54/i1/c174284/defult.jpg";
                }
        
                $t1Name = $value->find('.teamName', 0)->innertext;
                $t1Scrs = $value->find('.teamScore', 0)->innertext;

                if(strpos($t1Scrs, "&") !== false){
                    $t1Score = substr($t1Scrs, strpos($t1Scrs, "&") + 1);
                    $m1Scr = trim(strtok($t1Score, "("));
                    $m1Over = trim(substr($t1Score, strpos($t1Score, '(')), "()");
                } else{
                     $t1Score = $t1Scrs;
                     $m1Scr = trim(strtok($t1Score, "("));
                     $m1Over = trim(substr($t1Score, strpos($t1Score, '(')), "()");
                }
        
                //team----B
                foreach ($value->find('.column-teams .teams .teamb .teamLogo') as $teamA) {
                    $image2 = $teamA->innertext;
                }
				 if ($image2 != "") {
                    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image2, $image422);
                    $t2Img = $image422['src'];
                } else {
                    $t2Img = "https://www.cricbuzz.com/a/img/v1/72x54/i1/c174284/defult.jpg";
                }
				
                $t2Name = $value->find('.teamName', 1)->innertext;
                $t2Scrss = $value->find('.teamScore', 1)->innertext;
                if(strpos($t2Scrss, "&") !== false){
                    $t2Score = substr($t2Scrss, strpos($t2Scrss, "&") + 1);
                    $m2Scr = trim(strtok($t2Score, "("));
                    $m2Over = trim(substr($t2Score, strpos($t2Score, '(')), "()");
                } else{
                     $t2Score = $t2Scrss;
                     $m2Scr = trim(strtok($t2Score, "("));
                     $m2Over = trim(substr($t2Score, strpos($t2Score, '(')), "()");
                }

                $status_note = $value->find('.status_note', 1)->innertext;

                $t1ScrArray = array('t1Name' => $this->hpt($t1Name), 't1Img' => $t1Img, 'score' => $this->hpt($m1Scr), 'over' => $this->hpt($m1Over));
                $t2ScrArray = array('t2Name' => $this->hpt($t2Name), 't2Img' => $t2Img, 'score' => $this->hpt($m2Scr), 'over' => $this->hpt($m2Over));
        
                $score_array[] = array('series' => $this->hpt($series), 'match-id' => $link, 'timestamp' => $timestamp, 'status' => $this->hpt($status), 'vanue' => $this->hpt($vanue), 'note' => $this->hpt($status_note), 't1scr' => $t1ScrArray, 't2scr' => $t2ScrArray);

            }
    
        }
    
         $response = array('score'=>$score_array);
         return json_encode($response);
	}
	
	//---Cricket All News---
	public function allNews(Request $request){
		
		require_once(public_path('php/rex-tools.php'));
		
		$html =  file_get_html('http://www.espncricinfo.com/rss/content/story/feeds/0.xml');
        $test_array = array();
        $mHtml = $html->find('channel');
        foreach($mHtml as $article) {
            foreach ($article->find('item') as $value) {
                $titles = $value->find('title', 0) ?? '';
                $title = $titles->innertext ?? '';

                $descriptions = $value->find('description', 0) ?? '';
                $description = $descriptions->innertext ?? '';

                $coverimages = $value->find('coverimages', 0) ?? '';
                $image = $coverimages->innertext ?? '';

                $guids = $value->find('guid', 0) ?? '';
                $guid = $guids->innertext ?? '';

                $pubdates = $value->find('pubdate', 0) ?? '';
                $pubdate = $pubdates->innertext ?? '';
				
				if(strpos(strtolower($title), "covid") !== false || strpos(strtolower($description), "covid") !== false){
					//echo "Word Found!";
				} else{
					$test_array[] = array('title' => $title, 'description' => $description, 'image' => $image, 'guid' => $guid, 'pubdate' => $pubdate);
				}

                //$test_array[] = array('title' => $title, 'description' => $description, 'image' => $image, 'guid' => $guid, 'pubdate' => $pubdate);
            }
        }

        $object = array('espn_news'=>$test_array);
        return json_encode($object);
	}
	
	//---Cricket Point Table List---
	public function pointTableList(Request $request){
		
		require_once(public_path('php/rex-tools.php'));
		$context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
            )
        );

        $pointstable = file_get_html('https://m.cricbuzz.com/cricket-pointstable', false, $context);
        $pointstableArray = array();
        $index = 1;
        $ptbHtml2 = $pointstable->find('.list-group');
        foreach($ptbHtml2 as $article2) {
            foreach ($article2->find('a') as $value) {
                $link = $value->href;
                $link2 = "https://www.cricbuzz.com".$link;
                $titles = $value->find('h3', 0);
                $title = $titles->innertext;
                $pointstableArray[] = array('id' => $index, 'link' => $link2, 'title' => $title);
                $index++;
            }
        }
        $object = array('point'=>$pointstableArray);
        echo json_encode($object);
		
	}
	
	//---Ai Predictions List---
	public function aiPredictions(Request $request){
		
		require_once(public_path('php/rex-tools.php'));
		$html =  file_get_html('https://cricketprediction.com/');

        $aiJsonArray = array();
        $t1Image = "";
        $t2Image = "";
		$ai_pdt1 = "";
        $mHtml = $html->find('.tips-list .tips-list__item');
        $baseUrl = "https://cricketprediction.com";

        foreach($mHtml as $article) {

            foreach ($article->find('.card') as $value) {

                $m_date = $value->find('span', 0)->innertext;
                $m_time = $value->find('span', 1)->innertext;
                $matchType = $value->find('.bg-silver-alt .pb1', 0)->innertext;

                $t1Name = $value->find('.col-5')[0]->plaintext;
                foreach ($value->find('.col-5')[0]->find('img') as $i1img) {
                    $t1Image = "https:".$i1img->getAttribute('data-src');
                }

                $t2Name = $value->find('.col-5')[1]->plaintext;
                foreach ($value->find('.col-5')[1]->find('img') as $i2img) {
                    $t2Image = "https:".$i2img->getAttribute('data-src');
                }
				
				if($value->find('.lh15 p', 2)){
					$ai_pdt1 = $value->find('.lh15 p', 2)->innertext;
				} else {
				    $ai_pdt1 = "";
				}
                
                $prediction = '';
                foreach ($value->find('.fast-stats ul li') as $pds) {
                    $prediction .= $pds->innertext;
                }

                $readMore = $value->find('.fast-stats a', 0)->href;

                $aiJsonArray[] = array('m_date' => $m_date, 'm_time' => $m_time, 'matchType' => $matchType, 't1Name' => $this->hpt(trim($t1Name)), 't1Image' => $t1Image, 't2Name' => $this->hpt(trim($t2Name)), 't2Image' => $t2Image, 'ai_pdt1' => $this->hpt(trim($ai_pdt1)), 'prediction' => $prediction, 'readMore' => $baseUrl.$readMore);

            }
        }

        $object = array('ai-predction'=>$aiJsonArray);
        return json_encode($object);
		
	}
	
	//=================v2 Crickt Api==================//
	//---Upcoming Match---
	public function v2UpcomingMatch(Request $request){
		
		require_once(public_path('php/rex-tools.php'));
		$html = file_get_html('https://www.cricket.com/schedule/upcoming-matches');
		$mHtml = $html->find('.item-center .pr1-ns .pointer');

		$mFxArray01 = array();
		
		$today = array();
		$others = array();
		
		
		$mT1Arry = array();
		$mT2Arry = array();
		$mTimeArry = array();
		$mPredcArry = array();

		$league_link = "";
		$match_type = "";
		$league_name = "";

		foreach($mHtml as $art) {

			$league_link = $art->find('a', 0)->href ?? '';
			$match_type = $art->find('.tc', 0)->innertext ?? '';
			$league_name = $art->find('.w-80', 0)->innertext ?? '';

			foreach($art->find('.shadow-4') as $value) {

				//------Match------//
				$type = $value->find('a .w-100 .br2', 0)->innertext ?? '';
				$m_type = $value->find('a .w-100 .ml2', 0)->innertext ?? '';
				$location = $value->find('.justify-between .f7', 0)->innertext ?? '';

				//------Team1------//
				$t1Img = $value->find('a .pl1 .mb2 .pv2 img', 0)->src ?? '';
				$t1name = $value->find('a .pl1 .mb2 .pv2 span', 0)->innertext ?? '';
				$mT1Arry = array('t1Img' => $t1Img, 't1name' => trim($this->hpt($t1name)));

				//------Team2------//
				$t2Img = $value->find('a .pl1 .mb2 .pv2 img', 1)->src ?? '';
				$t2name = $value->find('a .pl1 .mb2 .pv2 span', 1)->innertext ?? '';
				$mT2Arry = array('t2Img' => $t2Img, 't2name' => trim($this->hpt($t2name)));

				//------Match Time------//
				$mDate = $value->find('a .pl1 .mb2 .w-60 span', 0)->innertext ?? '';
				$mTime = $value->find('a .pl1 .mb2 .w-60 .pv2', 0)->innertext ?? '';
				$mTossTime = $value->find('a .pl1 .bg-orange_2', 0)->innertext ?? '';
				$mTimeArry = array('mDate' => $this->hpt($mDate), 'mTime' => trim($this->hpt($mTime)), 'mTossTime' => $this->hpt($mTossTime));

				//------Wining Prediction------//
				$t1prc = $value->find('a .pl1 .items-center .mt1 .green_10', 0)->innertext ?? '';
				$t2prc = $value->find('a .pl1 .items-center .mt1 .red_10', 0)->innertext ?? '';
				$t1prcName = $value->find('a .pl1 .items-center .mt1 .grey_8', 0)->innertext ?? '';
				$t2prcName = $value->find('a .pl1 .items-center .mt1 .grey_8', 1)->innertext ?? '';
				$mPredcArry = array('t1prc' => $this->hpt($t1prc), 't1prcName' => $t1prcName, 't2prc' => $this->hpt($t2prc), 't2prcName' => $t2prcName);


				if ($type != "") {
					if($this->hpt($mDate) == 'Today')
					{
						$today[] = array('league_link' => $league_link, 'match_type' => $this->hpt($match_type), 'league_name' => $league_name, 'type' => $type, 'm_type' => $this->hpt($m_type), 'location' => trim($this->hpt($location)), 'team1' => $mT1Arry, 'team2' => $mT2Arry, 'play_time' => $mTimeArry, 'prediction' => $mPredcArry);
					}else{
						$others[] = array('league_link' => $league_link, 'match_type' => $this->hpt($match_type), 'league_name' => $league_name, 'type' => $type, 'm_type' => $this->hpt($m_type), 'location' => trim($this->hpt($location)), 'team1' => $mT1Arry, 'team2' => $mT2Arry, 'play_time' => $mTimeArry, 'prediction' => $mPredcArry);
					}
				}
			}
		}

		$object = array('fixtures'=> array_merge($today, $others));
		return json_encode($object);
		
	}
	
	public function v2LiveMatch(Request $request){
		
		require_once(public_path('php/rex-tools.php'));
		$html = file_get_html('https://www.cricket.com/schedule/live-matches');
		$mHtml = $html->find('.item-center .pr1-ns .pointer');

		$mFxArray01 = array();
		$mT1Arry = array();
		$mT2Arry = array();
		$mTimeArry = array();
		$mPredcArry = array();

		$league_link = "";
		$match_type = "";
		$league_name = "";

		foreach($mHtml as $art) {

			$league_link = 'https://www.cricket.com' . ($art->find('a', 0)->href ?? '');
			$match_type = $art->find('.tc', 0)->innertext ?? '';
			$league_name = $art->find('.w-80', 0)->innertext ?? '';

			foreach($art->find('.shadow-4') as $value) {

				//------Match------//
				$link = 'https://www.cricket.com' . ($value->find('a', 0)->href ?? '');
				$type = $value->find('a .w-100 .br2', 0)->innertext ?? '';
				$m_type = $value->find('a .w-100 .ml2', 0)->innertext ?? '';
				$location = $value->find('.justify-between .f7', 0)->innertext ?? '';
				$status = $value->find('a .items-center .f10.fw5.black.pl1', 0)->innertext ?? '';
				$status_note = $value->find('a .truncate.pv1 .br-pill.ph2.pv1.f9.fw6.tl.black-80.bg-orange_2', 0)->innertext ?? '';

				//------Team1------//
				$t1Img = $value->find('a .pl1 .pv2 img', 0)->src ?? '';
				$t1name = $value->find('a .pl1 .pv2 .ml2.f6.fw6', 0)->innertext ?? '';
				$t1Score = $value->find('a .pl1 .pv2 .tracked-tight .f6.fw6', 0)->innertext ?? '';
				$t1Over = $value->find('a .pl1 .pv2 .tracked-tight .ml2', 0)->innertext ?? '';
				$mT1Arry = array('t1Img' => $t1Img, 't1name' => trim($this->hpt($t1name)), 't1score' => trim($this->hpt($t1Score)), 't1over' => trim($this->hpt($t1Over)));

				//------Team2------//
				$t2Img = $value->find('a .pl1 .pv2 img', 1)->src ?? '';
				$t2name = $value->find('a .pl1 .pv2 .ml2.f6.fw6', 1)->innertext ?? '';
				$t2Score = $value->find('a .pl1 .pv2 .tracked-tight .f6.fw6', 1)->innertext ?? '';
				$t2Over = $value->find('a .pl1 .pv2 .tracked-tight .ml2', 1)->innertext ?? '';
				$mT2Arry = array('t2Img' => $t2Img, 't2name' => trim($this->hpt($t2name)), 't2score' => trim($this->hpt($t2Score)), 't2over' => trim($this->hpt($t2Over)));

				//------Match Time------//
				$mDate = $value->find('a .pl1 .mb2 .w-60 span', 0)->innertext ?? '';
				$mTime = $value->find('a .pl1 .mb2 .w-60 .pv2', 0)->innertext ?? '';
				$mTossTime = $value->find('a .pl1 .bg-orange_2', 0)->innertext ?? '';
				$mTimeArry = [];

				//------Wining Prediction------//
				$t1prc = '';		
				$tprc = '';	
				$t3prc = '';	
				
				$t1prcName =  '';
				$tprcName =  '';
				$t2prcName =  '';
				
				
				$prcName = $value->find('a .pl1 .items-center .mt1 .flex.flex-row.justify-between.f7', 1);
				if($prcName!= null)
				{
					$t1prcName =  $prcName->find('div', 0)->innertext ?? '';
					$tprcName = $prcName->find('div', 1)->innertext ?? '';
					$t2prcName = $prcName->find('div', 2)->innertext ?? '';
					
				}
				
				$t1prc = $value->find('a .pl1 .items-center .mt1 .flex.flex-row.justify-between.f7 div', 0)->innertext ?? '';
				$tprc = $value->find('a .pl1 .items-center .mt1 .flex.flex-row.justify-between.f7 div', 1)->innertext ?? '';
				$t2prc = $value->find('a .pl1 .items-center .mt1 .flex.flex-row.justify-between.f7 div', 2)->innertext ?? '';
				
				
				$mPredcArry = array(
					't1prc' => $this->hpt($t1prc), 
					't1prcName' => $t1prcName, 
					'tprc' => $this->hpt($tprc), 
					'tprcName' => $tprcName,
					't2prc' => $this->hpt($t2prc), 
					't2prcName' => $t2prcName,
				);


				if ($type != "") {
					$mFxArray01[] = array('league_link' => $league_link, 'match_link' => $link, 'match_type' => $this->hpt($match_type), 'league_name' => $league_name, 'type' => $type, 'm_type' => $this->hpt($m_type), 'location' => trim($this->hpt($location)), 'status' => trim($this->hpt($status)), 'status_note' => trim($this->hpt($status_note)), 'team1' => $mT1Arry, 'team2' => $mT2Arry, 'play_time' => $mTimeArry, 'prediction' => $mPredcArry);
				}
			}
		}

		$object = array('fixtures'=>$mFxArray01);
		return json_encode($object);
		
	}
	
	public function v2MatchDetails(Request $request){
		
		require_once(public_path('php/rex-tools.php'));
		$html = file_get_html($request->url);
		echo $html;
		
		$mHtml = $html->find('.bg-white.mt2.pb1');
		
		foreach($mHtml AS $atc){
		
		$table1 = $atc->find('table', 0);
		
		//batter
		$batter = [];
		
		echo $table1 . 'fffff';
		}
		
		//foreach($table1->find('tbody tr') AS $tr){
			//$batter[] = [
				//'name' => $tr->find('td', 0)->innertext ?? '',
				//'r' => $tr->find('td', 1)->innertext ?? '',
				//'b' => $tr->find('td', 2)->innertext ?? '',
				//'s4' => $tr->find('td',3)->innertext ?? '',
				//'s6' => $tr->find('td', 4)->innertext ?? '',
				//'sr' => $tr->find('td', 5)->innertext ?? '',
			//];
		//}
	

		$object = array('batter'=>$batter);
		return json_encode($object);
		
	}

    public function v6CricketFixtures(Request $request){
		
		require_once(public_path('php/rex-tools.php'));
        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );

        $html = file_get_html('https://www.cricbuzz.com/cricket-schedule/upcoming-series/all', false, $context);
        $mHtml = $html->find('body #all-list .cb-col-100');
        $timeTitle = "";
        $fixturesArray = array();
		$teamArry[2] = '';
		$baseUrl = "https://www.cricbuzz.com";

        foreach ($mHtml as $article) {
            $timeTitle = $article->find('.cb-lv-grn-strip', 0)->plaintext ?? '';
            foreach ($article->find('.cb-col-100') as $value) {
                $leagueName = $value->find('.cb-mtchs-dy', 0)->innertext ?? '';
				$mLink = $value->find('.cb-mtchs-dy-vnu a', 0)->href ?? '';
            	$mprvLink = str_replace('live-cricket-scores', 'live-cricket-scorecard', $mLink);
				
                $teamName = $value->find('.cb-mtchs-dy-vnu a', 0)->innertext ?? '';
				$teamArry = explode(",", $teamName);
				$mType = $teamArry[1];
				
				$mTeams = explode("vs", $teamArry[0]);
                $vanue = $this->hpt($value->find('.cb-mtchs-dy-vnu .text-gray', 0)->innertext ?? '');
                $timestamp = $value->find('.cb-mtchs-dy-tm span', 0)->getAttribute('timestamp') ?? '';
				$tStmVal = (string)$timestamp;
                $fixturesArray[] = array('link' => $baseUrl.$mprvLink, 'date' => $timeTitle, 'league' => '🏏 '. $leagueName, 'type' => trim($mType), 't1Name' => trim($mTeams[0]), 't2Name' => trim($mTeams[1]), 'vanue' => trim($vanue), 'timestamp' => $tStmVal);
            }        
        }
        $response = array('fixtures' => $fixturesArray);
		return json_encode($response);
	}
	//--------v6 END--------//
	
	public function v6CricketLive(Request $request){
		require_once(public_path('php/rex-tools.php'));
		$context = stream_context_create(
			array(
				"http" => array(
					"header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
				)
			)
		);

		$html = file_get_html('https://www.cricbuzz.com/', false, $context);
		$mHtml = $html->find('body .home_matches');
		$liveArray = array();
		$t1Name = '';
		$t1Score = '';
		$t2Name = '';
		$t2Score = '';
		$message = '';
		$status = '';
		$mLinks = '';
		$baseUrl = "https://www.cricbuzz.com";

		foreach ($mHtml as $article) {

			foreach ($article->find('ul li a') as $value) {

				$link = $value->href ?? '';
				$title = $value->getAttribute('title') ?? '';
				//------Team1------
				if ($value->find('.cb-hmscg-bwl-txt .cb-hmscg-tm-nm')) {
					$t1Name = '⚾ '.$value->find('.cb-hmscg-bwl-txt .cb-hmscg-tm-nm', 0)->innertext ?? '';
					$t1Score = $value->find('.cb-hmscg-bwl-txt .cb-ovr-flo', 1)->innertext ?? '';
				} else {
					if ($value->find('.cb-hmscg-bwl-txt')) {
						$t1Name = '⚾ '.$value->find('.cb-hmscg-bwl-txt', 0)->innertext ?? '';
						$t1Score = '-';
					} else {
						$t1Name = '🏏 '.$value->find('.cb-hmscg-bat-txt', 0)->innertext ?? '';
						$t1Score = '-';
					}
				}

				//------Team2------
				if ($value->find('.cb-hmscg-bat-txt .cb-hmscg-tm-nm')) {
					$t2Name = '🏏 '.$value->find('.cb-hmscg-bat-txt .cb-hmscg-tm-nm', 0)->innertext ?? '';
					$t2Score = $value->find('.cb-hmscg-bat-txt .cb-ovr-flo', 1)->innertext ?? '';
				} else {
					if ($value->find('.cb-hmscg-bwl-txt')) {
						$t2Name = '🏏 '.$value->find('.cb-hmscg-bat-txt', 0)->innertext ?? '';
						$t2Score = '-';
					} else {
						$t2Name = '🏏 '.$value->find('.cb-hmscg-bat-txt', 1)->innertext ?? '';
						$t2Score = '-';
					}
				}

				if ($value->find('.cb-text-live')) {
					$mLinks = $link;
					$status = 'LIVE';
					$message = $value->find('.cb-text-live', 0)->innertext ?? '';
				} else {
					if ($value->find('.cb-text-complete')) {
						$mLinks = $link;
						$status = 'Complete';
						$message = $value->find('.cb-text-complete', 0)->innertext ?? '';
					} else {
						if ($value->find('.cb-text-preview')) {
							$mLinks = str_replace('live-cricket-scores', 'live-cricket-scorecard', $link);
							$status = 'Preview';
							$message = $value->find('.cb-text-preview', 0)->innertext ?? '';
						} else {
							$mLinks = str_replace('live-cricket-scores', 'live-cricket-scorecard', $link);
							$status = 'Preview';
							$message = '-';
						}
					}
				}
				$liveArray[] = array('link' => $baseUrl.$mLinks, 'title' => $title, 'status' => $status, 't1Name' => $t2Name, 't1Score' => $t2Score, 't2Name' => $t1Name, 't2Score' => $t1Score, 'message' => $message);
			}       
		}
		$response = array('live' => $liveArray);
		return json_encode($response);
	}
	
	public function v6CricketPreview(Request $request){
		require_once(public_path('php/rex-tools.php'));
		$context = stream_context_create(
			array(
				"http" => array(
					"header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
				)
			)
		);
        $url = $request->url;
		$html = file_get_html($url, false, $context);
		$mHtml = $html->find('.page .cb-scrd-lft-col');
		$previewArray = array();
		$teamArray = array();
		$squad0Array = array();
		$squad1Array = array();
		$mValue = '';
		$baseUrl = "https://www.cricbuzz.com";

		foreach ($mHtml as $article) {

			foreach ($article->find('.cb-mtch-info-itm') as $values) {

				$key = $values->find('.cb-col-27', 0)->innertext ?? '';
				$value = $values->find('.cb-col-73', 0)->innertext ?? '';
				if ($key == 'Date') {
					$mValue = $values->find('.cb-col-73 span', 0)->getAttribute('timestamp') ?? '';
				} else {
					if ($key == 'Time') {
						$mValue = $values->find('.cb-col-73 span', 0)->getAttribute('timestamp') ?? '';
					} else {
						$mValue = $value;
					}
				}

				$previewArray[] = array('key' => $key, 'value' => trim($this->hpt($mValue)));
			}

			$team1 = $article->find('.cb-minfo-tm-nm', 0)->innertext ?? '';
			$team2 = $article->find('.cb-minfo-tm2-nm', 0)->innertext ?? '';
			$teamArray = array('team1' => $this->hpt($team1), 'team2' => $this->hpt($team2));

			foreach ($article->find('.cb-minfo-tm-nm') as $squadl) {

				if ($squadl->find('.cb-col-73')) {
					$squedValues = $squadl->find('.cb-col-73', 0)->innertext ?? '';
				} else {
					$squedValues = $squadl->innertext ?? '';
				}

				$squad1Array[] = array('value' => $this->hpt($squedValues));
			}

		}

		$response = array('preview' => $previewArray, 'team' => $teamArray, 'squad' => $squad1Array);
		return json_encode($response);
	}
	
	public function v6CricketComplete(Request $request){
		require_once(public_path('php/rex-tools.php'));
		$context = stream_context_create(
			array(
				"http" => array(
					"header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
				)
			)
		);

		$url = $request->url;
		$html = file_get_html($url, false, $context);
		$mHtml = $html->find('body .cb-comm-pg');
		$pomArray = array();
		$posArray = array();
		$matchArray = array();
		$pArray = array();

		foreach ($mHtml as $article) {

			foreach ($article->find('.cb-mini-scr-col .cb-min-comp') as $value) {

				$t1NameS = $value->find('.cb-col-scores .cb-scrs-wrp .cb-min-tm', 0)->innertext ?? '';
				$t2NameS = $value->find('.cb-col-scores .cb-scrs-wrp .cb-min-tm', 1)->innertext ?? '';
				$cmpStatus = $value->find('.cb-text-complete', 0)->innertext ?? '';
				$matchArray = array('t1name' => $t1NameS, 't2name' => $t2NameS, 'node' => $cmpStatus);

				$pmStchStatus = $value->find('.cb-mom-itm', 0);
				$pmValue = $pmStchStatus->find('span', 0)->innertext ?? '';
				$pmName = $pmStchStatus->find('a', 0)->innertext ?? '';
				$pomArray = array('pmvalue' => $pmValue, 'pmname' => $pmName);

				$psStchStatus = $value->find('.cb-mom-itm', 1);
				$psValue = $psStchStatus->find('span', 0)->innertext ?? '';
				$psName = $psStchStatus->find('a', 0)->innertext ?? '';
				$posArray = array('psvalue' => $psValue, 'psname' => $psName);

			}

			foreach ($article->find('.cb-com-ln') as $value0) {
				$pvalue = $value0->innertext ?? '';
				$pArray[] = array('p' => $this->hpt($pvalue));
			}

		}

		$response = array('match' => $matchArray, 'pom' => $pomArray, 'pos' => $posArray, 'commentry' => $pArray);
		return json_encode($response);
		
	}
	
	
	//---html remove---
	public function hpt($str){
        $str = str_replace('&nbsp;', '', $str);
        $str = str_replace('amp;', '', $str);
        $str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
        $str = html_entity_decode($str, ENT_HTML5, 'UTF-8');
        $str = html_entity_decode($str);
        $str = htmlspecialchars_decode($str);
        $str = strip_tags($str);
        return $str;
    }
    
	//--------------------------------------------------//
	//----------------------Rex API---------------------//
    //----99Cricket----//
	public function rexApp01(Request $request){
		
		if ($request->m_key == ""){
			$ip = $request->ip();
			$dataArray = json_decode(file_get_contents("https://ipapi.com/ip_api.php?ip=".$ip));
			$country = $dataArray->country_name;
			
			$mVal = "";
			$data_array = array();
			$data = array();
			
			if($country=="India" || $country=="Pakistan" || $country=="Bangladesh") {
				$mVal = "NO";
				$data = array();
			} else {
				$mVal = "YES";
				$data = array('title' => "99Cricket Update", 'icon' => "https://appicon.com", 'url' => "https://testapp.com/app");
			}
			$data_array = array('status' => $mVal, 'data' => $data);
			return json_encode($data_array);
			//return "NO";
			
		} else {
			return 'The server returned a "405 Method Not Allowed"';
		}
		
	}
	
	
	
}
