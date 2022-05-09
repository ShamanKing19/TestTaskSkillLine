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

<section class="page-selection" id="about"></section>
<div class="container">
    <div class="text-center">
        <h2 class="section-heading text-uppercase">About us</h2>
    </div>

    <ul class="news-list timeline">
        <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
            <?= $arResult["NAV_STRING"] ?><br/>
        <? endif; ?>
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <li id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="timeline-image">
                    <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                        <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                            <!-- <a href="--><?//= $arItem["DETAIL_PAGE_URL"] ?><!--">-->
                                <img
                                        class="rounded-circle img-fluid"
                                        border="0"
                                        src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                        width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                        height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                        alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                        title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                                />
<!--                            </a>-->
                        <? else: ?>
                            <img
                                    class="preview_picture"
                                    border="0"
                                    src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                    width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                    height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                    alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                    title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                            />
                        <? endif; ?>
                    <? endif ?>
                </div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                            <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                                <!--<a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>">--><b><? echo $arItem["NAME"] ?></b><!--</a>--><br/>
                            <? else: ?>
                                <b><? echo $arItem["NAME"] ?></b><br/>
                            <? endif; ?>
                        <? endif; ?>
                    </div>
                    <div class="timeline-body">
                        <p class="text-muted">
                            <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                                <? echo $arItem["PREVIEW_TEXT"]; ?>
                            <? endif; ?>
                            <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                        <div style="clear:both"></div>
                        <? endif ?>
                        <? foreach ($arItem["FIELDS"] as $code => $value): ?>
                            <small>
                                <?= GetMessage("IBLOCK_FIELD_" . $code) ?>:&nbsp;<?= $value; ?>
                            </small><br/>
                        <? endforeach; ?>
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
                        </p>
                    </div>
                </div>
            </li>
        <? endforeach; ?>
        <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
            <br/><?= $arResult["NAV_STRING"] ?>
        <? endif; ?>
        <li class="timeline-inverted">
            <div class="timeline-image">
                <h4>
                    Be Part
                    <br>
                    Of Our
                    <br>
                    Story!
                </h4>
            </div>
        </li>
    </ul>
</div>