<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\components\Constants;

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
$this->registerJsFile(Yii::$app->homeUrl."js/template.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Yii::$app->homeUrl.'css/lates_product.css', [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
    //'media' => 'print',
]);

$jsx = <<< 'SCRIPT'
    TemplateObj.initialScript();
SCRIPT;
$this->registerJs('TemplateObj.baseUrl = "'. Yii::$app->homeUrl.'"');
$this->registerJs($jsx);

?>
<div class="detail-content">
    <div class="container">
        <div class="body-content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories">
                       <ul>
                            <h3>Kategori</h3>
                            <?php
                                $label_cat = 'Semua Kategori';
                                $active_1 =  $_kategori == 0 ? 'active':'';
                                echo '<li><a href="'.Yii::$app->homeUrl.'katalog/0/0/0/semua-kategori" class="'.$active_1.'" >Semua Kategori</a></li>';
                                foreach ($catalog_cat as $key=>$value) {
                                    $active = '';
                                    if($_kategori == $value['category_id'])
                                    {
                                        $active = 'active';
                                        $label_cat = $value['category_name'];
                                    }
                                    echo '<li><a href="'.Yii::$app->homeUrl.'katalog/'.$value['category_id'].'/0/0/'.Yii::$app->mycomponent->toAscii($value['category_name']).'" class="'.$active.'" >'.$value['category_name'].'</a></li>';
                                }
                            ?>        
                         </ul>
                    </div>      
                </div>

                <div class="col-lg-9">
                    <div class="content-bottom-right"><h3>Katalog / <?=$label_cat;?></h3></div>
                    <div class="row">
                         <?php
                            if(count($models) > 0)
                            {
                                foreach ($models as  $value) {
                                    echo '<div class="col-sm-3 col-xs-12">
                                            <div class="col-item">
                                                <div class="photo">
                                                    <div class="photo-respon">
                                                        <img src="'.Yii::$app->mycomponent->catalogImage($value['catalog_id'], $value['catalog_image']).'" class="img-responsive" alt="a" />
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="collabel-hover" >
                                                    <a href="'.Yii::$app->homeUrl.'katalog-detail/'.$value['catalog_id'].'/'.Yii::$app->mycomponent->toAscii($value['catalog_name']).'" data-toggle="tooltip" data-placement="top" title="'.$value['catalog_name'].'" > '.Yii::$app->mycomponent->cutLabel($value['catalog_name'], 15).'</a>
                                                </div>
                                            </div>
                                        </div>';
                                }
                            }
                            else
                            {
                                echo '<div class="col-xs-12 col-lg-12">
                                          <h4>Empty Thread</h4>
                                          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                                          <div class="clearfix"></div>
                                          <hr/>
                                        </div>';
                            }
                        ?>

                        <div class="clearfix"></div>
                        <div align="right">
                            <?php
                                  //display pagination
                                echo LinkPager::widget([
                                    'pagination' => $pages,
                                ]);
                            ?>
                        </div>
                    </div>
                    <br><br>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
    </div>
</div>