<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once ('../../vendor/autoload.php');

use PHPHtmlParser\Dom;

// Using Medoo namespace
use Medoo\Medoo;

// Initialize
$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'ccp',
    //'server' => 'http://104.248.181.33:3306',
    'server' => 'localhost',
    'username' => 'ccp',
    'password' => 'Quiet22!'
]);


https://www.bbb.org/api/businessprofile/customerreviews?page=1&pageSize=20&businessId=310569227&bbbId=0734&sort=reviewDate%20desc

$bbbApiContents = file_get_contents('https://www.bbb.org/api/businessprofile/customerreviews?page=1&pageSize=15&businessId=310569227&bbbId=0734&sort=reviewDate%20desc');

$bbbArray = \json_decode($bbbApiContents, true);

$database->delete('review', [
   'type' => 'bbb'
]);

$quotes = array(
    "\xC2\xAB"     => '"', // « (U+00AB) in UTF-8
    "\xC2\xBB"     => '"', // » (U+00BB) in UTF-8
    "\xE2\x80\x98" => "'", // ‘ (U+2018) in UTF-8
    "\xE2\x80\x99" => "'", // ’ (U+2019) in UTF-8
    "\xE2\x80\x9A" => "'", // ‚ (U+201A) in UTF-8
    "\xE2\x80\x9B" => "'", // ‛ (U+201B) in UTF-8
    "\xE2\x80\x9C" => '"', // “ (U+201C) in UTF-8
    "\xE2\x80\x9D" => '"', // ” (U+201D) in UTF-8
    "\xE2\x80\x9E" => '"', // „ (U+201E) in UTF-8
    "\xE2\x80\x9F" => '"', // ‟ (U+201F) in UTF-8
    "\xE2\x80\xB9" => "'", // ‹ (U+2039) in UTF-8
    "\xE2\x80\xBA" => "'", // › (U+203A) in UTF-8
);

foreach($bbbArray['items'] as $bbbItem){
    if(boolval($bbbItem['hasExtendedText'])){

        $content = $bbbItem['extendedText'][0]['text'];
        $content = strtr($content, $quotes);
        $dateTime = $bbbItem['extendedText'][0]['date']['year'] . '-' . $bbbItem['extendedText'][0]['date']['month'] . '-' . $bbbItem['extendedText'][0]['date']['day'];
        $score = $bbbItem['reviewStarRating'];

        //var_dump($bbbItem);

        $database->insert('review', [
            'type' => 'bbb',
            'stars' => $score,
            'name' => $bbbItem['displayName'],
            'content' => $content,
            'datetime' => date('Y-m-d H:i:s', strtotime($dateTime))
        ]);

        //echo '<pre>';
        //var_dump($bbbItem);
        //echo '</pre>';
        //echo '<hr/>';
    }
}

// Google Reviews

$database->delete('review', [
    'type' => 'google'
]);

$dom = new Dom;

$fileContent = file_get_contents('https://www.google.com/async/reviewDialog?ei=xuiuX9ysIIuxtQbb5oqIDw&yv=3&async=feature_id:0x8874e416683a0b7b%3A0x74a59ba5e41618e8,review_source:All%20reviews,sort_by:qualityScore,start_index:0,is_owner:false,filter_text:,associated_topic:,next_page_token:,async_id_prefix:,_pms:s,_fmt:pc');

$domDocument = new \DOMDocument();
@$domDocument->loadHTML($fileContent);

$html = $domDocument->saveHTML();

//var_dump($html);

$dom->loadStr($domDocument->saveHTML());

$resultListSection = $dom->find('.jxjCjc');

foreach($resultListSection as $section) {

    $author = $section->find('.TSUbDb a')[0]->text;

    $starsSentence = $section->find('g-review-stars span')[0]->getAttribute('aria-label');
    $starScore = str_replace(' out of 5', '', str_replace('Rated', '', $starsSentence));
    $score = floatval($starScore);
    $shouldSave = $score >= 4;

    if($shouldSave) {

        $date = date('Y-m-d H:i:s', strtotime($section->find('.dehysf')[0]->text));

        //$resultListSnippet = $section->find('.review-snippet');
        //$resultListFullText = $section->find('.review-full-text');

        $resultList = $section->find('.Jtu6Td');

        foreach ($resultList as $result) {

            $firstSpan = $result->find('span')[0];
            $secondSpan = $firstSpan->find('span');

            $content = '';
            if (isset($secondSpan) && sizeof($secondSpan) == 3) {

                $content = $secondSpan[2]->text;
            } else {
                $content = $firstSpan->text;
            }

            /*if(sizeof($resultListReviewMore) == 0){
                $resultListSnippet = $resultListReviewMore->find('.review-snippet');
                var_dump($resultListSnippet->text);
            }
            else{

            }*/

            //echo $result->text . '<br/>';

            $database->insert('review', [
                'type' => 'google',
                'stars' => $score,
                'name' => $author,
                'content' => $content,
                'datetime' => $date
            ]);

        }
    }
}
