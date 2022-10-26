<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FootballfanstvController extends Controller {

	public function news()
	{

		require_once(public_path('php/scraping.php'));

		$context = stream_context_create(
		    array(
		        "http" => array(
		            "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
		        )
		    )
		);

		$onefootball_hom = file_get_html('https://onefootball.com/fr/home', false, $context);

		$onefootball = $onefootball_hom->find('body');
		$bas_url = 'https://onefootball.com/';

		$onefootballArray = array();
		$footmercatoArray = array();

		$footmercato_net = file_get_html('https://www.footmercato.net/', false, $context);
		$basurl = 'https://www.footmercato.net';
		$footmercato = $footmercato_net->find('.main ');

		foreach ($onefootball as $value) {
		    foreach ($value->find('.teaser--complete') as $table) {
		        $links = $table->find('a', 0)->href ?? 'ok';
		        $link = $bas_url . $links;
		        $image = $table->find('.of-image__picture img', 0)->src ?? '';
		        $title = $table->find('.teaser__content h3', 0)->innertext ?? '';
		        $time  = $table->find('.teaser__content .publisher__time', 0)->innertext ?? '';
		        $onefootballArray[] = array('link' => $link, 'image' => $this->newsImghpt($image), 'title' => trim($this->hpt($title)), 'time' => str_replace(" il y a ", "", $time), 'source' => 'onefootball');
		    }
		}


		foreach ($footmercato as $value) {
		    foreach ($value->find('.articleItem--withImage') as $table) {
		        if ($table->find('.articleItem__title a', 0) != '' || $table->find('.articleItem__title a', 0)->href ?? '' != '') {
		            $title = $table->find('.articleItem__title a', 0)->plaintext ?? '';
		            $links = $table->find('.articleItem__title a', 0)->href ?? '';

		            if ($links == 'https://www.footmercato.net') {
		                $link = $table->find('.articleItem__title a', 0)->href ?? '';
		            } else {
		                $link = $basurl . $links;
		            }

		            $image = $table->find('.articleItem__image img', 0)->getAttribute('data-src') ?? '';
		        }
		        $date = $table->find('.articleItem__date', 0)->innertext ?? '';
		        $footmercatoArray[] = array('link' => $link, 'title' => trim($this->hpt($title)), 'image' => $image, 'time' => str_replace(" ", "", $date), 'source' => 'footmercato');
		    }
		}
		$data = array_merge($onefootballArray, $footmercatoArray);
		$response = array('news' => $data);

		return json_encode($response);
	}

	function hpt($str)
	{
	    $str = str_replace('\t\t\t', ' ', $str);
	    $str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT, 'UTF-8');
	    $str = html_entity_decode($str, ENT_HTML5, 'UTF-8');
	    $str = html_entity_decode($str);
	    $str = htmlspecialchars_decode($str);
	    $str = strip_tags($str);
	    return $str;
	}

	function newsImghpt($str)
	{
	    $str = str_replace('&amp;', '&', $str);
	    return $str;
	}
}