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
                    $model->post_content = $_model['post_content'] ;
                    $model->post_excerpt = $_model['post_excerpt'] ;
                    $model->post_status = $_model['post_status'] ;
                    $model->post_category_id = $_model['post_category_id'] ;
                    if(isset($_model['post_meta']) && is_array($_model['post_meta']))
                    {
                        foreach ($_model['post_meta'] as $value) {
                            if($value['meta_key'] === '_meta_title')
                            {
                              $model->meta_title = $value['meta_value'] ;
                            }

                            if($value['meta_key'] === '_meta_keywords')
                            {
                              $model->meta_keywords = $value['meta_value'] ;
                            }

                            if($value['meta_key'] === '_meta_description')
                            {
                              $model->meta_description = $value['meta_value'] ;
                            }

                            if($value['meta_key'] === '_meta_tags')
                            {
                              $model->meta_tags = $value['meta_value'] ;
                            }
                        }
                    }
                }

        ?>
            <div class="row">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'post_title')->textInput(); ?>
                    
                    <?php 
                        if(isset($page) && $page == true)
                        {
                            echo $form->field($model, 'post_category_id',['options' => ['value'=> 0] ])->hiddenInput()->label(false);
                        }
                        else
                        {
                            $dataList = ArrayHelper::map(TableCategory::find()->all(), 'category_id', 'category_name'); 
                            $arrEmpty = ['0'=>'--General--'];
                            $array_merge = array_merge($arrEmpty, $dataList);
                            echo $form->field($model, 'post_category_id')->dropDownList($array_merge);
                        }
                    ?>

                    <?= $form->field($model, 'post_status')->dropDownList(
                        [
                            ''=> '',
                            0=> 'Inactive',
                            1=> 'Active',
                            2=> 'Draft',
                        ]
                    ); ?>
                    <?= $form->field($model, 'post_excerpt')->textArea(); ?>

                    <div>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModalFile">Add Media</button>
                    </div>
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

<div id="myModalFile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">File</h4>
        </div>

        <div class="modal-body">
            <p>One fine body&hellip;</p>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
  </div>
</div>


