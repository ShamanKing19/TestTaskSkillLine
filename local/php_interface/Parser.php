<?php
include "NewsClass.php";
use PHPHtmlParser\Dom;

class Parser
{
    //private $userAgentOption = "User-Agent:    Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6\r\n";

    public array $keywords1 = ["Макдональдс", "McDonalds", "Mc Donalds", "McDonald's", "Mc Donald's"];
    public array $keywords2 = ["Россия", "Европа"];
    public array $keywords3 = ["Путин", "Вучич"];
    public array $keywords4 = ["Россия"];
    private int $numberOfNews;

    public string $url = "https://lenta.ru/parts/news/";

    public function __construct($numberOfNews)
    {
        $this->numberOfNews = $numberOfNews;
        set_time_limit(60);
        /*
        ini_set(
            'user_agent',
            'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-GB; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3'
        );*/
    }


    public function GetNews(): array{
        $newsArray = $this->getLinksAndTitles($this->url, $this->numberOfNews, $this->keywords2);

        $newsInfoArray = [];

        $dom = new Dom();
        foreach ($newsArray as $title => $link) {
            $newsInfoArray[] = $this->collectDataFromPage($dom, $title, $link);
        }

        //$json = json_encode($newsInfoArray);
        //echo "<script>console.log($json)</script>";
        //$this->dd($newsInfoArray);
        return $newsInfoArray;
    }


    private function collectDataFromPage($dom, $title, $url): NewsClass {
        $dom->loadFromUrl($url);

        $shortDescription = $dom->getElementsByClass("topic-body__title-yandex")->toArray()[0];
        $picture = $dom->getElementsByClass("picture__image")->getAttribute("src");
        $detailArticles = $dom->getElementsByClass("topic-body__content-text")->toArray();

        $shortText = strip_tags($shortDescription);
        $detailText = implode("", $detailArticles);
        $detailTextWithoutLinks = strip_tags($detailText);

        return new NewsClass($title, $shortText, $picture, $detailTextWithoutLinks, $url);
    }


// TODO: Сделать Keywords необязательным параметром
    private function getLinksAndTitles($url, $numberOfResults, array $keywords): array {
        $dom = new Dom();
        $newsArray = [];
        $page = 1;

        while (count($newsArray) < $numberOfResults) {
            $dom->loadFromUrl($url.$page."/");
            foreach ($keywords as $keyword){
                $linksArray = $this->parsePage($dom, $keyword);
                foreach ($linksArray as $title => $link){
                    $newsArray[$title] = $link;
                }
            }
            //echo "<script>console.log('Просмотрена страница №$page')</script>";
            $page++;
        }
        return $newsArray;
    }


    private function parsePage($dom, $keyword): array
    {
        $titlesWithLinksArray = [];
        $news = $dom->getElementsByClass("card-full-news");
        $titles = $dom->getElementsByClass("card-full-news__title");

        // Проверка ради проверки
        //if (count($news) != count($titles)) throw new ErrorException("Количество новостей и заголовков не совпадает", 1);

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

// Не использую
    private function getTitles($dom, $keyword): array
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


    private function dd($value): void
    {
        echo "<pre>";
        var_export($value);
        echo "</pre>";
    }
}