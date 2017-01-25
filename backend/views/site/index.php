<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
        <?php if (!\Yii::$app->user->isGuest) { ?>
        <h1>Welcome!</h1>
        <?php } ?>
        <p class="lead">
            <!-- <a href="http://darahminang.16mb.com" target="_BLANK">MURI BUDIMAN CMS</a><br/>
            <small>Integrated Continuous Improvement</small> <br/>
            <small>Jl Prof M yamin SH No 04 Bukittinggi Sumatera barat</small> <br/>
            <small>Phone +6283840399512</small> <br/>--->
            <!-- Yii::$app->urlManagerFrontEnd->createUrl('//') -->
        </p>
    </div>
</div>

<div class="row">
	<div class="col-md-4 text-center"></div>
	<div class="col-md-4 text-center">
		<!--<?// Html::img('css/img/logo.png', ['class'=>'img-responsive']);?>-->
	</div>
	<div class="col-md-4 text-center"></div>
</div>
