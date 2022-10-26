<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Fifa2022Controller extends Controller {
	
	//========stadium list and details========//
    public function stadiumList22(Request $request) {
		
		$stadiumArray = array();
		$stadiumArray[] = array(
	        'id' => '1', 
	        'name' => 'Al Bayt Stadium', 
	        'image' => 'https://hospitality.fifa.com/media/2238/sp_al_bayt_930x500-min.png',
	        'intro' => 'Located in the city of Al Khor, famous for its pearl diving and fishing, Al Bayt Stadium is fashioned to replicate the bayt al sha’ar, the tents historically used by the nomadic people of Qatar. This innovative design, echoing the flowing fabric of the traditional Bedouin dwellings, promises to delight all fans not only in design but also as the stage for some of the key matches at the FIFA World Cup Qatar 2022™ including the Opening Match, five additional Group Matches, as well as knock-out round matches including one of the two all-important Semi-finals matches.', 
	        'capacity' => 'A 60,000 capacity arena located in the city of Al Khor, famous for its pearl diving and fishing.',
	        'fixtures' => '6 x Group Matches, Round of 16, Quarter-final, Semi-final',
	        'address' => 'MF2Q+V4Q, Al Khor, Qatar',
	        'opened' => 'November 30, 2021',
	        'cost' => '€ 770 million'
	    );
	    $stadiumArray[] = array(
	        'id' => '2', 
	        'name' => 'Lusail Stadium', 
	        'image' => 'https://hospitality.fifa.com/media/2243/sp_lusail_stadium.jpg',
	        'intro' => 'Lusail Stadium, designed around the dance of light and shadows as seen in the traditional fanar lanterns, will be the stage for the most important game in football, the Final match of the FIFA World Cup Qatar 2022™. The stadium has been designed as a rich representation of the Arabic world, showcasing motifs of vessels, bowls and art pieces from the region. In addition to the Final, Lusail Stadium will also host six Group Matches and three knock-out round matches including one Semi-final. Offering 80,000 seats Lusail Stadium is the embodiment of Qatar’s passion for sharing its culture with the world. It is located 15km north of the Doha’s city centre and stands as the centrepiece of the new Lusail metropolis.', 
	        'capacity' => '80,000 capacity arena that will host the all-important Final Match of the FIFA World Cup Qatar 2022™',
	        'fixtures' => '6 x Group Matches, Round of 16, Quarter-final, Semi-final, The Final',
	        'address' => 'Lusail, Qatar',
	        'opened' => '22 November 2021',
	        'cost' => '$ 767 mln'
	    );
	    $stadiumArray[] = array(
	        'id' => '3', 
	        'name' => 'Al Janoub Stadium', 
	        'image' => 'https://hospitality.fifa.com/media/2237/sp_al-janub_930x550.jpg',
	        'intro' => 'Located in the southern city of Al Wakrah, the 40,000-capacity Al Janoub Stadium has been designed as a nod to the dhow, the pearl fishing boats which are one of the most iconic symbols of the Qatari region. As one of Qatar oldest continuously inhabited areas, Al Wakrah has long been known as a centre for pearl diving and fishing and the use of flowing designs, timber and natural materials in the stadium construction is an homage to this heritage. Al Janoub Stadium will host six of the Group Matches at the FIFA World Cup™ as well as one Round of 16 match.', 
	        'capacity' => 'A 40,000 capacity arena in the southern city of Al Wakrah, one of Qatar oldest continuously inhabited areas.',
	        'fixtures' => '6 x Group Matches, Round of 16',
	        'address' => 'Al Wakrah, Qatar',
	        'opened' => '16 May 2019',
	        'cost' => '€ 587 million'
	    );
	    $stadiumArray[] = array(
	        'id' => '4', 
	        'name' => 'Ahmad Bin Ali Stadium', 
	        'image' => 'https://hospitality.fifa.com/media/2239/sp_al_rayan_930x550-min.png',
	        'intro' => 'Ahmad Bin Ali Stadium draws from Qatari cultural symbols to create a stadium that mirrors the desert and cultural beauty that surrounds it. The locals of Al Rayyan are known for their love of tradition and warm hospitality – something that fans can look forward to. Offering 40,000 seats, the stadium was built specifically for the FIFA World Cup Qatar 2022™ and replaced the original stadium that stood there. The area also plays host to a new mall, The Mall of Qatar. After the tournament the stadium’s capacity will be decreased by half to make it more suitable for local community use. The stadium, which sits on the edge of the desert, is connected to the city via a new railway.', 
	        'capacity' => 'A 40,000 capacity arena located on the grounds of the old Ahmed Bin Ali Stadium.',
	        'fixtures' => '6 x Group Matches, Round of 16',
	        'address' => 'Umm Al Afaei, Al Rayyan, Qatar',
	        'opened' => '18 December 2020',
	        'cost' => ''
	    );
	    $stadiumArray[] = array(
	        'id' => '5', 
	        'name' => 'Al Thumama Stadium', 
	        'image' => 'https://hospitality.fifa.com/media/2240/sp_althuman_930x550.jpg',
	        'intro' => 'Al Thumama stadium, inspired by the traditional gahfiya, a woven cap which forms an important part of the traditional dress of the area, is a magnificent ode to the culture, history and symbolism of the area. The 40,000 seat stadium, built specifically for the FIFA World Cup Qatar 2022™, will play host to a number of matches up until the quarter-final stage. At the events closing, the stadiums capacity will be reduced to 20,000 seats with the additional seating being gifted to developing nations, a true reflection of the generosity of the Qatari people. A boutique hotel will replace the top seating of the stadium and branch of the world-renowned Aspetar Sports Clinic will be added. This way the stadium will continue to serve the community long after the World Cup has ended.', 
	        'capacity' => 'A 40,000 capacity arena inspired by the traditional gahfiya, located 12kms south of Doha.',
	        'fixtures' => '6 x Group Matches, Round of 16, Quarter-final',
	        'address' => 'Al Thumama, Qatar',
	        'opened' => '22 October 2021',
	        'cost' => '$342 million'
	    );   
	    $stadiumArray[] = array(
	        'id' => '6',
	        'name' => 'Education City Stadium', 
	        'image' => 'https://hospitality.fifa.com/media/2291/sp_education_city_923x550_flipped.jpg',
	        'intro' => 'Surrounded by leading universities and ground-breaking research, Education City is a stadium in the hub of innovation. From its unique cooling system to the green spaces that surround it, the stadium was built with sustainability and the future in mind. The initial capacity of the diamond shaped stadium will be 40,000 seats, which will be reduced to 25,000 seats at the end of the tournament with the additional seats being donated to developing countries. Surrounding the stadium, which is located a mere 7km from the city centre, fans will be able to enjoy a golf course and a variety of shops.', 
	        'capacity' => 'A 40,000 capacity arena surrounded by Qatar leading educational sector.',
	        'fixtures' => '6 x Group Matches, Round of 16, Quarter-final',
	        'address' => 'Education City, Al Rayyan, Qatar',
	        'opened' => 'February 2020',
	        'cost' => '$700 million'
	    );
	    $stadiumArray[] = array(
	        'id' => '7', 
	        'name' => 'Khalifa Int Stadium', 
	        'image' => 'https://hospitality.fifa.com/media/2242/sp_kalifa_930x550.jpg',
	        'intro' => 'As Qatar’s principal football stadium since 1976, Khalifa International Stadium has served as the corner stone of the country’s sporting tradition. Representing continuity and the embracing of fans, two new dual arches have recently been added to the stadium in preparation of the upcoming FIFA World Cup™ matches. The stadium offers fans 40,000 seats and is conveniently located 10km from the city centre. It forms part of a larger development which includes Qatar’s Olympic aquatics centre and indoor hall. The Villaggio Mall, a park and The Torch Doha hotel are also part of the development. The stadium will also play home to the 3-2-1 Qatar Olympic and Sports Museum.', 
	        'capacity' => 'A 40,000 capacity arena that has been the cornerstone of Qatari sports since 1976.',
	        'fixtures' => '6 x Group Matches, Round of 16, 3d place match',
	        'address' => '7C7X+C67, Al Waab St, Doha, Qatar',
	        'opened' => '1976',
	        'cost' => ''
	    );
	    $stadiumArray[] = array(
	        'id' => '8', 
	        'name' => 'Stadium 974', 
	        'image' => 'https://hospitality.fifa.com/media/2244/sp_rasabu_930x500.jpg',
	        'intro' => 'Stadium 974, a temporary stadium built along the shores of the Gulf, offers not only dazzling views of West Bay, but an intriguing design concept. Constructed from Shipping containers, the stadium uses less material to build than traditional stadiums, creating a blue print for future developers to follow.', 
	        'capacity' => 'A 40,000 capacity arena honouring Qatar rich maritime history.',
	        'fixtures' => '6 x Group Matches, Round of 16',
	        'address' => 'Ras Abu Aboud, Qatar',
	        'opened' => '30 November 2021',
	        'cost' => ''
	    );
		
		$response = array('stadium'=>$stadiumArray);
		return json_encode($response);
	}
	
	//========Standing Details========//
	public function fifa22standing(Request $request)  {
		
		require_once(public_path('php/rex-tools.php'));
		
		$html =  file_get_html('https://www.espn.in/football/table/_/league/fifa.world');
		
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
	
	public function fifa2022home(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$html = file_get_html('https://onefootball.com/en/home');
		$mHtml = $html->find('.home-stream .xpa-layout-home__section--gallery .teaser',);
		$topStore = array();
		$newsInfo = array();
		
		//--------Home Top Store-----------//
		foreach($mHtml as $article) {
			foreach ($article->find('.teaser__link') as $value) {
				$link = $value->href ?? '';
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
		
		$teamArray = array();
		$teamArray[] = array(
			'id' => '1', 
			'name' => 'Argentina', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/202/arg',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/202/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/arg.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '2', 
			'name' => 'Australia', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/628/australia', 
			'squad' => 'https://www.espn.in/football/team/squad/_/id/628/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/aus.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '3', 
			'name' => 'Belgium', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/459/belgium', 
			'squad' => 'https://www.espn.in/football/team/squad/_/id/459/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/bel.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '4', 
			'name' => 'Brazil', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/205/brazil',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/205/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/bra.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '5', 
			'name' => 'Cameroon', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/656/cameroon',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/656/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/crm.png',
			'intro' => 'Fixtures | Teams | Stats'
		);   
		$teamArray[] = array(
			'id' => '6', 
			'name' => 'Canada', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/206/canada', 
			'squad' => 'https://www.espn.in/football/squad/team/_/id/206/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/can.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '7', 
			'name' => 'Costa Rica', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/214/costa-rica', 
			'squad' => 'https://www.espn.in/football/team/squad/_/id/214/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/crc.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '8', 
			'name' => 'Croatia', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/477/croatia',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/477/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/cro.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '9', 
			'name' => 'Denmark', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/479/denmark',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/479/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/den.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '10', 
			'name' => 'Ecuador', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/209/ecuador',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/209/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/ecu.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '11', 
			'name' => 'England', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/448/england',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/448/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/eng.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '12', 
			'name' => 'France', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/478/france',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/478/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/fra.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '13',
			'name' => 'Germany',
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/481/germany',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/481/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/ger.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '14',
			'name' => 'Ghana',
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/4469/ghana',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/4469/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/gha.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '15', 
			'name' => 'IR Iran', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/469/ir-iran',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/469/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/irn.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '16', 
			'name' => 'Japan', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/627/japan',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/627/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/jpn.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '17', 
			'name' => 'Mexico', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/203/mexico',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/203/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/mex.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '18', 
			'name' => 'Morocco', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/2869/morocco',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/2869/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/mar.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '19', 
			'name' => 'Netherlands', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/449/netherlands',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/449/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/ned.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '20', 
			'name' => 'Poland', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/471/poland',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/471/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/pol.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '21', 
			'name' => 'Portugal', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/482/portugal',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/482/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/por.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '22', 
			'name' => 'Qatar', 
			'fixtures' => 'https://www.espn.in/football/fixtures/team/_/id/4398/qatar',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/4398/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/qat.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '23', 
			'name' => 'Saudi Arabia', 
			'fixtures' => 'https://www.espn.in/football/fixtures/team/_/id/655/saudi-arabia',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/655/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/ksa.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '24', 
			'name' => 'Senegal', 
			'fixtures' => 'https://www.espn.in/football/fixtures/team/_/id/654/senegal',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/654/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/sen.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '25', 
			'name' => 'Serbia', 
			'fixtures' => 'https://www.espn.in/football/fixtures/team/_/id/6757/serbia',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/6757/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/sba.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '26', 
			'name' => 'South Korea', 
			'fixtures' => 'https://www.espn.in/football/fixtures/team/_/id/451/south-korea',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/451/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/kors.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '27', 
			'name' => 'Spain', 
			'fixtures' => 'https://www.espn.in/football/fixtures/team/_/id/164/spain',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/164/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/esp.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '28', 
			'name' => 'Switzerland', 
			'fixtures' => 'https://www.espn.in/football/fixtures/team/_/id/475/switzerland',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/475/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/sui.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '29', 
			'name' => 'Tunisia', 
			'fixtures' => 'https://www.espn.in/football/fixtures/team/_/id/659/tunisia',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/659/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/tun.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '30', 
			'name' => 'United States', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/660/united-states',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/660/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/usa.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '31', 
			'name' => 'Uruguay', 
			'fixtures' => 'https://www.espn.in/football/fixtures/team/_/id/212/uruguay',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/212/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/uru.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		$teamArray[] = array(
			'id' => '32', 
			'name' => 'Wales', 
			'fixtures' => 'https://www.espn.in/football/team/fixtures/_/id/578/wales',
			'squad' => 'https://www.espn.in/football/team/squad/_/id/578/league/FIFA.WORLD',
			'image' => 'https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/wal.png',
			'intro' => 'Fixtures | Teams | Stats'
		);
		
		$response = array('team' => $teamArray, 'topstore' => $topStore);
		return json_encode($response);
	}
	
	//------Football Team Fixtures--------// 
	public function fifa2022_fixtures(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$html = file_get_html($request->url);

		$fixturesArray = array();
		$mHtml = $html->find('div[id="fittPageContainer"] .ResponsiveTable');
		$jmgBaseUrl = 'https://cric4you.com/football/fifa-team/'; 


		foreach($mHtml as $article) {

			foreach ($article->find('.flex .Table__TBODY') as $key2 => $value2) {

				foreach($value2->find('tr') as $key3 => $a){

					$date = $a->find('td ', 0)->find('.matchTeams', 0)->innertext ?? '';
					$team1 = $a->find('td ', 1)->find('a', 0)->innertext ?? '';
					$t1Img = $jmgBaseUrl . str_replace(' ', '-', strtolower($team1)) . '.png';
					$team2 = $a->find('td ', 3)->find('a', 0)->innertext ?? '';
					$t2Img = $jmgBaseUrl . str_replace(' ', '-', strtolower($team2)) . '.png';
					$time = $a->find('td ', 4)->find('a', 0)->innertext ?? '';
					$competition = $a->find('td ', 5)->find('span', 0)->innertext ?? '';

					$fixturesArray[] = array('date' => $date, 'team1' => $team1, 'image1' => $t1Img, 'team2' => $team2, 'image2' => $t2Img, 'time' => $time,'competition' => $competition);

				}
			}
		}

		$response['fixturesx'] = $fixturesArray;
		return json_encode($response);
	}
	
	//------Football Team Squad--------// 
	public function fifa22_team_squad(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$html = file_get_html($request->url);

		$goalkeepersArray = array();
		$outfieldArray = array();
		$mHtml01 = $html->find('div[id="fittPageContainer"] .goalkeepers');
		$mHtml02 = $html->find('div[id="fittPageContainer"] .outfield');

		foreach($mHtml01 as $article) {
			foreach ($article->find('.flex .Table__TBODY tr') as $a) {
				$pName = $a->find('td ', 0)->find('a', 0)->innertext ?? '';
				$pos = $a->find('td ', 1)->find('.inline', 0)->innertext ?? '';
				$age = $a->find('td ', 2)->find('.inline', 0)->innertext ?? '';
				$ht = $a->find('td ', 3)->find('.inline', 0)->innertext ?? '';
				$wt = $a->find('td ', 4)->find('.inline', 0)->innertext ?? '';
				$nat = $a->find('td ', 5)->find('.inline', 0)->innertext ?? '';
				$p = $a->find('td ', 6)->find('.inline', 0)->innertext ?? '';
				$sb = $a->find('td ', 7)->find('.inline', 0)->innertext ?? '';
				$s = $a->find('td ', 8)->find('.inline', 0)->innertext ?? '';
				$gc = $a->find('td ', 9)->find('.inline', 0)->innertext ?? '';
				$as = $a->find('td ', 10)->find('.inline', 0)->innertext ?? '';
				$fc = $a->find('td ', 11)->find('.inline', 0)->innertext ?? '';
				$fa = $a->find('td ', 12)->find('.inline', 0)->innertext ?? '';
				$ye = $a->find('td ', 13)->find('.inline', 0)->innertext ?? '';
				$rc = $a->find('td ', 14)->find('.inline', 0)->innertext ?? '';
				$goalkeepersArray[] = array('name' => $pName, 'pos' => $pos, 'age' => $age, 'ht' => $ht, 'wt' => $wt, 'nat' => $nat,'p' => $p,'sb' => $sb,'s' => $s, 'gc' => $gc, 'a' => $as, 'fc' => $fc, 'fa' => $fa, 'ye' => $ye, 'rc' => $rc);
			}
		}

		foreach($mHtml02 as $article) {
			foreach ($article->find('.flex .Table__TBODY tr') as $a) {
				$pName = $a->find('td ', 0)->find('a', 0)->innertext ?? '';
				$pos = $a->find('td ', 1)->find('.inline', 0)->innertext ?? '';
				$age = $a->find('td ', 2)->find('.inline', 0)->innertext ?? '';
				$ht = $a->find('td ', 3)->find('.inline', 0)->innertext ?? '';
				$wt = $a->find('td ', 4)->find('.inline', 0)->innertext ?? '';
				$nat = $a->find('td ', 5)->find('.inline', 0)->innertext ?? '';
				$p = $a->find('td ', 6)->find('.inline', 0)->innertext ?? '';
				$sb = $a->find('td ', 7)->find('.inline', 0)->innertext ?? '';
				$g = $a->find('td ', 8)->find('.inline', 0)->innertext ?? '';
				$ac = $a->find('td ', 9)->find('.inline', 0)->innertext ?? '';
				$sh = $a->find('td ', 10)->find('.inline', 0)->innertext ?? '';
				$so = $a->find('td ', 11)->find('.inline', 0)->innertext ?? '';
				$fc = $a->find('td ', 12)->find('.inline', 0)->innertext ?? '';
				$fa = $a->find('td ', 13)->find('.inline', 0)->innertext ?? '';
				$yc = $a->find('td ', 14)->find('.inline', 0)->innertext ?? '';
				$rc = $a->find('td ', 15)->find('.inline', 0)->innertext ?? '';
				$outfieldArray[] = array('name' => $pName, 'pos' => $pos, 'age' => $age, 'ht' => $ht, 'wt' => $wt, 'nat' => $nat,'p' => $p,'sb' => $sb,'g' => $g, 'a' => $ac, 'sh' => $sh, 'so' => $so, 'fc' => $fc, 'fa' => $fa, 'yc' => $yc, 'rc' => $rc);
			}
		}

		$response['squad'] =  array('goalkeeper' => $goalkeepersArray, 'outfield' => $outfieldArray);
		return json_encode($response);
	}
	
	//------Tv Guide Country--------// 
	public function tvGuideCountry(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$context = stream_context_create(
			array(
				"http" => array(
					"header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
				)
			)
		);

		$html = file_get_html('https://www.telefootball.net/GB/tvs/', false, $context);
		$tele = $html->find('body');
		$countrycodeArray = array();

		foreach ($tele as $value) {

			if ($value->find('#selcountrydiv') != '') {
				foreach ($value->find('#selcountrydiv a') as $cod) {
					$divs = $cod->find('.moblogo53');
					foreach ($divs as $div) {
						$link = $div->style;
					}
					if (preg_match('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $link, $matches)) {
						$image_url = $matches[0];
					}
					$name = $cod->find('.moblogo54', 0)->plaintext ?? '';
					$link = $cod->href ?? '';
					$countryArray[] = array('name' => $this->hpt($name), 'link' => 'https:'.$link, 'image_url' => $image_url);
				}
			}
		}

		$response = array('country' => $countryArray);
		return json_encode($response);
		
	}
	
	//------Tv Guide Fixtures--------// 
	public function tvGuideFixtures(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		
		$url = $request->url;
		$context = stream_context_create(
			array(
				"http" => array(
					"header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
				)
			)
		);

		$html = file_get_html($url, false, $context);
		$tele = $html->find('.v8center');
		$linksty = '';
		$liveoutArray = array();
		$liveArray = array();
		foreach ($tele as $value) {
			foreach ($value->find('.lqvonews12out a') as $out) {
				$link =  $out->href ?? '';
				$t_one_name = $out->find('.appt32ins', 0)->plaintext ?? '';
				$t_tow_name = $out->find('.appt32ins', 1)->plaintext ?? '';
				$m_time = $out->find('.appt32', 0)->plaintext ?? '';
				$tvimage = $out->find('.appt34tv img', 0)->src ?? '';
				foreach ($out->find('.nd_otb_pro2 div') as $div) {
					$linksty = $div->style;
					if ($linksty != '') {
						$liveoutArray[] = array('t_one_name' => $t_one_name, 't_tow_name' => $t_tow_name, 'm_time' => $m_time, 'image' => $this->hptTvGuide($linksty), 'tvimage' => $tvimage,);
					}
				}
			}
			foreach ($value->find('.lqvonews12 a') as $table) {
				$link =  $table->href ?? '';
				$t_one_name = $table->find('.appt32ins', 0)->plaintext ?? '';
				$t_tow_name = $table->find('.appt32ins', 1)->plaintext ?? '';
				$m_time = $table->find('.appt32', 0)->plaintext ?? '';
				$tvimage = $table->find('.appt34tv img', 0)->src ?? '';
				foreach ($table->find('.nd_otb_pro2 div') as $div) {
					$linksty = $div->style;
					if ($linksty != '') {
						$liveArray[] = array('t_one_name' => $t_one_name, 't_tow_name' => $t_tow_name, 'm_time' => $m_time, 'image' => 'https:'.$this->hptTvGuide($linksty), 'tvimage' => $tvimage,);
					}
				}
			}
		}
		$response = array('upcoming' => $liveArray, 'complete' => $liveoutArray);
		return json_encode($response);
	}

	//------Tv Guide Fixtures v2--------// 
	public function tvGuideFixturesv2(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$url = $request->url;
		$context = stream_context_create(
			array(
				"http" => array(
					"header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
				)
			)
		);
		$html = file_get_html($url, false, $context);
		$tele = $html->find('.v8center');
		$endImg = 'https://i.id24.bg/tpl/telefootball/img/v9tvrow42.png';
		$linksty = '';
		foreach ($tele as $value) {
			foreach ($value->find('.lqvonews12 a') as $table) {
				$link =  $table->href ?? '';
				$t1name = $table->find('.appt32ins', 0)->plaintext ?? '';
				$t2name = $table->find('.appt32ins', 1)->plaintext ?? '';
				$m_time = $table->find('.appt32', 0)->plaintext ?? '';
				foreach ($table->find('.nd_otb_pro2 div') as $div) {
					$linksty = $div->style;
					if ($linksty != '') {
						$liveArray[] = array('start' => 'https:'.$this->hptTvGuide($linksty), 'link' => $link, 't1name' => $t1name, 't2name' => $t2name, 'endImg' => $endImg);
					}
				}
			}
		}
		$response = array('upcoming' => $liveArray);
		return json_encode($response);
	}

	//------Tv Guide Details v2--------// 
	public function tvGuideDetailsv2(Request $request) {
		require_once(public_path('php/rex-tools.php'));
		$url = $request->url;
		$context = stream_context_create(
			array(
				"http" => array(
					"header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
				)
			)
		);
		$html = file_get_html($url, false, $context);
		$tele = $html->find('.v8center');
		$defurl = 'https://www.telefootball.net';
		$headerArray = array();
		$tvImgArray = array();
		$oddsArray = array();

		foreach ($tele as $value) {

			$title = $value->find('.fut_rezulnov0', 0)->innertext ?? '';

			$t1Name = $this->hpt($value->find('.fut_rezulnov2', 0)->innertext ?? '');
			$t1Image = $defurl . $value->find('.fut_rezulnov2 .fut_rezulnov21 img', 0)->src ?? '';

			$result = $this->hpt($value->find('.fut_rezulnov4 .fut_rezulnov41', 0)->innertext ?? '');

			$t2Name = $this->hpt($value->find('.fut_rezulnov5', 0)->innertext ?? '');
			$t2Image = $defurl . $value->find('.fut_rezulnov5 .fut_rezulnov21 img', 0)->src ?? '';

			$headerArray = array('title' => $title, 't1Name' => $t1Name, 't1Image' => $t1Image, 'result' => $result, 't2Name' => $t2Name, 't2Image' => $t2Image);

			foreach ($value->find('.appt3not3 img') as $tvImgs) {
				$tvimgurl = $tvImgs->src ?? '';
				$tvImgArray[] = array('tvimg' => $defurl . $tvimgurl,);
			}

			$tnode = $value->find('.v9gamemoreinfos .apph11', 0)->innertext ?? '';

			if($value->find('.v9gamemoreinfos .v9gamemoreinf3k4365')){
				$odds = $value->find('.v9gamemoreinfos .v9gamemoreinf3k4365 b span', 0)->innertext ?? '';
				$one = $value->find('.v9gamemoreinfos .v9gamemoreinf3k4365 .v9gamemoreinf3k32s', 0)->innertext ?? '';
				$x = $value->find('.v9gamemoreinfos .v9gamemoreinf3k4365 .v9gamemoreinf3k32s', 1)->innertext ?? '';
				$two = $value->find('.v9gamemoreinfos .v9gamemoreinf3k4365 .v9gamemoreinf3k32s', 2)->innertext ?? '';
				$oddsArray = array('odds' => $odds, 'one' => $one, 'x' => $x, 'two' => $two);
			} else {
				$oddsArray = array('odds' => '', 'one' => '', 'x' => '', 'two' => '');
			}

		}

		$response = array('header' => $headerArray, 'tvbroadcast' => $tvImgArray,  'match_node' => $tnode, 'oddsArray' => $oddsArray);
		return json_encode($response);
	}
	
	public function newsImghpt($str){
        $str = str_replace('&amp;', '&', $str);
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
	
	function hptTvGuide($str)
	{
		$str = str_replace('\');background-position: center left;background-repeat: no-repeat;padding-left:32px;', '', str_replace('background-color:#eeeeee;background-image:url(\'', '', $str));
		$str = preg_replace('/\t/', '', $str);
		$str = preg_replace('/\%/', '', $str);
		$str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT, 'UTF-8');
		$str = html_entity_decode($str, ENT_HTML5, 'UTF-8');
		$str = html_entity_decode($str);
		$str = htmlspecialchars_decode($str);
		$str = strip_tags($str);
		return $str; 
	}

    
}
