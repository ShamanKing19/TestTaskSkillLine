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

<section class="page-section" id="team">
    <div class="news-list container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Наш коллектив</h2>
        </div>

        <div class="row">
            <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
                <?= $arResult["NAV_STRING"] ?><br/>
            <? endif; ?>
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="col-lg-4">
                <div class="team-member" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                        <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
<!--                            <a href="--><?//= $arItem["DETAIL_PAGE_URL"] ?><!--">-->
                                <img
                                        class="mx-auto rounded-circle"
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
                                    class="mx-auto rounded-circle"
                                    border="0"
                                    src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                    width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                    height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                    alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                    title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                            />
                        <? endif; ?>
                    <? endif ?>

                    <h4>
                        <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                            <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                                <!--<a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"> --><b><? echo $arItem["NAME"] ?></b><!--</a>-->
                                <br/>
                            <? else: ?>
                                <b><? echo $arItem["NAME"] ?></b><br/>
                            <? endif; ?>
                        <? endif; ?>
                    </h4>

                    <p class="text-muted">
                        <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                            <? echo $arItem["PREVIEW_TEXT"]; ?>
                        <? endif; ?>

                        <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                        <? endif ?>
                        <? foreach ($arItem["FIELDS"] as $code => $value): ?>
                            <small>
                                <?= GetMessage("IBLOCK_FIELD_" . $code) ?>:&nbsp;<?= $value; ?>
                            </small><br/>
                        <? endforeach; ?>
                    </p>

                    <!-- TODO: Тут надо находить подстроку в строке и подставлять соответствующую иконку -->
                    <p class="text-muted">
                        <? foreach ($arItem["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>
                                <? if (is_array($arProperty["DISPLAY_VALUE"])): ?>
                                    <?= implode("&nbsp;/&nbsp;", $arProperty["VALUE"]); ?>
                                <? else: ?>
                                    <a class="btn btn-dark btn-social mx-2" href="<?= $arProperty["VALUE"]; ?>" aria-label="Parveen Anand Twitter Profile">
                                        <i class="fa-solid fa-hashtag"></i>
                                    </a>
                                <? endif ?>
                        <? endforeach; ?>
                    </p>
                </div>

            </div>
            <? endforeach; ?>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto text-center"><p class="large text-muted">Lorem ipsum dolor sit amet,
                    consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam
                    corporis ea, alias ut unde.</p></div>
        </div>
    </div>
</section>
