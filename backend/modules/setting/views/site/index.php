<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use app\components\Constants;

$this->title = 'Web Setting';

$this->registerJsFile(Yii::$app->homeUrl."js/index.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);

$token = $this->renderDynamic('return Yii::$app->request->csrfToken;');

$jsx = <<< 'SCRIPT'
    IndexObj.initialScript();
SCRIPT;
$this->registerJs('IndexObj.baseUrl = "'. Yii::$app->homeUrl.'"', \yii\web\View::POS_HEAD);
$this->registerJs('IndexObj.csrfToken = "'. $token.'"',  \yii\web\View::POS_HEAD);
$this->registerJs($jsx);
$ss = $socialmediaSetting;
$gs = $generalSetting;
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
    <?php $form = ActiveForm::begin([
                    'id' => "form-update-setting",
                ]); 
    ?>


        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">General Setting</h3>
            </div>
            <div class="panel-body">
                <?php
                    foreach ($gs as $value) 
                    {
                        echo $form->field($model, 'option_id['.$value['option_id'].']')->hiddenInput(['value'=>$value['option_id']])->label(false);
                        if($value['option_autoload'] == 'textarea')
                        {
                            echo $form->field($model, 'option_value['.$value['option_id'].']')->textArea(['value'=> $value['option_value']])->label($value['option_label']);
                        }
                        else if($value['option_autoload'] == 'password')
                        {
                            echo $form->field($model, 'option_value['.$value['option_id'].']')->passwordInput(['value'=> $value['option_value']])->label($value['option_label']);
                        }
                        else
                        {
                            echo $form->field($model, 'option_value['.$value['option_id'].']')->textInput(['value'=> $value['option_value']])->label($value['option_label']);
                        }
                    }
                ?>
            </div>
        </div>

        <?php if($ss) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Socialmedia Setting</h3>
            </div>
            <div class="panel-body">
                <?php
                    foreach ($ss as $value) 
                    {
                        echo $form->field($model, 'option_id['.$value['option_id'].']')->hiddenInput(['value'=>$value['option_id']])->label(false);
                        if($value['option_autoload'] == 'textarea')
                        {
                            echo $form->field($model, 'option_value['.$value['option_id'].']')->textArea(['value'=> $value['option_value']])->label($value['option_label']);
                        }
                        else if($value['option_autoload'] == 'password')
                        {
                            echo $form->field($model, 'option_value['.$value['option_id'].']')->passwordInput(['value'=> $value['option_value']])->label($value['option_label']);
                        }
                        else
                        {
                            echo $form->field($model, 'option_value['.$value['option_id'].']')->textInput(['value'=> $value['option_value']])->label($value['option_label']);
                        }
                    }
                ?>
            </div>
        </div>
        <?php } ?>

        <div class="form-group">
            <?= Html::submitButton('Save Change', ['class' => 'btn btn-primary', 'name' => 'category-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>         