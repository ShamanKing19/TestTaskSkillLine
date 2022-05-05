<?php

class NewsClass
{
    public string $title;
    public string $shortDescription; // PREVIEW_TEXT
    public string $picture; // DETAIL_PICTURE
    public string $detailText; // DETAIL_TEXT
    public string $link; //

    function __construct($title, $shortDescription, $picture, $detailText, $link){
        $this->title = $title;
        $this->shortDescription = $shortDescription;
        $this->picture = $picture;
        $this->detailText = $detailText;
        $this->link = $link;
    }

}