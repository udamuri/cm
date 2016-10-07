<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\components\Constants;

$this->title = 'Catalog';

$this->registerJsFile(Yii::$app->homeUrl."js/index.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->homeUrl."js/catalog.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->homeUrl."assets/cropit/dist/jquery.cropit.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Yii::$app->homeUrl."assets/cropit/dist/jquery.cropit.css", ['depends' => [\yii\web\JqueryAsset::className()]]);

$token = $this->renderDynamic('return Yii::$app->request->csrfToken;');

$jsx = <<< 'SCRIPT'
    IndexObj.initialScript();
    CatalogObj.initialScript();
SCRIPT;
$this->registerJs('IndexObj.baseUrl = "'. Yii::$app->homeUrl.'"', \yii\web\View::POS_HEAD);
$this->registerJs('IndexObj.csrfToken = "'. $token.'"',  \yii\web\View::POS_HEAD);
$this->registerJs('CatalogObj.type_layer = 2',  \yii\web\View::POS_HEAD);
$this->registerJs($jsx);

?>

<div class="page-title">
    <div class="title_left">
        <h3>

         </h3>
    </div>

    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <form  id="searchform" class="input-group"  action="<?=Yii::$app->homeUrl;?>catalog-category"  method="GET" > 
                <input type="text" name="search" class="form-control" value="<?=$search;?>" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Go!</button>
                </span>
            </form>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?=$this->title;?><small></small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a id="add-new-catalog-category" href="<?=Yii::$app->homeUrl?>create-catalog"><i class="fa fa-plus"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr class="headings">
                            <th width="1%">No</th>
                            <th>Catalog Image</th>
                            <th>Catalog Name</th>
                            <th>Category</th>
                            <th width="8%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $start = (int)$offset * (int)$page;
                            foreach ($models as $model) {
                                $start++;

                                $_b_class = 'btn btn-xs btn-danger status-catalog';
                                $_b_icon = 'fa fa-times-circle';
                                if($model['catalog_status'] == '1')
                                {
                                    $_b_class = 'btn btn-xs btn-primary status-catalog';
                                    $_b_icon = 'fa fa-check-square-o';
                                }
                                echo '<tr class="odd gradeX">
                                        <td>'.$start.'</td>
                                        <td>'.Html::img(Yii::$app->urlManagerFrontEnd->createUrl('//').'product/'.$model['catalog_id'].$model['catalog_image'].'?'.time(), ['id'=> 'catalog-image-'.$model['catalog_id'], 'class'=>'catalog-image-list']).'</td>
                                        <td id="catalog_name_'.$model['catalog_id'].'" >'.$model['catalog_name'].'</td>
                                        <td>'.$model['category_name'].'</td>
                                        <td class="center">
                                            <a id="update-catalog-'.$model['catalog_id'].'" href="'.Yii::$app->homeUrl.'update-catalog/'.$model['catalog_id'].'" class="btn btn-xs btn-success update-obat" ><i class="fa fa-pencil"></i></a>
                                            <a id="status-catalog-'.$model['catalog_id'].'" href="javascript:void(0);" class="'.$_b_class.'" ><i id="icon-status-catalog-'.$model['catalog_id'].'" class="'.$_b_icon.'"></i></a>
                                            <a id="delete-catalog-'.$model['catalog_id'].'" href="'.Yii::$app->homeUrl.'delete-catalog/'.$model['catalog_id'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure you want to delete this item?\');" ><i class="fa fa-trash"></i></a>
                                            <a id="crop-catalog-'.$model['catalog_id'].'" href="javascript:void(0);" class="btn btn-xs btn-warning crop-catalog" ><i class="fa fa-crop"></i></a>
                                        </td>
                                    </tr>';
                            }
                        ?>
                    </tbody>

                </table>
            </div>

            <div align="right">
                <?php
                    //display pagination
                    echo LinkPager::widget([
                        'pagination' => $pages,
                    ]);
                ?>
            </div>

        </div>
    </div>
</div> 

<!-- Modal Picture Crop -->
<div class="modal fade bs-example-modal-lg" id="myModalCrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <b><i class="fa fa-image"></i>&nbsp;Set Thumbnail</b>
      </div>
      <div class="modal-body">
            <p id="cropit-content">
                
            </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="d-id-save-crop-profile-picture" >Save</button>
        <button type="button" class="btn btn-default" id="d-id-upload-crop-profile-picture" >Browse</button>
        <button type="button" class="btn btn-default" id="d-id-close-crop-profile-picture" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Picture Crop -->       