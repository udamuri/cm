<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\components\Constants;

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
$this->registerJsFile(Yii::$app->homeUrl."js/template.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Yii::$app->homeUrl.'css/lates_product.css', [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
    //'media' => 'print',
]);

$jsx = <<< 'SCRIPT'
    TemplateObj.initialScript();
SCRIPT;
$this->registerJs('TemplateObj.baseUrl = "'. Yii::$app->homeUrl.'"');
$this->registerJs($jsx);

?>
<div class="main-product">
    <div class="container">
            
    </div>
</div>
