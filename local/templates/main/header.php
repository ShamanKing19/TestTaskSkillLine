<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php use Bitrix\Main\Page\Asset; ?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link rel="icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH ?>/assets/favicon.ico" />

    <?php
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/styles.css');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/scripts.js');
    Asset::getInstance()->addString('<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />');
    Asset::getInstance()->addString('<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />');
    Asset::getInstance()->addString('<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>');
    Asset::getInstance()->addString('<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>');
    Asset::getInstance()->addString('<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>');
    ?>

    <?php $APPLICATION->ShowHead(); ?>
</head>

<body>
    <div id="panel">
        <?php $APPLICATION->Showpanel(); ?>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top"><img src="<?=SITE_TEMPLATE_PATH ?>/assets/img/navbar-logo.svg" alt="..." /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#news">News</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
                </ul>
            </div>
        </div>
    </nav>
</body>