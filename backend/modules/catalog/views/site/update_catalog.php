<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use yii\helpers\ArrayHelper;

$this->title = 'Update Catalog';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs']['active'] = 'catalog';

$this->registerJsFile(Yii::$app->homeUrl."js/index.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->homeUrl."js/catalog.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->homeUrl."assets/ckeditor/ckeditor.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->homeUrl."assets/ckeditor/adapters/jquery.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->homeUrl."assets/bootstrap-chosen/chosen.jquery.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerCssFile(Yii::$app->homeUrl."assets/bootstrap-chosen/bootstrap-chosen.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()], ]);

$token = $this->renderDynamic('return Yii::$app->request->csrfToken;');

$jsx = <<< 'SCRIPT'
    IndexObj.initialScript();
    CatalogObj.initialScript();
SCRIPT;
$this->registerJs('IndexObj.baseUrl = "'. Yii::$app->homeUrl.'"', \yii\web\View::POS_HEAD);
$this->registerJs('IndexObj.csrfToken = "'. $token.'"',  \yii\web\View::POS_HEAD);
$this->registerJs('CatalogObj.type_layer = 1',  \yii\web\View::POS_HEAD);
$this->registerJs($jsx);

?>

<!-- tesssssssssssssssssssssssss -->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><?=Html::encode($this->title);?> <small>different form elements</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a href="<?=Yii::$app->homeUrl?>catalog"><i class="fa fa-chevron-left"></i></a></li>
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br />
            <?= $this->render('_catalog_form', [
                    'category' => $category ,
                    '_model' => $_model ,
                    'model' => $model,
                    'form_id' => 'form-update-catalog',
                    'button' => 'Update Catalog',
                ]) ?>
        </div>
    </div>
</div>
