<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\TableForum */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <?php $form = ActiveForm::begin([
                            'id' => $form_id,
                            'options' => ['enctype' => 'multipart/form-data']
                            //'layout' => 'horizontal',
                        ]); 
                if($form_id === 'form-update-menu')
                {
                    $model->menu_title = $_model['menu_title'] ;
                    $model->menu_link = $_model['menu_link'] ;
                }

        ?>

                <?= $form->field($model, 'menu_title')->textInput(); ?>
                <?= $form->field($model, 'menu_link')->dropDownList(ArrayHelper::map($ymodel, 'value', 'label')); ?>

                <div class="form-group">
                    <?= Html::submitButton($button, ['class' => 'btn btn-primary', 'name' => 'category-button']) ?>
                </div>

        <?php ActiveForm::end(); ?> 
    </div>
</div>


