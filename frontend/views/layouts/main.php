<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" href="<?=Yii::$app->homeUrl;?>/css/img/icon.jpg?<?=time();?>">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => '<i class="fa fa-home"></i>&nbsp;Dashboard', 'url' => ['/dashboard']],
    ];
   
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $menuItems,
        'encodeLabels' => false ,
    ]);
    NavBar::end();
    ?>
</div>

<footer class="footer">
    <div class="container">            
        <div class="">
            <p class="pull-left">&copy;  <?= Yii::$app->name.' '.Yii::$app->mycomponent->getCopy(2015); ?></p>
            <p class="pull-right">
                <a href="#" target="_BLANK" ><i class="fa fa-facebook-official"></i></a>
                <a href="#" target="_BLANK"><i class="fa fa-twitter-square"></i></a>
                <a href="" target="_BLANK"><i class="fa fa-instagram"></i></a>
            </p>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
