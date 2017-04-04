<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Tentang Kami';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(Yii::$app->homeUrl."js/template.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Yii::$app->homeUrl.'css/lates_product.css', [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
    //'media' => 'print',
]);
?>
<!-- tes -->
<div class="detail-content">
    <div class="container">
        <div class="site-contact">
            <div class="row">
                <div class="col-lg-9">
                    <div class="content-bottom-right"><h3>Kontak Kami</h3></div>
                     <?php if($_model){ ?>
                        <?=Html::decode($_model['content_desc'], true);?>
                    <?php } else { ?>
                        <p>Empty Content</p>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</div>
