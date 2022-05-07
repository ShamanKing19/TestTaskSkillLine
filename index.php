<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>



<?php
    require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
    $APPLICATION->SetTitle("Главная");
?>


<!-- ЭТО ВЫВОД СПИСКА НОВОСТЕЙ -->
<?php
    $APPLICATION->IncludeComponent(
	"bitrix:news",
	"",
    Array()
    );
?>

<?php
    require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>




</body>
</html>
