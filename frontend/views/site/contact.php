<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Kontak';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(Yii::$app->homeUrl."js/template.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Yii::$app->homeUrl.'css/lates_product.css', [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
    //'media' => 'print',
]);
?>
<div class="detail-content">
    <div class="container">
        <div class="site-contact">
            <div class="row">
                <div class="col-lg-6">
                    <div class="content-bottom-right"><h3>Kontak Kami</h3></div>
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                        <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Nama Lengkap'); ?>

                        <?= $form->field($model, 'email')->label('Alamat Email'); ?>

                        <?= $form->field($model, 'subject')->label('Subjek'); ?>

                        <?= $form->field($model, 'body')->textarea(['rows' => 6])->label('Pesan'); ?>

                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                        ]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
    </div>
</div>
