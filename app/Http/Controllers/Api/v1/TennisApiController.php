<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TennisApiController extends Controller {
	
	//========Match Schedules========//
    public function tennis_schedules(Request $request) {
		
		require_once(public_path('php/rex-tools.php'));
		$html = file_get_html('https://www.espn.com/tennis/schedule');
		$html23 = file_get_html('https://www.espn.com/tennis/schedule/_/type/wta');

		$mHtml = $html->find('.Card');
		$leaguesMen = [];
		$leaguesWomen = [];


		foreach($mHtml as $article) {

			foreach ($article->find('.Schedule__EventLeague') as $key => $value) {

				$title = $value->find('.Table__Title', 0)->innertext ?? '';

				$matches = [];
				foreach($value->find('.Table__TBODY tr') as $key2 => $value2) {

					if ($value2->find('td', 0)) {
						$date = $value2->find('td', 0)->innertext ?? '';
					}

					if ($value2->find('td', 1)) {
						$tournament = $value2->find('td', 1)->find('p', 0)->innertext ?? '';
						$vanue = $value2->find('td', 1)->find('.eventAndLocation__tournamentLocation', 0)->innertext ?? '';
						$tournamentLink = $value2->find('td', 1)->find('.AnchorLink', 0)->href ?? '';
					}

					if ($value2->find('td', 2)) {
						$defeChmp = $value2->find('td', 2)->find('span', 1)->innertext ?? '';
						$champLink = $value2->find('td', 2)->find('.AnchorLink', 0)->href ?? '';
					}

					$matches[] = array('date' => $date, 'tournament' => $tournament, 'tournamentLink' => $tournamentLink, 'vanue' => $this->hpt($vanue), 'defeChmp' => $this->hpt($defeChmp), 'champLink' => $champLink);

				}
				$leaguesMen[] = [
					'title' => $title,
					'matches' => $matches,
				];
			}
		}

		$mHtmlds = $html23->find('.Card');
		foreach($mHtmlds as $article) {

			foreach ($article->find('.Schedule__EventLeague') as $key => $value) {

				$title = $value->find('.Table__Title', 0)->innertext ?? '';

				$matches = [];
				foreach($value->find('.Table__TBODY tr') as $key2 => $value2) {

					if ($value2->find('td', 0)) {
						$date = $value2->find('td', 0)->innertext ?? '';
					}

					if ($value2->find('td', 1)) {
						$tournament = $value2->find('td', 1)->find('p', 0)->innertext ?? '';
						$vanue = $value2->find('td', 1)->find('.eventAndLocation__tournamentLocation', 0)->innertext ?? '';
						$tournamentLink = $value2->find('td', 1)->find('.AnchorLink', 0)->href ?? '';
					}

					if ($value2->find('td', 2)) {
						$defeChmp = $value2->find('td', 2)->find('span', 1)->innertext ?? '';
						$champLink = $value2->find('td', 2)->find('.AnchorLink', 0)->href ?? '';
					}

					$matches[] = array('date' => $date, 'tournament' => $tournament, 'tournamentLink' => $tournamentLink, 'vanue' => $this->hpt($vanue), 'defeChmp' => $this->hpt($defeChmp), 'champLink' => $champLink);

				}
				$leaguesWomen[] = [
					'title' => $title,
					'matches' => $matches,
				];
			}
		}
		
		$response = array('men_schedule' => (array)$leaguesMen, 'women_schedule' => (array)$leaguesWomen);
		echo json_encode($response);
	}
	
	//========Match Schedules========//
    public function tennis_ranking(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$html = file_get_html("https://www.espn.com/tennis/rankings");
		$html1 = file_get_html("https://www.espn.com/tennis/rankings/_/type/wta");

		$mHtml1 = $html->find('.Card .ResponsiveTable');
		$mHtml2 = $html1->find('.Card .ResponsiveTable');

		$json_array = array();

		$Rankings = array();
		$Rankings1 = array();
		$title = '';

		$Men = array();
		$MenWomen = array();


		foreach ($mHtml1 as $value) {

			foreach($value->find('.Table--align-right tbody tr  ' ) as $p) {
				$RK = $p->find('td span', 0)->plaintext ?? '';
				$NAME = $p->find('td div a', 0)->plaintext ?? '';
				$POINTS = $p->find('td span', 2)->plaintext ?? '';
				$AGE = $p->find('td span', 3)->plaintext ?? '';
				$st = $p->find('td div span img', 0)->title ?? '';
				$str= $st;
				$array = str_split($str, 3);
				$short = $array[0];
				$imgname = "https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/$short.png";

				$Rankings[] = array('RK' => $RK, 'NAME' => $NAME, 'POINTS'=>$POINTS, 'AGE'=>$AGE, 'imgname' => $imgname);
			}


		}

		foreach ($mHtml2 as $value) {

			foreach($value->find('.Table--align-right tbody tr  ' ) as $p) {
				$RK = $p->find('td span', 0)->plaintext ?? '';
				$NAME = $p->find('td div a', 0)->plaintext ?? '';
				$POINTS = $p->find('td span', 2)->plaintext ?? '';
				$AGE = $p->find('td span', 3)->plaintext ?? '';
				$st = $p->find('td div span img', 0)->title ?? '';
				$str = $st;
				$array = str_split($str, 3);
				$short = $array[0];
				$imgname = "https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/$short.png";

				$Rankings1[] = array('RK' => $RK, 'NAME' => $NAME, 'POINTS'=>$POINTS, 'AGE'=> $AGE, 'imgname' => $imgname);
			}


		}

		$object = array('men'=> $Rankings, 'women'=> $Rankings1);
		return json_encode($object);
	}
	
	//========Match Schedules========//
    public function tennis_schedule_details(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$html = file_get_html($request->url);
		$mHtml = $html->find('.span-4');
		$matches = [];

		foreach($mHtml as $article) {
			foreach($article->find('.span-2 .matchContainer') as $value) {

				$time = $value->find('.matchInfo table tr td', 0)->innertext ?? '';
				$team1 = $value->find('.matchInfo table .teamLine', 0)->innertext ?? '';
				$team2 = $value->find('.matchInfo table .teamLine2', 0)->innertext ?? '';
				$matchCourt = $value->find('.matchCourt', 0)->innertext ?? '';
				$linescore = $value->find('.linescore', 0)->innertext ?? '';
				
				$matches[] = array('time' => $time, 'team1' => $team1, 'team2' => $team2, 'matchCourt' => $matchCourt, 'linescore' => $linescore);
			}
		}	

		$response = array('schedule' => $matches);
		return json_encode($response);
	}
	
    public function hpt($str){
        $str = str_replace('&nbsp;', ' ', $str);
        $str = preg_replace('/\t/', '', $str);
        $str = preg_replace('/\%/', '', $str);
        $str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
        $str = html_entity_decode($str, ENT_HTML5, 'UTF-8');
        $str = html_entity_decode($str);
        $str = htmlspecialchars_decode($str);
        $str = strip_tags($str);
        return $str;
    }
    
}
