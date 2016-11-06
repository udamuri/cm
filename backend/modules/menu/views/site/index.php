<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\components\Constants;

$this->title = 'Menu';

$this->registerJsFile(Yii::$app->homeUrl."js/index.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->homeUrl."js/menu.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->homeUrl."assets/nestable/jquery.nestable.js", ['depends' => [\yii\web\JqueryAsset::className()] ]);
$this->registerCssFile(Yii::$app->homeUrl."assets/nestable/style.css", ['depends' => [\yii\web\JqueryAsset::className()]]);
$token = $this->renderDynamic('return Yii::$app->request->csrfToken;');

$jsx = <<< 'SCRIPT'
    IndexObj.initialScript();
    MenuObj.initialScript();
SCRIPT;
$this->registerJs('IndexObj.baseUrl = "'. Yii::$app->homeUrl.'"', \yii\web\View::POS_HEAD);
$this->registerJs('IndexObj.csrfToken = "'. $token.'"',  \yii\web\View::POS_HEAD);
$this->registerJs($jsx);


?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ol class="breadcrumb">
          <li><a href="<?=Yii::$app->homeUrl;?>">Home</a></li>
          <li class="active"><?=$this->title;?></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="btn-group" role="group" aria-label="...">
          <button type="button" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Save Change</button>
          <button type="button" class="btn btn-default"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add New Menu</button>
          <button type="button" class="btn btn-default"><i class="fa fa-info" aria-hidden="true"></i>&nbsp;Info</button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?=$menu;?>
        <textarea id="nestable-output" class="hidden"></textarea>
    </div>
</div>
