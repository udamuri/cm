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
        if($form_id === 'form-update-content')
        {
            $model->content_label = $_model['content_label'] ;
            $model->content_category_id = $_model['content_category_id'] ;
            $model->content_meta_keyword = $_model['content_meta_keyword'] ;
            $model->content_meta_desc = $_model['content_meta_desc'] ;
            $model->content_desc = Html::decode($_model['content_desc'], true);
        }

?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'content_label')->textInput(); ?>

            <?=
                $form->field($model, 'content_category_id')
                     ->dropDownList(
                            ArrayHelper::map($category , 'cat_id', 'cat_name')
                            );
            ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'content_meta_keyword')->textInput()->label('Meta Keyword (bukittinggi, arsyicom, cctv)'); ?>

            <?= $form->field($model, 'content_meta_desc')->textInput(); ?>
        </div>
    </div>

    <?= $form->field($model, 'content_desc')->textArea(); ?>

    <div class="ln_solid"></div>
    <div class="form-group">
        <?= Html::submitButton($button, ['class' => 'btn btn-primary', 'name' => 'category-button']) ?>
    </div>

<?php ActiveForm::end(); ?>

