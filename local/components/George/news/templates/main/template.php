<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<section id="portfolio" class="page-section bg-light">
    <div class="container">

        <div class="text-center">
            <h2 class="section-heading text-uppercase">Новости</h2>
        </div>

        <div class="row">
            <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
                <?= $arResult["NAV_STRING"] ?><br/>
            <? endif; ?>
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                    array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <? if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]): ?>
                    <span class="news-date-time"><? echo $arItem["DISPLAY_ACTIVE_FROM"] ?></span>
                <? endif ?>
                <div class="col-lg-4 col-sm-6 mb-4">
                <div class="portfolio-item">
                <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                    <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                        <a class="portfolio-link" data-bs-toggle="modal" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">

                            <img
                                    class="img-fluid"
                                    border="0"
                                    src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                    width="416"
                                    height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                    alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                    title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                                    style="float:none"
                            /></a>
                    <? else: ?> <img
                            class="img-fluid"
                            border="0"
                            src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                            width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                            height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                            alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                            title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                            style="float:none"
                    />
                    <? endif; ?>
                <? endif ?>
                <div class="portfolio-caption">
                <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
            <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                <!--                        <a href="--><? //echo $arItem["DETAIL_PAGE_URL"]?><!--">-->

                <div class="portfolio-caption-heading">
                <b><? echo $arItem["NAME"] ?></b></a><br/>
                <? else: ?>
                    <b><? echo $arItem["NAME"] ?></b><br/>
                <? endif; ?>
            <? endif; ?>
                </div>
                <div class="portfolio-caption-subheading text-muted">
                    <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                        <? echo $arItem["PREVIEW_TEXT"]; ?>
                    <? endif; ?>
                </div>

                <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>

                <? endif ?>
                <? foreach ($arItem["FIELDS"] as $code => $value): ?>
                    <small>
                        <?= GetMessage("IBLOCK_FIELD_" . $code) ?>:&nbsp;<?= $value; ?>
                    </small><br/>
                <? endforeach; ?>
                <div class="portfolio-caption-subheading text-muted">
                <? foreach ($arItem["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>
                    <?= $arProperty["NAME"] ?>:&nbsp;
                    <? if (is_array($arProperty["DISPLAY_VALUE"])): ?>
                        <?= implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]); ?>
                    <? else: ?>
                        <?= $arProperty["DISPLAY_VALUE"]; ?>
                    <? endif ?>
                    </div>
                    </div>
                    </div>
                    </div>


                <? endforeach; ?>
            <? endforeach; ?>
            <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
                <br/><?= $arResult["NAV_STRING"] ?>
            <? endif; ?>
        </div>
    </div>
</section>

