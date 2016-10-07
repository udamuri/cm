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
                ]); 
        if($form_id === 'form-update-category')
        {
            $model->cat_name = $_model['cat_name'] ;
        }
?>
    <?= $form->field($model, 'cat_name')->textInput(); ?>
    <div class="ln_solid"></div>
    <div class="form-group">
        <?= Html::submitButton($button, ['class' => 'btn btn-primary', 'name' => 'category-button']) ?>
    </div>

<?php ActiveForm::end(); ?>

