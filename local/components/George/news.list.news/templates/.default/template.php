<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Новости</h2>
        </div>

        <div class="news-list">
            <div class="row">
                <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
                    <?= $arResult["NAV_STRING"] ?><br/>
                <? endif; ?>
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>

                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="news-item portfolio-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <!-- Картинка -->
                        <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1">
                            <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                                <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                                    <a class="portfolio-link" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                                        <img
                                                class="mx-auto d-block"
                                                border="0"
                                                src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                                width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                                height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                                alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                                title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                                        />
                                    </a>
                                <? else: ?>
                                    <img
                                            class="preview_picture"
                                            border="0"
                                            src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                            width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                            height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                            alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                            title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                                            style="float:left"
                                    />
                                <? endif; ?>
                            <? endif ?>
                        </a>
                        <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                            <div style="clear:both"></div>
                        <? endif ?>

                        <!-- Информация -->
                        <div class="portfolio-caption">
                            <!-- Заголовок -->
                            <div class="portfolio-caption-heading">
                                <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                                    <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                                        <a  href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><b><? echo $arItem["NAME"] ?></b></a><br/>
                                    <? else: ?>
                                        <b><? echo $arItem["NAME"] ?></b><br/>
                                    <? endif; ?>
                                <? endif; ?>
                            </div>

                            <!-- Краткое описание -->
                            <div class="portfolio-caption-subheading text-muted">
                                <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                                    <? echo $arItem["PREVIEW_TEXT"]; ?>
                                <? endif; ?>
                            </div>

                            <!-- Ссылка на источник -->
                            <div class="portfolio-caption-subheading text-muted">
                                <? foreach ($arItem["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>
                                    <small>
                                        <?= $arProperty["NAME"] ?>:&nbsp;
                                        <? if (is_array($arProperty["DISPLAY_VALUE"])): ?>
                                            <?= implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]); ?>
                                        <? else: ?>
                                            <?= $arProperty["DISPLAY_VALUE"]; ?>
                                        <? endif ?>
                                    </small><br/>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

            <? endforeach; ?>
            </div>
        </div>
    </div>

    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <br/><?= $arResult["NAV_STRING"] ?>
    <? endif; ?>

</section>




