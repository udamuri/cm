<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\TableCategory;
/* @var $this yii\web\View */
/* @var $model frontend\models\TableForum */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php $form = ActiveForm::begin([
                            'id' => $form_id,
                        ]); 
                if($form_id === 'form-update-post')
                {
                    $model->post_title = $_model['post_title'] ;
                }

        ?>
            <div class="row">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'post_title')->textInput(); ?>
                    
                    <?php $dataList = ArrayHelper::map(TableCategory::find()->all(), 'category_id', 'category_name'); ?>
                    <?= $form->field($model, 'post_category_id')->dropDownList(
                        $dataList
                    ); ?>

                    <?= $form->field($model, 'post_status')->dropDownList(
                        [
                            ''=> '',
                            0=> 'Inactive',
                            1=> 'Active',
                            2=> 'Draft',
                        ]
                    ); ?>

                    <?= $form->field($model, 'post_content')->textArea(); ?>
                </div>

                 <div class="col-md-4 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'meta_title')->textInput(['placeholder'=>'maximum of 60 chars for the title.']); ?>

                    <?= $form->field($model, 'meta_keywords')->textArea(['placeholder'=>'Meta Keywords (comma separated)']); ?>

                    <?= $form->field($model, 'meta_description')->textArea(['placeholder'=>'characters. Most search engines use a maximum of 255 chars for the description.']); ?>

                    <?= $form->field($model, 'meta_tags')->textArea(['placeholder'=>'#bukittinggi#jakarta#yogyakarta#framework']); ?>
                 </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <hr class="row-header">
                    <div class="form-group">
                        <?= Html::submitButton($button, ['class' => 'btn btn-primary', 'name' => 'category-button']) ?>
                    </div>
                </div>
            </div>

        <?php ActiveForm::end(); ?>   
    </div>
</div>


