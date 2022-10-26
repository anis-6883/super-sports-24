<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FootballApiController extends Controller {
	
	//========Match Schedules========//
    public function match_schedules(Request $request) {
      
      require_once(public_path('php/rex-tools.php'));
      $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
        )
      );
      
      $html = file_get_html('https://www.espn.in/football/fixtures/_/date/' . $request->date, false, $context);

        $json_array = array();
        $index = 1;
        $mTime = "";
        $result = "";
        $liveScore = "";
    
        $mHtml = $html->find('div[id="sched-container"]');
        $titles = array();
        foreach($mHtml as $article) {
            foreach ($article->find('.table-caption') as $key => $value) {
                $titles[$key] = $value->innertext;
            }

            $p = array();
            foreach ($article->find('.responsive-table-wrap tbody') as $key2 => $value2) {
                $m_index = (string) $index;
                
                $matches = array();
                foreach($value2->find('tr') as $key3 => $a){
    
                    $s_team1 = $a->find('abbr', 0)->innertext ?? '';
                    $f_team1 = $a->find('a span', 0)->innertext ?? '';
                    $image1 = $a->find('img', 0)->src ?? '';
                    $scr = $a->find('.record a', 0)->innertext ?? '';
                    $live = $a->find('.live a', 0)->innertext ?? '';
                    if (strtolower($live) == "live") {
                        $liveScore = $live;
                    } else {
                        $liveScore = $scr;
                    }
                    $f_team2 = $a->find('a span', 1)->innertext ?? '';
                    $s_team2 = $a->find('abbr', 1)->innertext ?? '';
                    $image2 = $a->find('img', 1)->src ?? '';
                    $result = $a->find('a', 3)->innertext ?? '';
                    $series_id21 = $a->find('a', 3)->href ?? '';
    
                    if (!empty($series_id21) || !empty($s_team1)) {
                        if ($result == "") {
                            $mTime = $a->find('td', 2)->getAttribute('data-date');
                            $mTimeStamp = strtotime($mTime);
                            $mTimes = (string) $mTimeStamp;
                        } else {
                            $mTimes = "";
                        }
                        $gameId = (int) filter_var($series_id21, FILTER_SANITIZE_NUMBER_INT);
                        $matches[] = array('s_id' => (string)$key3 + 1, 'match_id' => (string)$gameId, 'tName1' => $f_team1, 's_tName1' => $s_team1, 'image1' => $image1, 'result' => $result, 'tName2' => $f_team2, 's_tName2' => $s_team2, 'image2' => $image2, 'score' => $liveScore, 'result' => $result, 'mtime' => $mTimes);
                    }

                    $json_array[$key2]['league_id'] = (string)$key2 + 1;
                    $json_array[$key2]['title'] = $titles[$key2] ?? 'no title';
                    $json_array[$key2]['match_count'] = count($matches);
                    $json_array[$key2]['matches'] = $matches;
                }
            }
        }
    
        $response['rex-fix'] = $json_array;
        return json_encode($response);
    }
	
	public function liveAndFtMatch2(Request $request) {
      
        require_once(public_path('php/rex-tools.php'));
        
        $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
        )
        );
        $html = file_get_html('https://www.espn.in/football/fixtures', false, $context);
        $json_array = array();
        $index = 1;
        $mTime = "";
        $result = "";
        $liveScore = "";

        $mHtml = $html->find('div[id="sched-container"]');
        $titles = array();
        foreach($mHtml as $article) {
            foreach ($article->find('.table-caption') as $key => $value) {
                $titles[$key] = $value->innertext;
            }

            $p = array();
            foreach ($article->find('.responsive-table-wrap tbody') as $key2 => $value2) {
                $m_index = (string) $index;
                
                $matches = array();
                foreach($value2->find('tr') as $key3 => $a){

                    $s_team1 = $a->find('abbr', 0)->innertext ?? '';
                    $f_team1 = $a->find('a span', 0)->innertext ?? '';
                    $image1 = $a->find('img', 0)->src ?? '';
                    $scr = $a->find('.record a', 0)->innertext ?? '';
                    $live = $a->find('.live a', 0)->innertext ?? '';
                    if (strtolower($live) == "live") {
                        $liveScore = $live;
                    } else {
                        $liveScore = $scr;
                    }
                    $f_team2 = $a->find('a span', 1)->innertext ?? '';
                    $s_team2 = $a->find('abbr', 1)->innertext ?? '';
                    $image2 = $a->find('img', 1)->src ?? '';
                    $result = $a->find('a', 3)->innertext ?? '';
                    $series_id21 = $a->find('a', 3)->href ?? '';

                    if (!empty($series_id21) || !empty($s_team1)) {
                        if ($result == "") {
                            $mTime = $a->find('td', 2)->getAttribute('data-date');
                            $mTimeStamp = strtotime($mTime);
                            $mTimes = (string) $mTimeStamp;
                        } else {
                            $mTimes = "";
                        }
                        $gameId = (int) filter_var($series_id21, FILTER_SANITIZE_NUMBER_INT);
                        
                        if($result == 'LIVE'){
                        $matches[] = array('s_id' => (string)$key3 + 1, 'match_id' => (string)$gameId, 'tName1' => $f_team1, 's_tName1' => $s_team1, 'image1' => $image1, 'result' => $result, 'tName2' => $f_team2, 's_tName2' => $s_team2, 'image2' => $image2, 'score' => $liveScore, 'result' => $result, 'mtime' => $mTimes);
                        }
                    }

                    if(count($matches)){
                    $json_array['live'][$key2]['title'] = $titles[$key2] ?? 'no title';
                    $json_array['live'][$key2]['match_count'] = count($matches);
                    $json_array['live'][$key2]['matches'] = $matches;
                    }
                }
                
                $matches = array();
                foreach($value2->find('tr') as $key3 => $a){

                    $s_team1 = $a->find('abbr', 0)->innertext ?? '';
                    $f_team1 = $a->find('a span', 0)->innertext ?? '';
                    $image1 = $a->find('img', 0)->src ?? '';
                    $scr = $a->find('.record a', 0)->innertext ?? '';
                    $live = $a->find('.live a', 0)->innertext ?? '';
                    if (strtolower($live) == "live") {
                        $liveScore = $live;
                    } else {
                        $liveScore = $scr;
                    }
                    $f_team2 = $a->find('a span', 1)->innertext ?? '';
                    $s_team2 = $a->find('abbr', 1)->innertext ?? '';
                    $image2 = $a->find('img', 1)->src ?? '';
                    $result = $a->find('a', 3)->innertext ?? '';
                    $series_id21 = $a->find('a', 3)->href ?? '';

                    if (!empty($series_id21) || !empty($s_team1)) {
                        if ($result == "") {
                            $mTime = $a->find('td', 2)->getAttribute('data-date');
                            $mTimeStamp = strtotime($mTime);
                            $mTimes = (string) $mTimeStamp;
                        } else {
                            $mTimes = "";
                        }
                        $gameId = (int) filter_var($series_id21, FILTER_SANITIZE_NUMBER_INT);
                        
                        if($result == 'FT'){
                        $matches[] = array('s_id' => (string)$key3 + 1, 'match_id' => (string)$gameId, 'tName1' => $f_team1, 's_tName1' => $s_team1, 'image1' => $image1, 'result' => $result, 'tName2' => $f_team2, 's_tName2' => $s_team2, 'image2' => $image2, 'score' => $liveScore, 'result' => $result, 'mtime' => $mTimes);
                        }
                    }

                    if(count($matches)){
                    $json_array['ft'][$key2]['title'] = $titles[$key2] ?? 'no title';
                    $json_array['ft'][$key2]['match_count'] = count($matches);
                    $json_array['ft'][$key2]['matches'] = $matches;
                    }
                }
            }
        }

        $response['rex-fix'] = $json_array;
        return json_encode($response);
    }
	
	//========Live FT Match========//
	public function liveAndFtMatch(Request $request) {
		
		require_once(public_path('php/rex-tools.php'));

        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );
        // $html = file_get_html('https://www.espn.in/football/fixtures/_/date/20220822', false, $context);
        $html = file_get_html('https://www.espn.in/football/fixtures', false, $context);

		$mLiveArray = array();
		$mFTarray = array();
		$index01 = 1;
		$index02 = 1;

		$mHtml = $html->find('div[id="sched-container"]');

		foreach($mHtml as $article) {

			foreach($article->find('tbody') as $a2){

				foreach($a2->find('tr') as $a){

					//--------------------//
					//-------Team A------//
					//--------------------//

					if ($a->find('a span', 0)) {
						$t1name = $a->find('a span', 0)->innertext;
					} else {
						$t1name = "";
					}

					if ($a->find('img', 0)) {
						$t1image = $a->find('img', 0)->src;
					} else {
						$t1image = "";
					}

					//--------------------//
					//-------  Live ------//
					//--------------------//

					if ($a->find('.record')) {
						$score = $a->find('.record a', 0)->innertext;
					} else {
						$score = "";
					}

					if ($a->find('.live')) {
						$live = $a->find('.live a', 0)->innertext;
					} else {
						$live = "";
					}

					if ($a->find('td', 2)) {
						$FTscore = $this->hpt($a->find('td', 2)->innertext);
					} else {
						$FTscore = "";
					}

					if (strtolower($live) == "live") {
						$liveScore = $live;
					} else if (strtolower($FTscore) == "ft") {
						$liveScore = $FTscore;
					} else {
						$liveScore = $score;
					}


					//--------------------//
					//-------Team B-------//
					//--------------------//
					if ($a->find('a span', 1)) {
						$t2name = $a->find('a span', 1)->innertext;
					} else {
						$t2name = "";
					}

					if ($a->find('img', 1)) {
						$t2image = $a->find('img', 1)->src;
					} else {
						$t2image = "";
					}

					//--------------------//
					//--------Others------//
					//--------------------//

					if ($a->find('td a', 1)) {
						$result = $a->find('td a', 1)->innertext;
					} else {
						$result = "";
					}

					if ($a->find('a', 3)) {
						$gameIds = $a->find('a', 3)->href;
					} else {
						$gameIds = "";
					}

					$m_index01 = (string) $index01;
					$m_index02 = (string) $index02;


					if (!empty($gameIds) || !empty($t1name)) {
						$gameId = (int) filter_var($gameIds, FILTER_SANITIZE_NUMBER_INT);
						
						if ($liveScore == "LIVE") {
							$mLiveArray[] = array('id' => $m_index01, 'gameId' => (string) $gameId, 't1name' => $t1name, 't1image' => $t1image, 'score' => $result, 't2name' => $t2name, 't2image' => $t2image, 'score' => $result);
								$index01++;
						} else if ($liveScore == "FT") {
							$mFTarray[] = array('id' => $m_index02, 'gameId' => (string) $gameId, 't1name' => $t1name, 't1image' => $t1image, 'result' => $result, 't2name' => $t2name, 't2image' => $t2image, 'score' => $result);
								$index02++;
						}
					}

				}

			}

		}

		$object = array('live'=>$mLiveArray, 'ft'=>$mFTarray);
		return json_encode($object);
	
	}
  
	//========Match Preview========//
  	public function match_preview(Request $request) {
      	require_once(public_path('php/rex-tools.php'));
      
        $url = "https://www.espn.in/football/match/_/gameId/" . $request->gameId;
        $html = file_get_html($url);

        $json_array = array();
        $headerINFO = $html->find('.game-strip');
        $game_time = "";

        $game_info = array();
        $gameInfo = $html->find('.soccer-game-information');
        $vanue = "";
        $info_gtime = "";

        $teamStatsArray = array();
        $teamStats = $html->find('.team-stats');
        $countIndex = 0;

        $mostAssistsArray = array();
        $mostAssists = $html->find('.topScorer .team-stats');
        $countIndex2 = 0;

        $headToHeadArray = array();
        $headToHead = $html->find('.head-to-head');
        $imgHder = "https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/";
        $imgFdr = ".png&h=60&scale=crop&w=60";
    
        foreach($headerINFO as $a) {
            $league = $a->find('.header', 0)->innertext;
            $homeAway = $a->find('.away .long-name', 0)->innertext;
            $tHomeImg = $a->find('.away .team-info-logo img', 0)->src;
            $tHomeSnm = $a->find('.away .abbrev', 0)->innertext;

            foreach($a->find('.game-status') as $e) {
               $game_time = $e->find('span', 0)->getAttribute('data-date');
            }

            $tAway = $a->find('.home .long-name', 0)->innertext;
            $tAwayImg = $a->find('.home .team-info-logo img', 0)->src;
            $tAwaySnm = $a->find('.home .abbrev', 0)->innertext;
    
            $json_array = array("league"=>trim($league), "tAway"=>$tAway, "tAwayImg"=>$tAwayImg, "tAwaySnm"=>trim($tAwaySnm), "game_time"=>$game_time, "homeAway"=>$homeAway, "tHomeImg"=>$tHomeImg, "tHomeSnm"=>trim($tHomeSnm));
        }

        foreach($gameInfo as $gi) {
            foreach ($gi->find('.gi-group') as $value) {
                if ($value->find('.venue', 0)) {
                    $vanue = $this->hpt($value->find('.venue', 0)->innertext);
                }
                foreach($gi->find('.gi-group .subdued') as $e) {
                   $info_gtime = $e->find('span', 0)->getAttribute('data-date');
                }
                $game_info = array('vanue' => trim($vanue), 'gtime' => $info_gtime);
            }
        }

        $teamStatsArray = array();
        foreach ($html->find('#gamepackage-soccer-top-scorers .topScorer .team-stats > li') as $key => $th) {

            $players = array();
            foreach ($th->find('li') as $key2 => $pj) {
                $pJarcyNo = $pj->find('.headshot-jersey-md .player-number', 0)->innertext;
                $pName = $pj->find('.player-detail .player-name', 0)->innertext;
                $pStatus = $this->hpt($pj->find('.player-detail .player-stats', 0)->innertext);

                $players[] = array("pJarcyNo"=> $pJarcyNo, "pName"=> $pName, "pStatus"=>trim($pStatus));
            }

            $teamStatsArray[$key] = $players;
        }

        $mostAssistsArray = array();
        foreach ($html->find('#gamepackage-soccer-most-assists .topScorer .team-stats > li') as $key => $th) {

            $players = array();
            foreach ($th->find('li') as $key2 => $pj) {
                $pJarcyNo = $pj->find('.headshot-jersey-md .player-number', 0)->innertext;
                $pName = $pj->find('.player-detail .player-name', 0)->innertext;
                $pStatus = $this->hpt($pj->find('.player-detail .player-stats', 0)->innertext);

                $players[] = array("pJarcyNo"=> $pJarcyNo, "pName"=> $pName, "pStatus"=>trim($pStatus));
            }

            $mostAssistsArray[$key] = $players;
        }

        foreach($headToHead as $hth) {
            
            foreach ($hth->find('tbody tr') as $pHtoH) {

                $team1 = $pHtoH->find('td .long-name', 0)->innertext;
                $t1ImgID = $pHtoH->find('.logo a', 0)->href;
                $t1id = (int) filter_var($t1ImgID, FILTER_SANITIZE_NUMBER_INT);
                $t1Img = $imgHder.(string)$t1id.$imgFdr; 

                $team2 = $pHtoH->find('td .long-name', 1)->innertext;
                $t2ImgID = $pHtoH->find('.logo a', 1)->href;
                $t2id = (int) filter_var($t2ImgID, FILTER_SANITIZE_NUMBER_INT);
                $t2Img = $imgHder.(string)$t2id.$imgFdr; 

                $score = $pHtoH->find('td .webview-internal', 0)->innertext;
                $gameDate = $pHtoH->find('td .game-date', 0)->innertext;
                $league = $pHtoH->find('.competition span', 0)->innertext;

                $headToHeadArray[] = array("team1"=> trim($team1), "t1Img"=> $t1Img, "score"=> trim($score), "team2"=>trim($team2), "t2Img"=> $t2Img, "gameDate"=>trim($gameDate), "league"=>trim($league));

            }

        }
        
        $object = array('header' => $json_array, 'game-info' => $game_info, 'top-scorers' => $teamStatsArray, 'most-assists' => $mostAssistsArray, 'headToHead' => $headToHeadArray);
        return json_encode($object);
    }
	
	//========Live Details Header========//
	public function header(Request $request) {
		require_once(public_path('php/rex-tools.php'));
      
      	$url = "https://www.espn.in/football/matchstats?gameId=" . $request->gameId;
        $html = file_get_html($url);

        $json_array = array();
        $iconFinder = "";
        $headerINFO = $html->find('.game-strip');
    
        foreach($headerINFO as $a) {
            $league = $a->find('.header', 0)->innertext;
            $homeAway = $a->find('.away .long-name', 0)->innertext;
			$homeAwayS = $a->find('.away .abbrev', 0)->innertext;
            $teamHomeImg = $a->find('.away .team-info-logo img', 0)->src;
            $teamHomeScore = $a->find('.away .score-container .score', 0)->innertext;
            $game_time = $a->find('.game-status .game-time', 0)->innertext;
            $game_play = $a->find('.game-status .game-play', 0)->innertext;
            $teamAway = $a->find('.home .long-name', 0)->innertext;
			$teamAwayS = $a->find('.home .abbrev', 0)->innertext;
            $teamAwayImg = $a->find('.home .team-info-logo img', 0)->src;
            $teamAwayScore = $a->find('.home .score-container .score', 0)->innertext;
    
            $json_array = array("league"=>trim($league), "teamAway"=>$teamAway, "teamAwayS" =>$teamAwayS, "teamAwayImg"=>$teamAwayImg, "teamAwayScore"=>trim($teamAwayScore), "game_time"=>$game_time, "game_play"=>$game_play, "homeAway"=>$homeAway, "homeAwayS" => $homeAwayS, "teamHomeImg"=>$teamHomeImg, "teamHomeScore"=>trim($teamHomeScore));
        }
        
        $object = array('data'=>$json_array);
        return json_encode($object);
	}
  
	//========Live Details Commentary========//
  	public function commentary(Request $request) {
      	require_once(public_path('php/rex-tools.php'));
      
		$url = "https://www.espn.in/football/commentary?gameId=".$request->gameId;
        $html = file_get_html($url);

        $commentaryArray = array();
        $keyCommentaryArray = array();
        $iconFinder = "";
    
        $matchCommentary = $html->find('.match-commentary .accordion');
        $keyEventCommentary = $html->find('.match-commentary .content');
    
        foreach($matchCommentary as $msc) {
            
            foreach($msc->find('tr') as $a){
                $timeStamp = $a->find('.time-stamp', 0)->innertext;
                $gameDetails = $a->find('.game-details', 0)->innertext;
    
                if($a->find('.icon-soccer-foul-before', 0)) {
                    $iconFinder = 'foul.png';
                } else if($a->find('.icon-soccer-corner-kick-before', 0)){
                    $iconFinder = 'corner.png';
                } else if($a->find('.icon-soccer-substitution-before', 0)){
                    $iconFinder = 'substitution.png';
                } else if($a->find('.icon-soccer-shot-off-target-before', 0)){
                    $iconFinder = 'shot.png';
                } else if($a->find('.icon-soccer-offside-before', 0)){
                    $iconFinder = 'offside.png';
                } else if($a->find('.icon-soccer-goal-before', 0)){
                    $iconFinder = 'goal.png';
                } else if($a->find('.icon-soccer-halftime-before', 0)){
                    $iconFinder = 'halftime.png';
                } else if($a->find('.icon-soccer-shot-on-target-before', 0)){
                    $iconFinder = 'shot-on.png';
                } else if($a->find('.icon-soccer-yellow-card-before', 0)){
                    $iconFinder = 'yellowcard.png';
                } else {
                    $iconFinder = '';
                }
    
                $commentaryArray[] = array('timeStamp' => trim($timeStamp), 'gameDetails' => trim($this->hpt($gameDetails)), "iconFinder" => $iconFinder);
            }
    
        }

        foreach ($keyEventCommentary as $keyValue) {
            
            foreach ($keyValue->find('div[id="match-commentary-1-tab-2"] tr') as $value2s) {

                $timeStamp = $value2s->find('.time-stamp', 0)->innertext;
                $gameDetails = $value2s->find('.game-details', 0)->innertext;
    
                if($value2s->find('.icon-soccer-foul-before', 0)) {
                    $iconFinder = 'foul.png';
                } else if($value2s->find('.icon-soccer-corner-kick-before', 0)){
                    $iconFinder = 'corner.png';
                } else if($value2s->find('.icon-soccer-substitution-before', 0)){
                    $iconFinder = 'substitution.png';
                } else if($value2s->find('.icon-soccer-shot-off-target-before', 0)){
                    $iconFinder = 'shot.png';
                } else if($value2s->find('.icon-soccer-offside-before', 0)){
                    $iconFinder = 'offside.png';
                } else if($value2s->find('.icon-soccer-goal-before', 0)){
                    $iconFinder = 'goal.png';
                } else if($value2s->find('.icon-soccer-halftime-before', 0)){
                    $iconFinder = 'halftime.png';
                } else if($value2s->find('.icon-soccer-shot-on-target-before', 0)){
                    $iconFinder = 'shot-on.png';
                } else if($value2s->find('.icon-soccer-yellow-card-before', 0)){
                    $iconFinder = 'yellowcard.png';
                } else {
                    $iconFinder = '';
                }
    
                $keyCommentaryArray[] = array('timeStamp' => trim($timeStamp), 'gameDetails' => trim($this->hpt($gameDetails)), "iconFinder" => $iconFinder);

            }

        }
        
        $object = array('commentary'=>$commentaryArray, 'key_commentary'=>$keyCommentaryArray);
        return json_encode($object);
      	
    }
  
	//========Live Details LineUps========//
  	public function lineups(Request $request) {
      	require_once(public_path('php/rex-tools.php'));
     
        $url = "https://www.espn.in/football/lineups?gameId=".$request->gameId;
        $tNo = $request->teamNo;
        
        $html =  file_get_html($url);
        $mHtml = $html->find('.sub-module', $tNo);
        $mHtml1 = $html->find('.sub-module', 0);
        $mHtml2 = $html->find('.sub-module', 1);
        $t1_array = array();
        $t2_array = array();
        $t1Player_array = array();
        $t1allPly_array = array();
        $endIconFindArray =  array();
        $defultImg = "https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/default-team-logo-500.png&h=100&scale=crop&w=100";

        $iconT1Start = "";
        $yelloCrd = "";
        $redCrd = "";
        $goalFor = "";

        foreach($mHtml1->find('.content') as $article) {

            if ($article->find('.formation .formations__header .formations__image img')) {
                foreach($article->find('.formation .formations__header .formations__image img') as $element) {
                    $imgLink = $element->getAttribute('src');
                }
            } else {
                $imgLink = $defultImg;
            }
            
			if ($article->find('.formation .formations__header .formations__text')) {
				foreach($article->find('.formation .formations__header .formations__text') as $element) {
					$herTxt = $element->innertext;
				}
			} else {
                $herTxt = "";
            }

            $t1_array = array('t1Image' => $imgLink, 't1Text' => $herTxt);
        }

        foreach($mHtml2->find('.content') as $article) {

            if ($article->find('.formation .formations__header .formations__image img')) {
                foreach($article->find('.formation .formations__header .formations__image img') as $element) {
                    $imgLink = $element->getAttribute('src');
                }
            } else {
                $imgLink = $defultImg;
            }
            
            foreach($article->find('.formation .formations__header .formations__text') as $element) {
                $herTxt = $element->innertext;
            }
            $t2_array = array('t1Image' => $imgLink, 't1Text' => $herTxt);
        }


        foreach($mHtml->find('.content') as $article) {

            foreach($article->find('.formation ul .player') as $player) {
                
                $t1pName = $player->find('.player-name', 0)->innertext;
                $t1pJsNo = $player->find('text', 0)->innertext;
                $t1Player_array[] = array('t1pName' => $t1pName, 't1pJsNo' => $t1pJsNo); 

            }

            foreach($article->find('table tbody tr .accordion-header') as $stv){

                if($stv->find('.name .icon-soccer-substitution-before', 0)){
                    $iconT1Start = 'substitution.png';
                } else {
                    $iconT1Start = '';
                }

                if($stv->find('.name .icon-redcard', 0)){
                    $redCrd = 'redcard.png';
                } else {
                    $redCrd = '';
                }

                if($stv->find('.name .icon-yellowcard', 0)){
                    $yelloCrd = 'yellowcard.png';
                } else {
                    $yelloCrd = '';
                }

                if($stv->find('.name .icon-soccer-goal-before', 0)){
                    $goalFor = 'goal.png';
                } else {
                    $goalFor = '';
                }

                $pJNo = $stv->find('.name', 0)->innertext;
                $pName = $this->hpt($stv->find('.name', 1)->innertext);

                $playerName = str_replace(array("\r\n", "\r", "\n", "\t", "/\s/", "  OG"), '', $pName);
                $playerJercyNmb = str_replace(array("\r\n", "\r", "\n", "\t"," ", "/\s/", "  OG"), '', $this->hpt($pJNo));

                if (stripos($playerJercyNmb, "'") !== false) {
                    $ret = explode("'", $playerJercyNmb);
                    $playerJercyNo = $ret[1];
                } else {
                    $playerJercyNo = $playerJercyNmb;
                }

                $endIconFindArray = array('yelloCrd' => $yelloCrd, 'redCrd' => $redCrd, 'goal' => $goalFor);
                $t1allPly_array[] = array('iconT1Start' => $iconT1Start, 't1pNo' => $playerJercyNo, 't1pName' => $this->hptTwo(trim($playerName)), 'endIcon' => $endIconFindArray);
                
            }

        }

        $object = array('header1'=>$t1_array, 'header2'=>$t2_array, 'player-list'=>$t1allPly_array);
        return json_encode($object);
    }
  
	//========Live Details Statistics========//
  	public function statistics(Request $request)  {
  	    
      	require_once(public_path('php/rex-tools.php'));
      
      	$url = "https://www.espn.in/football/matchstats?gameId=" . $request->gameId;
        $html = file_get_html($url);

        $mHtml = $html->find('.data-vis');
        $mHtml2 = $html->find('.stat-list');

        $team_array = array();
        $graph_array = array();
        $matchInfo_array = array();

        foreach($mHtml as $article) {

            foreach($article->find('.away picture img') as $element) {
               $homeTmImg = $element->getAttribute('src');
            }
            $homeTname = $article->find('.away .team-name', 0)->innertext;

            foreach($article->find('.home picture img') as $element) {
               $awayTmImg = $element->getAttribute('src');
            }
            $awayTname = $article->find('.home .team-name', 0)->innertext;

            $homeChart = $article->find('.stat-graph .chartValue', 0)->innertext;
            $awayChart = $article->find('.stat-graph .chartValue', 1)->innertext;

            foreach($article->find('.shots') as $el) {
               $homeShots = $el->find('.number', 0)->innertext;
            }

            foreach($article->find('.shots') as $el) {
               $awayShots = $el->find('.number', 1)->innertext;
            }
            $graph_array = array('awayChart' => $awayChart, 'homeChart' => $homeChart, 'homeShots' => $homeShots, 'awayShots' => $awayShots);
            $team_array = array('awayTname' => $awayTname, 'awayTimg' => $awayTmImg, 'homeTname' => $homeTname, 'homeTimg' => $homeTmImg, 'graph' => $graph_array);

        }

        foreach($mHtml2 as $datas) {

            foreach($datas->find('tbody tr') as $state) {

                $home = $state->find('td', 0)->innertext;
                $problem = $state->find('td', 1)->innertext;
                $away = $state->find('td', 2)->innertext;

                $matchInfo_array[] = array('home' => $home, 'problem' => $problem, 'away' => $away);

            }

        }

        $object = array('team' => $team_array, 'info' => $matchInfo_array);
        return json_encode($object);
    }
	
	//========Standing League========//
	public function standingLeague(Request $request)  {
		
		require_once(public_path('php/rex-tools.php'));
      
      	$html =  file_get_html('https://www.espn.in/football/table/_/league/ind.1');
        $mHtml = $html->find('.mv1 .dropdown__select');
		
		$leg_array = array();
        $index = 1;

        foreach($mHtml as $article) {

          foreach($article->find('.dropdown__option') as $p){

            $link = $p->getAttribute('data-url');
            $name = $p->innertext;
            $ids = (string) $index;

            if (preg_match("/^[A-Za-z0-9-]+$/", $name)) {} else {
                $leg_array[] = array('ids' => $ids, 'name' => $this->hpt($name), 'link' => "https://www.espn.in".$link);
                $index++;
            }
          }
        }

        $object = array('league'=>$leg_array);
        return json_encode($object);
	}
	
	//========Standing Year========//
	public function standingYear(Request $request)  {
		
		require_once(public_path('php/rex-tools.php'));
      
      	$html =  file_get_html($request->url);
        $mHtml = $html->find('.mv1 .dropdown__select');
        $leg_array = array();
        $index = 1;

        foreach($mHtml as $article) {

          foreach($article->find('.dropdown__option') as $p){

            $link = $p->getAttribute('data-url');
            $name = $p->innertext;
            $ids = (string) $index;

            if (preg_match("/^[A-Za-z0-9-]+$/", $name)) {
                $leg_array[] = array('ids' => $ids, 'year' => $name, 'link' => "https://www.espn.in".$link);
                $index++;
            }

          }

        }

        $object = array('year'=>$leg_array);
        return json_encode($object);
	}
	
	//========Standing Details========//
	public function standingDetails(Request $request)  {
		
		require_once(public_path('php/rex-tools.php'));
		
		$html =  file_get_html($request->url);
		
		$mHtml = $html->find('.Table__Scroller table');
        $mHtml2 = $html->find('.flex .Table--fixed');
        $point_array = array();
        $team_array = array();

        $heding = "";
        $logo = "";
        $imageHdr = "https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/";
        $imageFdr = ".png&h=100&w=100";

        foreach($mHtml2 as $a1) {
          foreach($a1->find('tbody tr') as $a2){
            if ($a2->find('td .fw-medium', 0)) {
              $heding = $a2->find('td .fw-medium', 0)->innertext;
              $logo = "N/A";
            } else {
              $heding = $a2->find('td .team-link .hide-mobile .AnchorLink', 0)->innertext;

              $teamLogo = $a2->find('td .team-link .hide-mobile .AnchorLink', 0)->href;
              $imgId = (int) filter_var($teamLogo, FILTER_SANITIZE_NUMBER_INT); 
              $logo = $imageHdr.(string) $imgId.$imageFdr;
            }

            $team_array[] = array('heding' => $this->hpt($heding), 'logo' => $logo);
          }
        }

        foreach($mHtml as $article) {
          foreach($article->find('tbody tr') as $a2){
            $gP = $a2->find('td', 0)->innertext;
            $w = $a2->find('td', 1)->innertext;
            $d = $a2->find('td', 2)->innertext;
            $l = $a2->find('td', 3)->innertext;
            $gF = $a2->find('td', 4)->innertext;
            $gA = $a2->find('td', 5)->innertext;
            $gD = $a2->find('td', 6)->innertext;
            $p = $a2->find('td', 7)->innertext;

            $point_array[] = array('GP' => $this->hpt($gP), 'W' => $this->hpt($w), 'D' => $this->hpt($d), 'L' => $this->hpt($l), 'GF' => $this->hpt($gF), 'GA' => $this->hpt($gA), 'GD' => $this->hpt($gD), 'P' => $this->hpt($p));
          }
        }

        $object = array('team'=>$team_array, 'point'=>$point_array);
        return json_encode($object);
		
	}
	
	//======== News ========//
	public function news(Request $request)  {
		
		require_once(public_path('php/rex-tools.php'));
      
      	$html = file_get_html('https://onefootball.com/en/home');
        $mHtml = $html->find('.xpa-layout-home__section');

        $news_array = array();
        $preview = "";
        $images = "";

        foreach($mHtml as $article) {

            foreach ($article->find('.teaser__link') as $value) {

                $link = $value->href;

                foreach($value->find('.teaser__img-wrapper .of-image picture img') as $element) {
                     $rowImage = $element->getAttribute('src');
					 $rowImage1 = str_replace("w=64", "w=835", $rowImage);
					 $rowImage2 = str_replace("h=64", "h=488", $rowImage1);
					 $rowImage3 = str_replace("w=335", "w=835", $rowImage2);
					 $images = str_replace("h=188", "h=488", $rowImage3);
                }

                $title = $value->find('.teaser__title', 0)->innertext;
                if ($value->find('.teaser__preview', 0)) {
                    $preview = $value->find('.teaser__preview', 0)->innertext;
                } else {
                    $preview = "";
                }
                $time = $value->find('.publisher__time', 0)->innertext;
				
				if ($images != "/assets/images/play_icon.svg") {
					$news_array[] = array('link' => "https://onefootball.com".$link, 'title' => $title, 'preview' => $preview, 'image' => $images, 'time' => $time);
				}

            }

        }

        $object = array('news' => $news_array);
        return json_encode($object);
	}
	
	
	//========News Details========//
	public function newsDetails(Request $request)  {
		
		require_once(public_path('php/rex-tools.php'));
      
      	$html = file_get_html($request->url);
        $mHtml = $html->find('.xpa-switch-article');
        $image = "";

        $dtls_array = array();


        foreach($mHtml as $value) {

            foreach($value->find('.of-image picture img') as $key => $element) {

                $rowImage = $element->getAttribute('src') ?? '';
			    $rowImage1 = str_replace("w=64", "w=835", $rowImage);
				$rowImage2 = str_replace("h=64", "h=488", $rowImage1);
				$rowImage3 = str_replace("w=335", "w=835", $rowImage2);
				$rowImage4 = str_replace("h=188", "h=488", $rowImage3);
				$rowImage5 = str_replace("w=280", "w=835", $rowImage4);
				$rowImage6 = str_replace("w=48", "w=835", $rowImage5);
				$rowImage7 = str_replace("h=48", "w=835", $rowImage6);
				$image = str_replace("w=96", "w=835", $rowImage7);
                break;
            }

            foreach($value->find('.news-paragraph') as $dtls){

                $mamun = $dtls->innertext ?? '';
                $dtls_array[] = array('details' => $this->hpt($mamun));

            }

        }

        $object = array('image'=>$image, 'desc'=>$dtls_array);
        $response['news-dtls'] = $object;
        return json_encode($response);
	}
	
	//----------------------------------------------//
	//--------------------v2 Apis-------------------//
	//----------------------------------------------//
	public function news_v2(Request $request)  {
		
		$url = "https://www.90min.com/posts.rss";
		$rss = simplexml_load_file($url, null, LIBXML_NOCDATA); 
		$namespaces = $rss->getNamespaces(true);
		$items = [];
		foreach($rss->channel->item as $item) {
			$media_content = $item->children($namespaces['media']);
			$imageAlt = ''; 
			foreach($media_content as $i){
				$imageAlt = (string)$i->attributes()->url;
			}

			$items[] = [
				'title' =>  (string)$item->title ,
				'link' =>  (string)$item->link,
				'description' =>  (string)$item->description,
				'pubDate' => substr((string) $item->pubDate, 0, -15),
				'image' =>$imageAlt ?? '',
			];
		}

		$object = array('news' => $items);
		return json_encode($object);

	}
	//----------------------------------------------------//
	//----------------------v2 Apis END-------------------//
	//----------------------------------------------------//
	
	
	//-----------------------------------------------------------//
	//----------------------Live Streaming App-------------------//
	//-----------------------------------------------------------//
	public function bingsport_matches(Request $request)  {
		require_once(public_path('php/rex-tools.php'));
		
		$html = file_get_html('https://bingsport.com/');
		$hotMatch = $html->find('.home-container .match-container .right-container .hot-match-football-live-container');
		$hotMatchArray = array();

		$allMatch = $html->find('.home-container .match-container .right-container .total-live-sport-match-container');
		$upcomingMatchArray = array();
		$liveMatchArray = array();

		foreach($hotMatch as $hotMatchVal) {
			foreach ($hotMatchVal->find('.list-match-sport-live-stream a') as $hotVal) {
				$link = $hotVal->href ?? '';
				$league_name = $hotVal->find('.league-name span', 0)->innertext ?? '';
				$time_stamp = $hotVal->find('.box-time .time-match', 0)->{'data-timestamp'} ?? '';
				$is_live = $hotVal->find('.box-time .isLive .txt_time', 0)->innertext ?? '';
				$match_name = $hotVal->find('.col-xs-12 .body-web .txt-name', 0)->innertext ?? '';

				$t1_name = $hotVal->find('.col-xs-12 .body-web .right-team .team-name .txt-team-name', 0)->innertext ?? '';
				$t1_img = $hotVal->find('.col-xs-12 .body-web .right-team .team-name .box-image-logo img', 0)->{'data-src'} ?? '';

				$t2_name = $hotVal->find('.col-xs-12 .body-web .left-team .team-name .txt-team-name', 0)->innertext ?? '';
				$t2_img = $hotVal->find('.col-xs-12 .body-web .left-team .team-name .box-image-logo img', 0)->{'data-src'} ?? '';

				if ($hotVal->find('.box-time .isLive')) {
					$liveMatchArray[] = array('link' => $link, 'league_name' => $this->hpt($league_name), 'match_name' => $this->hpt(trim($match_name)), 'is_live' => $this->hpt($is_live), 'time_stamp' => $time_stamp, 't1_name' => $this->hpt(trim($t1_name)), 't1_img' => $t1_img, 't2_name' => $this->hpt(trim($t2_name)), 't2_img' => $t2_img);
				} else {
					$hotMatchArray[] = array('link' => $link, 'league_name' => $this->hpt($league_name), 'match_name' => $this->hpt(trim($match_name)), 'is_live' => $this->hpt($is_live), 'time_stamp' => $time_stamp, 't1_name' => $this->hpt(trim($t1_name)), 't1_img' => $t1_img, 't2_name' => $this->hpt(trim($t2_name)), 't2_img' => $t2_img);
				}
			}
		}

		foreach($allMatch as $allMatchVal) {
			foreach ($allMatchVal->find('.list-match-sport-live-stream a') as $allVal) {
				$link = $allVal->href ?? '';
				$league_name = $allVal->find('.league-name span', 0)->innertext ?? '';
				$time_stamp = $allVal->find('.box-time .time-match', 0)->{'data-timestamp'} ?? '';
				$is_live = $allVal->find('.box-time .isLive .txt_time', 0)->innertext ?? '';
				$match_name = $allVal->find('.col-xs-12 .body-web .txt-name', 0)->innertext ?? '';

				$t1_name = $allVal->find('.col-xs-12 .body-web .right-team .team-name .txt-team-name', 0)->innertext ?? '';
				$t1_img = $allVal->find('.col-xs-12 .body-web .right-team .team-name .box-image-logo img', 0)->{'data-src'} ?? '';

				$t2_name = $allVal->find('.col-xs-12 .body-web .left-team .team-name .txt-team-name', 0)->innertext ?? '';
				$t2_img = $allVal->find('.col-xs-12 .body-web .left-team .team-name .box-image-logo img', 0)->{'data-src'} ?? '';

				if ($allVal->find('.box-time .isLive')) {
					$liveMatchArray[] = array('link' => $link, 'league_name' => $this->hpt($league_name), 'match_name' => $this->hpt(trim($match_name)), 'is_live' => $this->hpt($is_live), 'time_stamp' => $time_stamp, 't1_name' => $this->hpt(trim($t1_name)), 't1_img' => $t1_img, 't2_name' => $this->hpt(trim($t2_name)), 't2_img' => $t2_img);
				} else {
					$upcomingMatchArray[] = array('link' => $link, 'league_name' => $this->hpt($league_name), 'match_name' => $this->hpt(trim($match_name)), 'is_live' => $this->hpt($is_live), 'time_stamp' => $time_stamp, 't1_name' => $this->hpt(trim($t1_name)), 't1_img' => $t1_img, 't2_name' => $this->hpt(trim($t2_name)), 't2_img' => $t2_img);
				}
			}
		}

		$response = array('LiveMatch' => $liveMatchArray, 'HotMatch' => $hotMatchArray, 'AllMatch' => $upcomingMatchArray);
		return json_encode($response);
	}
	
	public function bingsport_news(Request $request)  {
		require_once(public_path('php/rex-tools.php'));
		
		$html = file_get_html('https://bingsport.com/news?page=' . $request->page_no);
		$newsMatch = $html->find('.bingsport .main .news-container .match-container');
		$newsMatchArray = array();

		foreach($newsMatch as $newsMatchValue) {

			foreach ($newsMatchValue->find('.list-news a') as $newsVal) {

				$link = $newsVal->href ?? '';
				$title = $newsVal->find('.info-container .title', 0)->innertext ?? '';
				$description = $newsVal->find('.info-container .description', 0)->innertext ?? '';
				$image = $newsVal->find('.thumbnail-container img', 0)->{'data-src'} ?? '';

				$newsMatchArray[] = array('link' => $link, 'title' => $this->hpt($title), 'description' => $this->hpt(trim($description)), 'image' => $image);
				
			}
		}

		$object = array('News' => $newsMatchArray);
		return json_encode($object);
	}

	public function bingsport_m3u8(Request $request)  {
		require_once(public_path('php/rex-tools.php'));
		
		$html = file_get_html($request->link);
		$m3u8Match = $html->find('.bingsport .main .match-detail-container .server-share');
		$m3u8Array = array();

        foreach($m3u8Match as $m3u8Val) {

            $l1 = $m3u8Val->find('.item-server', 0)->{'data-link'} ?? '';
            $l1_01 = explode('m3u8=', $l1);
            $l1_02 = $this->hpt421($l1_01[1]);
            $l1_03 = explode('&', $l1_02);
            $link1 = $l1_03[0];
    
            $m3u8Object = array('access-control-allow-origin' => '*', 'referer' => 'https://live-streamfootball.com/'); 
            $headers = $this->a_to_s($m3u8Object);
            $m3u8Array[] = array('name' => 'Server 1', 'link' => $this->hpt4212($link1), 'header' => $headers); 
            $m3u8Array[] = array('name' => 'Server 2', 'link' => $link1, 'header' => $headers);
        }

		$object = array('M3U8' => $m3u8Array);
		return json_encode($object);
		
	}
	
	//-----------------------------------------------------------//
	//----------------------Live Streaming End-------------------//
	//-----------------------------------------------------------//
    
	public function a_to_s($array) {
       return json_encode($array);
    }
	
    function hpt421($str){
        $str = str_replace('%3A%2F%2F', '://', $str);
        $str = str_replace('%2F', '/', $str);
        return $str;
    }

    function hpt4212($str){
        $str = str_replace('playlist', 'chunks', $str);
        return $str;
    }
	
  	public function hpt($str){
        $str = str_replace('&nbsp;', ' ', $str);
        $str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
        $str = html_entity_decode($str, ENT_HTML5, 'UTF-8');
        $str = html_entity_decode($str);
        $str = htmlspecialchars_decode($str);
        $str = strip_tags($str);
        return $str;
    }
    
    public function hptTwo($str){
        $str = str_replace('&nbsp;', ' ', $str);
        $str = str_replace("'", '', $str);
        $str = str_replace('  OG', '', $str);
        $str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
        $str = html_entity_decode($str, ENT_HTML5, 'UTF-8');
        $str = html_entity_decode($str);
        $str = htmlspecialchars_decode($str);
        $str = strip_tags($str);
        return $str;
    }
    
}
