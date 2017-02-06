<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use yii\helpers\ArrayHelper;

$this->title = 'Add New';
$this->params['breadcrumbs'][] = [
    'label' =>'Slide',
    'url' => Yii::$app->homeUrl.'slide-image'
];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::$app->homeUrl."js/index.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->homeUrl."js/post.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->homeUrl."plugins/ckeditor/ckeditor.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);

$token = $this->renderDynamic('return Yii::$app->request->csrfToken;');

$jsx = <<< 'SCRIPT'
    IndexObj.initialScript();
    PostObj.initialScript();
SCRIPT;
$this->registerJs('IndexObj.baseUrl = "'. Yii::$app->homeUrl.'"', \yii\web\View::POS_HEAD);
$this->registerJs('IndexObj.csrfToken = "'. $token.'"',  \yii\web\View::POS_HEAD);
$this->registerJs('PostObj.ckeditor = false',  \yii\web\View::POS_HEAD);
$this->registerJs('PostObj.slide = "postform-post_content"',  \yii\web\View::POS_HEAD);
$this->registerJs($jsx);

?>

<div class="row">
    <div class="col-md-12">
        <?= $this->render('_form_slide', [
            'model' => $model,
            'form_id' => 'form-create-slide',
            'page' => true,
            'button' => 'Save',
        ]) ?>
    </div>
</div>