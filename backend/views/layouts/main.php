<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@backend/views/layouts');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?=Yii::$app->homeUrl;?>img/icon.png?<?=time();?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="nav-md">
    <?php $this->beginBody() ?>
        <div class="container body">
            <div class="main_container">
                <?= $this->render(
                    'header.php',
                    ['directoryAsset' => $directoryAsset]
                )
                ?>
                <div class="right_col" role="main">
                    <br />
                    <div class="">
                        <?//Alert::widget() ?>
                        <?= $content ?>
                    </div>
                    <!-- footer content -->
                    <!--<footer>
                        <div class="">
                            <p class="pull-right">Gentelella Alela! a Bootstrap 3 template by <a>Kimlabs</a>. |
                                <span class="lead"> <i class="fa fa-paw"></i> Gentelella Alela!</span>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </footer> -->
                    <!-- /footer content -->
                </div>
            </div>
        </div>
        <div id="content-all-alert"></div>
        
        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>

    <div id="content-all-alert">
        <!--<div class="default-alert alert-global-content">
            <div class="close-alert-button"><i class="fa fa-times"></i></div>
            <div class="clearfix"></div>
            <div>Lorem Ipsum Dolor Sit Amet Adalah</div>
        </div>
        <div class="success-alert alert-global-content">Tes</div>
        <div class="info-alert alert-global-content">Tes</div>
        <div class="warning-alert alert-global-content">Tes</div>
        <div class="danger-alert alert-global-content">Tes</div>-->
    </div>
        
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
