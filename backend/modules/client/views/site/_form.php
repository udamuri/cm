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
                    'options' => ['enctype' => 'multipart/form-data']
                    //'layout' => 'horizontal',
                ]); 
        if($form_id === 'form-update-client')
        {
            $model->client_name = $_model['client_name'] ;
            $model->client_desc = Html::decode($_model['client_desc'], true);
        }
?>
    <?= $form->field($model, 'client_name')->textInput(); ?>

    <?= $form->field($model, 'imageFile')->fileInput(); ?>

    <?= $form->field($model, 'client_desc')->textArea(); ?>

    <div class="ln_solid"></div>
    <div class="form-group">
        <?= Html::submitButton($button, ['class' => 'btn btn-primary', 'name' => 'category-button']) ?>
    </div>

<?php ActiveForm::end(); ?>

