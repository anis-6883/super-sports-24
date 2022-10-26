<?php

	include('rex-tools.php');

    // header('content-type: application/json');
    // $request = $_SERVER['REQUEST_METHOD'];

    // switch ($request) {
    //     case 'POST':
    //             $data=json_decode(file_get_contents('php://input'), true);
    //             if($data["key"] == "123456789"){
    //                 nbaPreviewData($data);
    //             } else {
    //                 echo '{"Error":"Somthing is worng?"}';
    //             }
    //         break;
    //     default:
    //             echo '{"Error":"Somthing is worng?"}';
    //         break;
    // }

    // function nbaPreviewData($data) {

        $html = file_get_html('https://www.espn.in/nba/matchup?gameId=401337336', false);
        $mHtml = $html->find('.col-two .mod-data');

        $headerArray = array();
        $bodyArray = array();

        foreach($mHtml as $article) {

            foreach ($article->find('thead') as $value) {
                
                $title = $value->find('th', 0)->innertext;
                $t1Image = $value->find('img', 0)->src;
                $t2Image = $value->find('img', 1)->src;

                $headerArray = array('title' => $title, 't1Image' => $t1Image, 't2Image' => $t2Image);
            }

            foreach ($article->find('tbody tr') as $val01) {
                
                $title = $val01->find('td', 0)->innertext;
                $t1Point = $val01->find('td', 1)->innertext;
                $t2Point = $val01->find('td', 2)->innertext;

                $bodyArray[] = array('title' => $title, 't1Point' => $t1Point, 't2Point' => $t2Point);

            }

        }

        $object = array('header' => $headerArray, 'body' => $bodyArray);
        echo json_encode($object);

    // }

    // function hpt($str){
    //     $str = str_replace('&nbsp;', ' ', $str);
    //     $str = preg_replace('/\t/', '', $str);
    //     $str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
    //     $str = html_entity_decode($str, ENT_HTML5, 'UTF-8');
    //     $str = html_entity_decode($str);
    //     $str = htmlspecialchars_decode($str);
    //     $str = strip_tags($str);
    //     return $str;
    // }

?>