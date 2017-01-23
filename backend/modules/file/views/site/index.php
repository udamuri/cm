<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\components\Constants;
use yii\widgets\ActiveForm;

$this->title = 'Media Library';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::$app->homeUrl."js/index.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->homeUrl."js/file.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$token = $this->renderDynamic('return Yii::$app->request->csrfToken;');

$jsx = <<< 'SCRIPT'
    IndexObj.initialScript();
    FileObj.initialScript();
SCRIPT;
$this->registerJs('IndexObj.baseUrl = "'. Yii::$app->homeUrl.'"', \yii\web\View::POS_HEAD);
$this->registerJs('IndexObj.csrfToken = "'. $token.'"',  \yii\web\View::POS_HEAD);
$this->registerJs($jsx);


?>
<!-- form upload -->

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class'=>'hidden']]) ?>

    <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <button id="upload-image" type="submit">Submit</button>

<?php ActiveForm::end() ?>
<!-- END form upload -->

<div class="row">
    <div class="col-md-8 col-sm-12 col-xs-12">
        <button id="upload-image-frontend" class="btn btn-primary">Upload</button>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
        <form  id="searchform" class="input-group"  action="<?=Yii::$app->homeUrl;?>file-manager"  method="GET" > 
            <input type="text" name="search" class="form-control" value="<?=$search;?>" placeholder="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Go!</button>
            </span>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <hr class="row-header">
    </div>
</div>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr class="bg-primary">
                  <td width="3%">No.</td>
                  <td>File Name</td>
                  <td>Folder</td>
                  <td>File Type</td>
                  <td>File Size</td>
                  <td width="5%">Action</td>
              </tr>
            </thead>
            <tbody>
            <?php
                $start = (int)$offset * (int)$page;
                foreach ($models as $value) {
                    $start++;
                    $url = Yii::$app->mycomponent->getImage($value['file_id'].'_thumb.'.$value['file_extension'], $value['file_folder']);
                    $img = '';
                    //if($url){ 
                        //$img = '<img src="'.$url.'" class="img-thumbnail" title="'.$value['file_name'].'" alt="'.$value['file_name'].'" >';
                    //}
                    echo '<tr>
                        <td>'.$start.'</td>
                        <td>'.$value['file_name'].'</td>
                        <td>'.$value['file_folder'].'</td>
                        <td>'.$value['file_type'].'</td>
                        <td>'.$value['file_size'].'kb</td>
                        <td><button class="btn btn-danger btn-xs delete_file" data-id="'.$value['file_id'].'"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></td>
                    <tr>';
                    //print_r($value);
                }
            ?>
            </tbody>
          </table>
      </div>
    </div>
</div> 

<div class="row">
    <div class="col-md-12">
        <div class="text-center">
          <?php
              //display pagination
              echo LinkPager::widget([
                  'pagination' => $pages,
              ]);
          ?>
        </div>
    </div>
</div>     
