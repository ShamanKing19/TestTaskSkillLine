<?php
include "NewsClass.php";
use PHPHtmlParser\Dom;


class McDonaldsParser
{
    private int $numberOfNews;
    public string $url = "https://lenta.ru/tags/organizations/mcdonald-s/";


    public function __construct($numberOfNews)
    {
        $this->numberOfNews = $numberOfNews;
        set_time_limit(60);

        ini_set(
            'user_agent',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/605.1.15 (KHTML, like Gecko)'
        );
    }


    public function GetNews(){
        $newsArray = [];
        $links = $this->GetLinks();
        $dom = new Dom();
        foreach ($links as $link) {
            $dom->loadFromUrl($link);

            $title = $dom->getElementsByClass("topic-body__title")->innerHtml;
            $shortDescription = $dom->getElementsByClass("topic-body__title-yandex")->innerHtml;
            $picture = $dom->getElementsByClass("picture__image")->getAttribute("src");
            $detailText = strip_tags(implode("", $dom->getElementsByClass("topic-body__content-text")->toArray()));

            $newsArray[] = new NewsClass($title, $shortDescription, $picture, $detailText, $link);
        }

        return $newsArray;
    }


    private function GetLinks() {
        $dom = new Dom();
        $dom->loadFromUrl($this->url);
        $links = [];
        $tags = $dom->getElementsByClass("card-full-news")->toArray();
        for ($i=0; $i<$this->numberOfNews; $i++) {
            $links[] = "https://lenta.ru/".$tags[$i]->getTag()->getAttribute("href")->getValue();
        }
        return $links;
    }


    private function dd($value): void
    {
        echo "<pre>";
        var_export($value);
        echo "</pre>";
    }

}