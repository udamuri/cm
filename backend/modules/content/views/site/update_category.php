<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use yii\helpers\ArrayHelper;

$this->title = 'Update Category';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs']['active'] = 'setiing';

$this->registerJsFile(Yii::$app->homeUrl."js/index.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);

$token = $this->renderDynamic('return Yii::$app->request->csrfToken;');

$jsx = <<< 'SCRIPT'
    IndexObj.initialScript();
SCRIPT;
$this->registerJs('IndexObj.baseUrl = "'. Yii::$app->homeUrl.'"', \yii\web\View::POS_HEAD);
$this->registerJs('IndexObj.csrfToken = "'. $token.'"',  \yii\web\View::POS_HEAD);
$this->registerJs($jsx);

?>

<!-- tesssssssssssssssssssssssss -->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><?=Html::encode($this->title);?> <small>different form elements</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a href="<?=Yii::$app->homeUrl?>catalog-category"><i class="fa fa-chevron-left"></i></a></li>
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br />
            <?= $this->render('_category_form', [
                    'model' => $model,
                    '_model' => $_model,
                    'form_id' => 'form-update-category',
                    'button' => 'Update Category',
                ]) ?>
        </div>
    </div>
</div>
