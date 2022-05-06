<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');
?> 


<h1>Hello World!</h1>

<?php
    include "local/php_interface/Parser.php";
    $parser = new Parser();
    $info = $parser->GetNews();
?>


<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>


