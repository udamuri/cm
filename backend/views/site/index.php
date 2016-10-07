<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
        <?php if (!\Yii::$app->user->isGuest) { ?>
        <h1>Welcome!</h1>
        <?php } ?>
        <p class="lead">
            <a href="http://darahminang.16mb.com" target="_BLANK">MURI BUDIMAN CMS</a><br/>
            <small>Integrated Continuous Improvement</small> <br/>
            <small>Jl Prof M yamin SH No 04 Bukittinggi Sumatera barat</small> <br/>
            <small>Phone +6283840399512</small> <br/>
            <?//Yii::$app->urlManagerFrontEnd->createUrl('//')?>
        </p>
    </div>

    <div class="body-content">

    </div>
</div>
