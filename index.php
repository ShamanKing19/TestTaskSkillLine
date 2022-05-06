<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Главная");
?>

<!-- ЭТО ВЫВОД СПИСКА НОВОСТЕЙ -->
    <?
    $APPLICATION->IncludeComponent(
	"bitrix:news",
	"",
    Array()
    );
    ?>

<?
    require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
    ?>