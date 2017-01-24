<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use yii\helpers\ArrayHelper;

$this->title = 'Update';
$this->params['breadcrumbs'][] = [
    'label' =>'Page',
    'url' => Yii::$app->homeUrl.'posts'
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
$this->registerJs('PostObj.ckeditor = "postform-post_content"',  \yii\web\View::POS_HEAD);
$this->registerJs($jsx);

?>

<div class="row">
    <div class="col-md-12">
        <?= $this->render('_form', [
            '_model' => $_model,
            'model' => $model,
            'form_id' => 'form-update-post',
            'page' => true,
            'button' => 'Save Change',
        ]) ?>
    </div>
</div>