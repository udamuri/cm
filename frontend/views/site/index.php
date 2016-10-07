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

$datarand = '';
if($catalog_rand)
{
    $i = 0;
    foreach ($catalog_rand as $value) {
        $datarand .= '<div class="col-sm-3 col-xs-12">
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

$clientrand = '';
if($client_rand)
{
    foreach ($client_rand as $value) {
        $clientrand .= '<div class="col-sm-2 col-xs-12">
                        <div class="col-item">
                            <div class="photo">
                                <div class="photo-respon">
                                    <img src="'.Yii::$app->mycomponent->clientImage($value['client_id'], $value['client_image']).'" class="img-responsive" alt="a" />
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="collabel-hover" >
                                <a href="#" data-toggle="tooltip" data-placement="top" title="'.$value['client_name'].'" > '.Yii::$app->mycomponent->cutLabel($value['client_name'], 10).'</a>
                            </div>
                        </div>
                    </div>';
    }
}
?>
<div class="arsyicom-header">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-xs-10">
                <br>
                <h1 class="main-color">Selamat Datang di <?=Yii::$app->name;?></h1>
                <p class="main-color">Bukittinggi, Sumatera Barat, Indonesia</p>
                <p class="font-10 secont-color"><?=Yii::$app->mycomponent->getSetting(1);?></p>
                <p class="font-10 secont-color"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;<?=Yii::$app->mycomponent->getSetting(2);?>&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;<?=Yii::$app->mycomponent->getSetting(3);?></p>
            </div>

            <div class="col-md-4 col-xs-2">
                <div id="carbonads-1">
                    <br>
                    <?= Html::img('@web/css/img/slider-img.png', ['class' => 'img-responsive']) ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <?= $this->render('lates', ['catalog_new' => $catalog_new]) ?>
</div>

<div class="main-product">
    <div class="container">
        <div class="body-content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories">
                       <ul>
                            <h3>Kategori</h3>
                            <?php
                                echo '<li><a href="'.Yii::$app->homeUrl.'katalog/0/0/0/semua-kategori">Semua Kategori</a></li>';
                                foreach ($catalog_cat as $value) {
                                    echo '<li><a href="'.Yii::$app->homeUrl.'katalog/'.$value['category_id'].'/0/0/'.Yii::$app->mycomponent->toAscii($value['category_name']).'">'.$value['category_name'].'</a></li>';
                                }
                            ?>        
                         </ul>
                    </div>      
                </div>

                <div class="col-lg-9">
                    <div class="content-bottom-right"><h3>Katalog</h3></div>
                    <div class="row">
                        <?=$datarand;?>
                    </div>
                    <br><br>
                    <div class="clearfix"></div>
                    <div class="content-bottom-right"><h3>Klien Kami</h3></div>
                    
                    <div class="row">
                        <?=$clientrand;?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
    </div>
</div>
