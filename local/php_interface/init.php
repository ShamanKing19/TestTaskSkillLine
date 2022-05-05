<?php
require "vendor/autoload.php";
use PHPHtmlParser\Dom;

include "NewsClass.php";
set_time_limit(60);
$userAgentOption = "User-Agent:    Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6\r\n";
/*
ini_set(
    'user_agent',
    'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-GB; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3'
);*/


$url = "https://lenta.ru/parts/news/";
$keywords1 = ["Макдональдс", "McDonalds", "Mc Donalds", "McDonald's", "Mc Donald's"];
$keywords2 = ["Россия", "Европа"];

$newsArray = getLinksAndTitles($url, 10, $keywords2);

dd($newsArray);


$newsInfoArray = [];

foreach ($newsArray as $title => $link) {
    $newsInfoArray[] = collectDataFromPage($title, $link);
}





function collectDataFromPage($title, $url): NewsClass {
    $dom = new Dom();
    $dom->loadFromUrl($url);

    $shortDescription = trim($dom->getElementsByClass("topic-body__title-yandex")->toArray()[0]);
    $picture = $dom->getElementsByClass("picture__image")->getAttribute("src");
    $detailText = implode("", $dom->getElementsByClass("topic-body__content-text")->toArray());

    $News = new NewsClass($title, $shortDescription, $picture, $detailText, $url);

    return $News;
}


function getLinksAndTitles($url, $numberOfResults, array $keywords): array {
    $dom = new Dom();
    $newsArray = [];
    $page = 1;

    while (count($newsArray) < $numberOfResults) {
        $dom->loadFromUrl($url.$page."/");
        foreach ($keywords as $keyword){
            $linksArray = parsePage($dom, $keyword);
            foreach ($linksArray as $title => $link){
                $newsArray[$title] = $link;
            }
        }
        //echo "<script>console.log('Просмотрена страница №$page')</script>";
        $page++;
    }
    return $newsArray;
}


function parsePage($dom, $keyword): array
{
    $titlesWithLinksArray = [];
    $news = $dom->getElementsByClass("card-full-news");
    $titles = $dom->getElementsByClass("card-full-news__title");

    // Проверка ради проверки
    if (count($news) != count($titles)) throw new ErrorException("Количество новостей и заголовков не совпадает", 1);

    for ($i = 0; $i<count($news); $i++) {
        $title = $titles[$i]->innerHtml;

        if (str_contains(strtolower($title), strtolower($keyword))) {
            $tagHref = $news[$i]->getTag();
            $link = $tagHref->getAttribute("href")->getValue();
            if (!str_contains($link, "motor.ru") && !str_contains($link, "moslenta.ru")) {
                $link = "https://lenta.ru".$link;
                $titlesWithLinksArray[$title] = $link;
            }
        }
    }
    return $titlesWithLinksArray;
}


function getTitles($dom, $keyword): array
{
    $titlesArray = [];
    $titles = $dom->getElementsByClass("card-full-news__title");
    foreach ($titles as $title) {
        $titleText = $title->innerHtml;
        if (str_contains(strtolower($titleText), strtolower($keyword))) {
            $titlesArray[] = $titleText;
        }
    }
    return $titlesArray;
}


function dd($value): void
{
    echo "<pre>";
    var_export($value);
    echo "</pre>";
}

