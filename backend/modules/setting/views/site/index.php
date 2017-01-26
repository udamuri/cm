<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use app\components\Constants;

$this->title = 'Web Setting';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::$app->homeUrl."js/index.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->homeUrl."js/setting.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->homeUrl."plugins/ckeditor/ckeditor.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$token = $this->renderDynamic('return Yii::$app->request->csrfToken;');

$jsx = <<< 'SCRIPT'
    IndexObj.initialScript();
    SettingObj.initialScript();
SCRIPT;
$this->registerJs('IndexObj.baseUrl = "'. Yii::$app->homeUrl.'"', \yii\web\View::POS_HEAD);
$this->registerJs('IndexObj.csrfToken = "'. $token.'"',  \yii\web\View::POS_HEAD);
$this->registerJs($jsx);
$ss = $socialmediaSetting;
$gs = $generalSetting;
?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php $form = ActiveForm::begin([
                    'id' => "form-update-setting",
                    //'options' => ['class' => 'form-horizontal form-label-left'],
                ]); 
    ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>General Setting</h2>
            </div>
            <div class="panel-body">
                <?php
                    if($gs)
                    {
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
                    }
                ?>
            </div>
        </div>

        <?php if($ss) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Socialmedia Setting</h2>
            </div>
            <div class="panel-body">
                <?php
                    if($ss)
                    {
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