<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\TableForum */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
                    'id' => $form_id,
                    //'layout' => 'horizontal',
                ]); 
        if($form_id === 'form-update-setting')
        {
            $model->setting_name = $_model['setting_name'] ;
            $model->setting_content = $_model['setting_content'] ;
        }
?>

    <?= $form->field($model, 'setting_name')->textInput(); ?>

    <?= $form->field($model, 'setting_content')->textArea(); ?>
    <div class="ln_solid"></div>
    <div class="form-group">
        <?= Html::submitButton($button, ['class' => 'btn btn-primary', 'name' => 'push-button']) ?>
    </div>

<?php ActiveForm::end(); ?>

