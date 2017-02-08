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
                $model->post_id = 0 ;
                if($form_id === 'form-update-slide')
                {
                    $model->post_id = $_model['post_id'] ;
                    $model->post_title = $_model['post_title'] ;
                    $model->post_url_alias = $_model['post_url_alias'] ;
                    $model->post_content = $_model['post_content'] ;
                    $model->post_excerpt = $_model['post_excerpt'] ;
                    $model->post_status = $_model['post_status'] ;
                    $model->post_category_id = $_model['post_category_id'] ;
                }

        ?>
            <div class="row">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <?=$form->field($model, 'post_id',['options' => ['value'=> 0] ])->hiddenInput()->label(false);?>
                    <?= $form->field($model, 'post_title')->textInput(); ?>

                    <?= $form->field($model, 'post_url_alias')->textInput(); ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <?php 
                                $col_md = 'col-md-6';
                                if(isset($page) && $page == true)
                                {
                                    $col_md = 'col-md-12';
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
                        </div>
                        <div class="<?=$col_md;?>">
                            <?= $form->field($model, 'post_status')->dropDownList(
                                [
                                    ''=> '',
                                    0=> 'Inactive',
                                    1=> 'Active',
                                    2=> 'Draft',
                                ]
                            ); ?>
                        </div>
                    </div>
                    <?= $form->field($model, 'post_excerpt')->textArea(); ?>

                    <div>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModalFile"><i class="fa fa-file-image-o" aria-hidden="true"></i> Add Media</button>
                    </div>
                    <?= $form->field($model, 'post_content')->textArea()->label('Image URL'); ?>
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
  <div class="modal-dialog modal-xlg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">File</h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    
                </div>
            </div>
            <div id="file-content" class="row">                     
            </div>
            <div class="row">
                <div id="file-pagination" class="col-md-12 text-center">
                        
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
  </div>
</div>


