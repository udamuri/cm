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
        if($form_id === 'form-update-catalog')
        {
            $model->catalog_name = $_model['catalog_name'] ;
            $model->catalog_category_id = $_model['catalog_category_id'] ;
            $model->catalog_desc = Html::decode($_model['catalog_desc'], true);
        }
?>
    <?= $form->field($model, 'catalog_name')->textInput(); ?>

    <?=
        $form->field($model, 'catalog_category_id')
             ->dropDownList(
                    ArrayHelper::map($category , 'category_id', 'category_name')
                    );
    ?>

    <?= $form->field($model, 'imageFile')->fileInput(); ?>

    <?= $form->field($model, 'catalog_desc')->textArea(); ?>

    <div class="ln_solid"></div>
    <div class="form-group">
        <?= Html::submitButton($button, ['class' => 'btn btn-primary', 'name' => 'category-button']) ?>
    </div>

<?php ActiveForm::end(); ?>

