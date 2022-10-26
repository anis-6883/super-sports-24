<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FotbalNewApiController extends Controller {
	
	public function football_home(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$html = file_get_html('https://onefootball.com/en/home');
		$mHtml = $html->find('.home-stream .xpa-layout-home__section--gallery .teaser',);
		$topStore = array();
		$newsInfo = array();
		
		//--------Home Top Store-----------//
		foreach($mHtml as $article) {

			foreach ($article->find('.teaser__link') as $value) {
				
				$link = $value->href ?? '';
				//$image = $value->find('picture source', 0)->{'srcset'} ?? '';
				$image = $value->find('picture img', 0)->src ?? '';
				$title = $value->find('.teaser__title', 0)->innertext ?? '';
				$preview = $value->find('.teaser__preview', 0)->innertext ?? '';

				$pubName = $value->find('.publisher__name', 0)->innertext ?? '';
				$pubTime = $value->find('.publisher__time', 0)->innertext ?? '';
				$pubImg = $value->find('.publisher__image picture img', 0)->src ?? '';

				if ($title != "") {
					$newsInfo = array('pub__name' => $pubName, 'pub__time' => $pubTime, 'pubImg' => $this->newsImghpt($pubImg));
					$topStore[] = array('title' => $title, 'preview' => $preview, 'link' => $link, 'image' => $this->newsImghpt($image), 'publisher' => $newsInfo);
				}

			}

		}
		
		//------Football League--------// 
		$leagueArray = array();
		// $leagueArray[] = array(
		// 	'id' => '0', 
		// 	'name' => 'World Cup', 
		// 	'image' => 'https://a.espncdn.com/combiner/i?img=/i/leaguelogos/soccer/500/4.png',
		// 	'fixtures' => '/football/schedule/_/league/fifa.world',
		// 	'table' => '/football/table/_/league/fifa.world',
		// 	'stats' => '/football/stats/_/league/fifa.world',
		// 	'teams' => '/football/teams/_/league/FIFA.WORLD/fifa-world-cup',
		// 	'transfers' => '/football/transfers/_/league/fifa.world'
		// );
		$leagueArray[] = array(
			'id' => '1', 
			'name' => 'English Premier League', 
			'image' => 'https://a4.espncdn.com/combiner/i?img=%2Fi%2Fleaguelogos%2Fsoccer%2F500%2F23.png',
			'fixtures' => '/football/fixtures?league=eng.1',
			'table' => '/football/table/_/league/eng.1',
			'stats' => '/soccer/stats/_/league/eng.1',
			'teams' => '/football/teams/_/league/ENG.1/english-premier-league',
			'transfers' => '/football/transfers/_/league/eng.1/premier-league'
		);
		$leagueArray[] = array(
			'id' => '2', 
			'name' => 'La Liga', 
			'image' => 'https://a.espncdn.com/combiner/i?img=%2Fi%2Fleaguelogos%2Fsoccer%2F500%2F15.png',
			'fixtures' => '/football/fixtures?league=esp.1',
			'table' => '/football/table/_/league/esp.1',
			'stats' => '/soccer/stats/_/league/esp.1',
			'teams' => '/football/teams/_/league/ESP.1/spanish-laliga',
			'transfers' => '/football/transfers/_/league/esp.1/laliga'
		);
		$leagueArray[] = array(
			'id' => '3', 
			'name' => 'UEFA Champions League', 
			'image' => 'https://a3.espncdn.com/combiner/i?img=%2Fi%2Fleaguelogos%2Fsoccer%2F500%2F2.png',
			'fixtures' => '/football/fixtures?league=uefa.champions',
			'table' => '/football/table/_/league/uefa.champions',
			'stats' => '/soccer/stats/_/league/uefa.champions',
			'teams' => '/football/teams/_/league/UEFA.CHAMPIONS/uefa-champions-league',
			'transfers' => '/football/transfers/_/league/uefa.champions/uefa-champions-league'
		);
		$leagueArray[] = array(
			'id' => '4', 
			'name' => 'Bundesliga', 
			'image' => 'https://a1.espncdn.com/combiner/i?img=%2Fi%2Fleaguelogos%2Fsoccer%2F500%2F10.png',
			'fixtures' => '/football/fixtures?league=ger.1',
			'table' => '/football/table/_/league/ger.1',
			'stats' => '/soccer/stats/_/league/ger.1',
			'teams' => '/football/teams/_/league/GER.1/german-bundesliga',
			'transfers' => '/football/transfers/_/league/ger.1/bundesliga'
		);   
		$leagueArray[] = array(
			'id' => '5', 
			'name' => 'Serie A', 
			'image' => 'https://a1.espncdn.com/combiner/i?img=%252Fi%252Fleaguelogos%252Fsoccer%252F500%252F12.png',
			'fixtures' => '/football/fixtures?league=ita.1',
			'table' => '/football/table/_/league/ita.1',
			'stats' => '/soccer/stats/_/league/ita.1',
			'teams' => '/football/teams/_/league/ITA.1/italian-serie-a',
			'transfers' => '/football/transfers/_/league/ita.1/serie-a'
		);
		$leagueArray[] = array(
			'id' => '6', 
			'name' => 'Europa League', 
			'image' => 'https://a2.espncdn.com/combiner/i?img=%2Fi%2Fleaguelogos%2Fsoccer%2F500%2F2310.png',
			'fixtures' => '/football/fixtures?league=uefa.europa',
			'table' => '/football/table/_/league/uefa.europa',
			'stats' => '/soccer/stats/_/league/uefa.europa',
			'teams' => '/football/teams/_/league/UEFA.EUROPA/uefa-europa-league',
			'transfers' => '/football/transfers/_/league/uefa.europa/europa-league'
		);
		$leagueArray[] = array(
			'id' => '7', 
			'name' => 'French Ligue 1', 
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/leaguelogos/soccer/500/9.png',
			'fixtures' => '/football/schedule/_/league/fra.1',
			'table' => '/football/table/_/league/fra.1',
			'stats' => '/football/stats/_/league/fra.1',
			'teams' => '/football/teams/_/league/fra.1',
			'transfers' => '/football/transfers/_/league/fra.1'
		);
		
		//---------Football Team---------
		$teamArray = array();
		$teamArray[] = array(
			'id' => '1', 
			'name' => 'Arsenal', 
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/359.png',
			'fixtures' => '/football/team/fixtures/_/id/359/eng.arsenal',
			'squad' => '/football/team/squad/_/id/359/eng.arsenal',
			'stats' => '/football/team/stats/_/id/359',
			'transfers' => '/football/team/transfers/_/id/359/eng.arsenal'
		);
		$teamArray[] = array(
			'id' => '2', 
			'name' => 'Chelsea', 
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/363.png',
			'fixtures' => '/football/team/fixtures/_/id/363/eng.chelsea',
			'squad' => '/football/team/squad/_/id/363/eng.chelsea',
			'stats' => '/football/team/stats/_/id/363',
			'transfers' => '/football/team/transfers/_/id/363/eng.chelsea'
		);
		$teamArray[] = array(
			'id' => '3', 
			'name' => 'Liverpool', 
			'image' => 'https://a1.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/364.png',
			'fixtures' => '/football/team/fixtures/_/id/364/eng.liverpool',
			'squad' => '/football/team/squad/_/id/364/eng.liverpool',
			'stats' => '/football/team/stats/_/id/364',
			'transfers' => '/football/team/transfers/_/id/364/eng.liverpool'
		);
		$teamArray[] = array(
			'id' => '4',
			'name' => 'Manchester City',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/382.png',
			'fixtures' => '/football/team/fixtures/_/id/382/eng.man_city',
			'squad' => '/football/team/squad/_/id/382/eng.man_city',
			'stats' => '/football/team/stats/_/id/382',
			'transfers' => '/football/team/transfers/_/id/382/eng.man_city'   
		);   
		$teamArray[] = array(
			'id' => '5',
			'name' => 'Manchester United',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/360.png',
			'fixtures' => '/football/team/fixtures/_/id/360/eng.man_utd',
			'squad' => '/football/team/squad/_/id/360/eng.man_utd',
			'stats' => '/football/team/stats/_/id/360',
			'transfers' => '/football/team/transfers/_/id/360/eng.man_utd' 
		);
		$teamArray[] = array(
			'id' => '6',
			'name' => 'Barcelona',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/83.png',
			'fixtures' => '/football/team/fixtures/_/id/83/esp.barcelona',
			'squad' => '/football/team/squad/_/id/83/esp.barcelona',
			'stats' => '/football/team/stats/_/id/83',
			'transfers' => '/football/team/transfers/_/id/83/esp.barcelona'
		);
		$teamArray[] = array(
			'id' => '7',
			'name' => 'Real Madrid',
			'image' => 'https://a1.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/86.png',
			'fixtures' => '/football/team/fixtures/_/id/86/esp.real_madrid',
			'squad' => '/football/team/squad/_/id/86/esp.real_madrid',
			'stats' => '/football/team/stats/_/id/86',
			'transfers' => '/football/team/transfers/_/id/86/esp.real_madrid'
		);
		$teamArray[] = array(
			'id' => '8',
			'name' => 'Atletico Madrid',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/1068.png',
			'fixtures' => '/football/team/fixtures/_/id/1068/esp.atletico_madrid',
			'squad' => '/football/team/squad/_/id/1068/esp.atletico_madrid',
			'stats' => '/football/team/stats/_/id/1068',
			'transfers' => '/football/team/transfers/_/id/1068/esp.atletico_madrid'
		);
		$teamArray[] = array(
			'id' => '9',
			'name' => 'Bayern Munich',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/132.png',
			'fixtures' => '/football/team/fixtures/_/id/132/ger.bayern_munich',
			'squad' => '/football/team/squad/_/id/132/ger.bayern_munich',
			'stats' => '/football/team/stats/_/id/132',
			'transfers' => '/football/team/transfers/_/id/132/ger.bayern_munich'
		);
		$teamArray[] = array(
			'id' => '10',
			'name' => 'Juventus',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/111.png',
			'fixtures' => '/football/team/fixtures/_/id/111/ita.juventus',
			'squad' => '/football/team/squad/_/id/111/ita.juventus',
			'stats' => '/football/team/stats/_/id/111',
			'transfers' => '/football/team/transfers/_/id/111/ita.juventus'
		);
		$teamArray[] = array(
			'id' => '11',
			'name' => 'Borussia Dortmund',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/124.png',
			'fixtures' => '/football/team/fixtures/_/id/124/ger.dortmund',
			'squad' => '/football/team/squad/_/id/124/ger.dortmund',
			'stats' => '/football/team/stats/_/id/124',
			'transfers' => '/football/team/transfers/_/id/124/ger.dortmund'
		);
		$teamArray[] = array(
			'id' => '12',
			'name' => 'Leicester City',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/375.png',
			'fixtures' => '/football/team/fixtures/_/id/375/eng.leicester',
			'squad' => '/football/team/squad/_/id/375/eng.leicester',
			'stats' => '/football/team/stats/_/id/375',
			'transfers' => '/football/team/transfers/_/id/375/eng.leicester'
		);
		$teamArray[] = array(
			'id' => '13',
			'name' => 'PSG',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/160.png',
			'fixtures' => '/football/team/fixtures/_/id/160/fra.psg',
			'squad' => '/football/team/squad/_/id/160/fra.psg',
			'stats' => '/football/team/stats/_/id/160',
			'transfers' => '/football/team/transfers/_/id/160/fra.psg'
		);
		$teamArray[] = array(
			'id' => '14',
			'name' => 'Marseille',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/176.png',
			'fixtures' => '/football/team/fixtures/_/id/176/fra.marseille',
			'squad' => '/football/team/squad/_/id/176/fra.marseille',
			'stats' => '/football/team/stats/_/id/176',
			'transfers' => '/football/team/transfers/_/id/176/fra.marseille'
		);
		$teamArray[] = array(
			'id' => '15',
			'name' => 'Lyon',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/167.png',
			'fixtures' => '/football/team/fixtures/_/id/167/fra.lyon',
			'squad' => '/football/team/squad/_/id/167/fra.lyon',
			'stats' => '/football/team/stats/_/id/167',
			'transfers' => '/football/team/transfers/_/id/167/fra.lyon'
		);
		$teamArray[] = array(
			'id' => '16',
			'name' => 'Monaco',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/174.png',
			'fixtures' => '/football/team/fixtures/_/id/174/fra.monaco',
			'squad' => '/football/team/squad/_/id/174/fra.monaco',
			'stats' => '/football/team/stats/_/id/174',
			'transfers' => '/football/team/transfers/_/id/174/fra.monaco'
		);
		$teamArray[] = array(
			'id' => '17',
			'name' => 'Lille',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/166.png&scale=crop',
			'fixtures' => '/football/team/fixtures/_/id/166/fra.lille',
			'squad' => '/football/team/squad/_/id/166/fra.lille',
			'stats' => '/football/team/stats/_/id/166',
			'transfers' => '/football/team/transfers/_/id/166/fra.lille'
		);
		
		//---------Show League, Team and TopStore----------//
		$response = array('league' => $leagueArray, 'team' => $teamArray, 'topstore' => $topStore);
		return json_encode($response);
	}
	
	//------Football Home Details News--------// 
	public function fbal_home_dtls_news(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$html = file_get_html('https://onefootball.com'.$request->url);
		$mHtml = $html->find('.news-stream .of-grid .xpa-layout__grid-item', 0);
		$newsDetils = array();
		$newsHeader = array();
		$index = 1;
		$image = '';

		foreach($mHtml->find('.xpa-layout__grid-item-components .xpa-layout-container__switch .xpa-switch-article') as $article) {

			foreach ($article->find('.of-image__picture') as $key => $value) {

				if ($index == 2) {

					$image = $value->find('source', 0)->{'srcset'} ?? '';
					$newsHeader = array('image' => $this->newsImghpt($image));

				}

				$index++;
			}

			foreach ($article->find('.news-paragraph') as $value) {
				$dtlsNews = $value->innertext ?? '';
				$newsDetils[] = array('p' => $this->hpt($dtlsNews));
			}

		}

		$response = array('header' => $newsHeader, 'body' => $newsDetils);
		return json_encode($response);
	}
	
	//------Football Team Fixtures--------// 
	public function fbal_team_fixtures(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$mFixturesHtml = file_get_html('https://www.espn.in'.$request->url);
		
		$mHtml = $mFixturesHtml->find('div[id="fittPageContainer"] .Card .Table__fixtures');
		$json_array = array();
		$imgUrl = 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/';
		foreach($mHtml as $article) {
			foreach($article->find('.Table__TBODY tr') as $a){

				if ($a->find('.matchTeams', 0)) {
					$matchTime = $a->find('.matchTeams', 0)->innertext ?? '';
					$date = \DateTime::createFromFormat('D, d M', $matchTime);
					$matTime = $date->format('Y-m-d');
				}

				//----Team 1 Info----
				$team1 = $a->find('.local a', 0)->innertext ?? '';
				$img1Id = preg_replace('/[^0-9]/', '', $a->find('.local a', 0)->href ?? '');
				$image1 = $imgUrl.$img1Id.'.png';


				//----Team 2 Info----
				$team2 = $a->find('.away a', 0)->innertext ?? '';
				$img2Id = preg_replace('/[^0-9]/', '', $a->find('.away a', 0)->href ?? '');
				$image2 = $imgUrl.$img2Id.'.png';

				$leagueName = $a->find('span', 1)->innertext ?? '';

				if ($a->find('td', 4)) {
					$mTime = $a->find('td', 4)->find('a', 0)->innertext ?? '';
					$times = date ('H:i:s',strtotime($mTime));
					//$timestamp = ($matTime.' '.$times);
					$timestamp = strtotime($matTime. '' .$times);
				}

				$json_array[] = array('team1' => $team1, 'image1' => $image1, 'mTime' => $timestamp, 'team2' => $team2, 'image2' => $image2, 'match_date' => $matchTime, 'league' => $leagueName);
			}
		}
		$response = array('team_fix' => $json_array);
		return json_encode($response);
	}
	
	//------Football Team Squad--------// 
	public function fbal_team_squad(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$mSquadHtml = file_get_html('https://www.espn.in'.$request->url);
		$mSqdHtml = $mSquadHtml->find('.goalkeepers .Table__TBODY');
		$goalkeepers_array = array();

		$mOutfieldHtml = $mSquadHtml->find('.outfield .Table__TBODY');
		$outfield_array = array();

		foreach($mSqdHtml as $squadArtl) {

			foreach ($squadArtl->find('.Table__TR') as $value) {

				if ($value->find('td', 0)) {
					$name = $value->find('td', 0)->find('a', 0)->innertext ?? '';
					$jrNo = $value->find('td', 0)->find('.inline', 0)->innertext ?? '';
					$jercy = preg_replace('/[^0-9]/', '', $this->hpt($jrNo));
				}
				if ($value->find('td', 1)) {
					$pos = $value->find('td', 1)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 2)) {
					$age = $value->find('td', 2)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 3)) {
					$ht = $value->find('td', 3)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 4)) {
					$wt = $value->find('td', 4)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 5)) {
					$nat = $value->find('td', 5)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 6)) {
					$app = $value->find('td', 6)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 7)) {
					$sub = $value->find('td', 7)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 8)) {
					$sv = $value->find('td', 8)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 9)) {
					$ga = $value->find('td', 9)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 10)) {
					$a = $value->find('td', 10)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 11)) {
					$fc = $value->find('td', 11)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 12)) {
					$fa = $value->find('td', 12)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 13)) {
					$yc = $value->find('td', 13)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 14)) {
					$rc = $value->find('td', 14)->find('.inline', 0)->innertext ?? '';
				}

				$goalkeepers_array[] = array('name' => $this->hpt($name), 'jercy' => $jercy, 'pos' => $pos, 'age' => $age, 'ht' => $ht, 'wt' => $wt, 'nat' => $nat, 'app' => $app, 'sub' => $sub, 'sv' => $sv, 'ga' => $ga, 'a' => $a, 'fc' => $fc, 'fa' => $fa, 'yc' => $yc, 'rc' => $rc);
			}
		}

		foreach($mOutfieldHtml as $squadArtlOut) {
			foreach ($squadArtlOut->find('.Table__TR') as $value) {
				if ($value->find('td', 0)) {
					$name = $value->find('td', 0)->find('a', 0)->innertext ?? '';
					$jsVals = $value->find('td', 0)->find('.inline', 0)->innertext ?? '';
					$jercy = preg_replace('/[^0-9]/', '', $this->hpt($jsVals));
				}
				if ($value->find('td', 1)) {
					$pos = $value->find('td', 1)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 2)) {
					$age = $value->find('td', 2)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 3)) {
					$ht = $value->find('td', 3)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 4)) {
					$wt = $value->find('td', 4)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 5)) {
					$nat = $value->find('td', 5)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 6)) {
					$app = $value->find('td', 6)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 7)) {
					$sub = $value->find('td', 7)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 8)) {
					$g = $value->find('td', 8)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 9)) {
					$a = $value->find('td', 9)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 10)) {
					$sh = $value->find('td', 10)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 11)) {
					$st = $value->find('td', 11)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 12)) {
					$fc = $value->find('td', 12)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 13)) {
					$fa = $value->find('td', 13)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 14)) {
					$yc = $value->find('td', 14)->find('.inline', 0)->innertext ?? '';
				}
				if ($value->find('td', 15)) {
					$rc = $value->find('td', 15)->find('.inline', 0)->innertext ?? '';
				}
				$outfield_array[] = array('name' => $this->hpt($name), 'jercy' => $jercy, 'pos' => $pos, 'age' => $age, 'ht' => $ht, 'wt' => $wt, 'nat' => $nat, 'app' => $app, 'sub' => $sub, 'g' => $g, 'a' => $a, 'sh' => $sh, 'st' => $st, 'fc' => $fc, 'fa' => $fa, 'yc' => $yc, 'rc' => $rc);
			}
		}
		$response['squad'] = array('goalkeepers' => $goalkeepers_array, 'outfield' => $outfield_array);
		return json_encode($response);
	}
	
	//------Football Team Stats--------// 
	public function fbal_team_stats(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$mStatsHtml = file_get_html('https://www.espn.in'.$request->url);
		$mSqdHtml = $mStatsHtml->find('.mt6 .Table__Scroller', 0);
		$topScorers_array = array();
		$mTopAssistsHtml = $mStatsHtml->find('.mt6 .Table__Scroller', 1);
		$topAssists_array = array();
		foreach($mSqdHtml->find('.Table__TBODY') as $statsArtl) {
			foreach ($statsArtl->find('tr') as $value) {
				if ($value->find('td', 0)) {
					$rk = $value->find('td', 0)->innertext ?? '';
				}
				if ($value->find('td', 1)) {
					$name = $value->find('td', 1)->find('a', 0)->innertext ?? '';
				}
				if ($value->find('td', 2)) {
					$p = $value->find('td', 2)->find('span', 0)->innertext ?? '';
				}
				if ($value->find('td', 3)) {
					$g = $value->find('td', 3)->find('span', 0)->innertext ?? '';
				}
				$topScorers_array[] = array('rk' => $rk, 'name' => $name, 'p' => $p, 'g' => $g);
			}
		}

		foreach($mTopAssistsHtml->find('.Table__TBODY') as $statsArtlu1) {
			foreach ($statsArtlu1->find('tr') as $value) {
				if ($value->find('td', 0)) {
					$rk = $value->find('td', 0)->innertext ?? '';
				}
				if ($value->find('td', 1)) {
					$name = $value->find('td', 1)->find('a', 0)->innertext ?? '';
				}
				if ($value->find('td', 2)) {
					$p = $value->find('td', 2)->find('span', 0)->innertext ?? '';
				}
				if ($value->find('td', 3)) {
					$a = $value->find('td', 3)->find('span', 0)->innertext ?? '';
				}
				$topAssists_array[] = array('rk' => $rk, 'name' => $name, 'p' => $p, 'a' => $a);
			}
		}
		$response['stats'] = array('top_scorers' => $topScorers_array, 'top_assists' => $topAssists_array);
		return json_encode($response);
	}
	
	//------Football Team Stats--------// 
	public function fbal_team_transfers(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$mPlayersInHtml = file_get_html('https://www.espn.in'.$request->url);
		$mPlayInHtml = $mPlayersInHtml->find('.pt6 .ResponsiveTable', 0);
		$playersIn_array = array();
		$imageUrl = 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/';

		$mPlayInHtml02 = $mPlayersInHtml->find('.pt6 .ResponsiveTable', 1);
		$PlayersOut_array = array();

		foreach($mPlayInHtml->find('.Table__TBODY') as $playArtl) {

			foreach ($playArtl->find('tr') as $value) {

				if ($value->find('td', 0)) {
					$date = $value->find('span', 0)->innertext ?? '';
				}
				if ($value->find('td', 1)) {
					$name = $value->find('td', 1)->find('a', 0)->innertext ?? '';
				}
				if ($value->find('td', 2)) {
					$from = $value->find('td', 2)->find('a span', 0)->innertext ?? '';
					$imgIds = $value->find('td', 2)->find('a', 0)->href ?? '';
					$imgId = preg_replace('/[^0-9]/', '', $imgIds);
					$image = $imageUrl.$imgId.'.png&scale=crop&cquality=40&location=origin&w=80&h=80';
				}
				if ($value->find('td', 3)) {
					$fee = $value->find('td', 3)->find('span', 0)->innertext ?? '';
				}

				$playersIn_array[] = array('date' => $date, 'name' => $name, 'imgId' => $image, 'from' => $from, 'fee' => $fee);

			}

		}

		foreach($mPlayInHtml02->find('.Table__TBODY') as $playArtl) {

			foreach ($playArtl->find('tr') as $value) {

				if ($value->find('td', 0)) {
					$date = $value->find('span', 0)->innertext ?? '';
				}
				if ($value->find('td', 1)) {
					$name = $value->find('td', 1)->find('a', 0)->innertext ?? '';
				}
				if ($value->find('td', 2)) {
					$from = $value->find('td', 2)->find('a span', 0)->innertext ?? '';
					$imgIds = $value->find('td', 2)->find('a', 0)->href ?? '';
					$imgId = preg_replace('/[^0-9]/', '', $imgIds);
					$image = $imageUrl.$imgId.'.png&scale=crop&cquality=40&location=origin&w=80&h=80';
				}
				if ($value->find('td', 3)) {
					$fee = $value->find('td', 3)->find('span', 0)->innertext ?? '';
				}

				$PlayersOut_array[] = array('date' => $date, 'name' => $name, 'imgId' => $image, 'from' => $from, 'fee' => $fee);
			}
		}
		$response['transfers'] = array('players_in' => $playersIn_array, 'players_out' => $PlayersOut_array);
		return json_encode($response);
	}
	
	//------Football League Fixtures--------// 
	public function fbal_league_fixtures(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$html = file_get_html('https://www.espn.in'.$request->url);

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

		$response['league_fixtures'] = $json_array;
		return json_encode($response);
	}
	
	//------Football League Table--------// 
	public function fbal_league_table(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$html =  file_get_html('https://www.espn.in'.$request->url);
		
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
	
	//------Football League Stats--------// 
	public function fbal_league_stats(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$mStatsHtml = file_get_html('https://www.espn.in'.$request->url);
		$mSqdHtml = $mStatsHtml->find('.mt6 .Table__Scroller', 0);
		$topScorers_array = array();
		$mTopAssistsHtml = $mStatsHtml->find('.mt6 .Table__Scroller', 1);
		$topAssists_array = array();
		foreach($mSqdHtml->find('.Table__TBODY') as $statsArtl) {
			foreach ($statsArtl->find('tr') as $value) {
				if ($value->find('td', 0)) {
					$rk = $value->find('td', 0)->innertext ?? '';
				}
				if ($value->find('td', 1)) {
					$name = $value->find('td', 1)->find('a', 0)->innertext ?? '';
				}
				if ($value->find('td', 2)) {
					$team = $value->find('td', 2)->find('a', 0)->innertext ?? '';
				}
				if ($value->find('td', 3)) {
					$p = $value->find('td', 3)->find('span', 0)->innertext ?? '';
				}
				if ($value->find('td', 4)) {
					$g = $value->find('td', 4)->find('span', 0)->innertext ?? '';
				}
				$topScorers_array[] = array('rk' => $rk, 'name' => $name, 'team' => $team, 'p' => $p, 'g' => $g);
			}
		}

		foreach($mTopAssistsHtml->find('.Table__TBODY') as $statsArtlu1) {
			foreach ($statsArtlu1->find('tr') as $value) {
				if ($value->find('td', 0)) {
					$rk = $value->find('td', 0)->innertext ?? '';
				}
				if ($value->find('td', 1)) {
					$name = $value->find('td', 1)->find('a', 0)->innertext ?? '';
				}
				if ($value->find('td', 2)) {
					$team = $value->find('td', 2)->find('a', 0)->innertext ?? '';
				}
				if ($value->find('td', 3)) {
					$p = $value->find('td', 3)->find('span', 0)->innertext ?? '';
				}
				if ($value->find('td', 4)) {
					$a = $value->find('td', 4)->find('span', 0)->innertext ?? '';
				}
				$topAssists_array[] = array('rk' => $rk, 'name' => $name, 'team' => $team, 'p' => $p, 'a' => $a);
			}
		}
		$response['stats'] = array('top_scorers' => $topScorers_array, 'top_assists' => $topAssists_array);
		return json_encode($response);
	}
	
	//------Football League Transfers--------// 
	public function fbal_league_transfers(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$mlgTrfHtml = file_get_html('https://www.espn.in'.$request->url);
		$mLgTcfHtml = $mlgTrfHtml->find('.transfers-table .ResponsiveTable .Table__Scroller .Table__TBODY');
		$legTcf_array = array();
		$imageUrl = 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/';

		foreach($mLgTcfHtml as $lgTcfArtl) {

			foreach ($lgTcfArtl->find('tr') as $value) {

				if ($value->find('td', 0)) {
					$date = $value->find('td', 0)->find('span', 0)->innertext ?? '';
				}
				if ($value->find('td', 1)) {
					$player = $value->find('td', 1)->find('a', 0)->innertext ?? '';
				}
				if ($value->find('td', 5)) {
					$fee = $value->find('td', 5)->find('span', 0)->innertext ?? '';
				}

				if ($value->find('td', 2)) {
					$imgIds = $value->find('td', 2)->find('a', 0)->href ?? '';
					$imgId = preg_replace('/[^0-9]/', '', $imgIds);
					$image = $imageUrl.$imgId.'.png&scale=crop&cquality=40&location=origin&w=80&h=80';
					$tName = $value->find('td', 2)->find('a span', 0)->innertext ?? '';
				}

				if ($value->find('td', 4)) {
					$imgIds1 = $value->find('td', 4)->find('a', 0)->href ?? '';
					$imgId1 = preg_replace('/[^0-9]/', '', $imgIds1);
					$image1 = $imageUrl.$imgId1.'.png&scale=crop&cquality=40&location=origin&w=80&h=80';
					$tName1 = $value->find('td', 4)->find('a span', 0)->innertext ?? '';
				}

				$from = array('image' => $image, 'tname' => $tName);
				$to = array('image' => $image1, 'tname' => $tName1);
				$legTcf_array[] = array('date' => $date, 'player' => $player, 'fee' => $fee, 'from' => $from, 'to' => $to);

			}

		}

		$response = array('transfers' => $legTcf_array);
		return json_encode($response);
	}
	
	//------Football All Teams--------// 
	public function fbal_all_teamsl(Request $request) {

		require_once(public_path('php/rex-tools.php'));
		$context = stream_context_create(
			array(
				"http" => array(
					"header" => "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36"
				)
			)
		);
	
		$html = file_get_html('https://www.espn.in/football/competitions', false, $context);
		$imgBasUrl = 'https://supersports24.xyz/public/football/images/leagues/';
		$html1 = $html->find('.layout__column--1 ');
	
		$leagueArray = array();
	
		foreach($html1 as $artVal) {
	
			foreach ($artVal->find('.is-split .ContentList__Item .mt3 .TeamLinks') as $value) {
	
				$name = $value->find('.pl3 a h2', 0)->innertext ?? '';
				$image = $this->specReplace($name).'.png';
				$schedule_link = $value->find('.pl3 .TeamLinks__Links a', 0)->href ?? '';
				$teams_link = $value->find('.pl3 .TeamLinks__Links a', 1)->href ?? '';
				$stats_link = $value->find('.pl3 .TeamLinks__Links a', 2)->href ?? '';
	
				$leagueArray[] = array('name' => $name, 'image' => $imgBasUrl.$image, 'schedule' => $this->baseSpecReplace($schedule_link), 'teams' => $this->baseSpecReplace($teams_link), 'stats' => $this->baseSpecReplace($stats_link));
	
			}
			
		}
	
		$response = array('league' => $leagueArray);
		return json_encode($response);
		
	}
	
	//------Football Turnament Teams--------// 
	public function fbal_turnament_teamsls(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$html = file_get_html("https://www.espn.in".$request->url);
		$html1 = $html->find('.is-split');
		$team = array();
		foreach ($html1 as $value) {

			foreach ($value->find('.ContentList__Item ') as $value) {
				$name = $value->find('h2', 0)->innertext ?? '';
				$path = $value->find('section a', 0)->href ?? '';
				$img99 = $this->hptNewSv($path);
				$imgryA = explode("/", $img99);
				$basurl = $imgryA[0];
				$image = 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/'. $basurl. '.png';

				$team[] = array( 'name'=> $name, 'image'=>$image);
			}  
		}
		$response = array('team' => $team, );
		return json_encode($response);
		
	}
	
	//-----------Html Remove Functions------------//
	public function newsImghpt($str){
        $str = str_replace('&amp;', '&', $str);
        return $str;
    }
	
	public function hptNewSv($str) {
		$str = str_replace('/football/club/_/id/', '', $str);
		return $str;
	}
	
	public function specReplace($str){
        $str = str_replace(' ', '-', $str);
        return $str;
    }
	
	public function baseSpecReplace($str){
        $str = str_replace('http://www.espn.in', '', $str);
        return $str;
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
