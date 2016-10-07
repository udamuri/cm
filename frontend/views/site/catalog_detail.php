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
        $datarand .= '<div class="col-sm-6 col-xs-12">
                        <div class="col-item">
                            <div class="photo">
                                <div class="photo-respon">
                                    <img src="'.Yii::$app->mycomponent->catalogImage($value['catalog_id'], $value['catalog_image']).'" class="img-responsive" alt="a" />
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="collabel-hover" >
                                <a href="'.Yii::$app->homeUrl.'katalog-detail/'.$value['catalog_id'].'/'.Yii::$app->mycomponent->toAscii($value['catalog_name']).'" data-toggle="tooltip" data-placement="top" title="'.$value['catalog_name'].'" > '.Yii::$app->mycomponent->cutLabel($value['catalog_name'], 9).'</a>
                            </div>
                        </div>
                    </div>';
    }
        
}

?>
<div class="detail-content">
    <div class="container">
    	<div class="col-lg-9">
            <div class="content-bottom-right"><h3><a href="<?=Yii::$app->homeUrl;?>">Home</a>/Detail</h3></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="col-item">
                        <div class="photo">
                            <div class="photo-respon">
                                <img src="<?=Yii::$app->mycomponent->catalogImage($detal_atalog['catalog_id'], $detal_atalog['catalog_image']);?>" class="img-responsive" alt="a" />
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
		        	<h3><?=$detal_atalog['catalog_name'];?></h3>
		        	<div class="detail-desc"> 
		        		<h4>Hubungi Kami</h4>
		        		<p class="font-10"><?=Yii::$app->mycomponent->getSetting(1);?></p>
                		<p class="font-10"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;<?=Yii::$app->mycomponent->getSetting(2);?>&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;<?=Yii::$app->mycomponent->getSetting(3);?></p>
		        	</div>
		   		</div>

		   		<div class="clearfix"></div>

		   		<div class="col-lg-12">
		   			<ul class="nav nav-tabs">
					  <li class="active"><a data-toggle="tab" href="#home">Deskripsi Produk</a></li>
					</ul>

					<div class="tab-content detail-desc">
					  <div id="home" class="tab-pane fade in active">
					    <h3>Detail&nbsp;<?=$detal_atalog['catalog_name'];?></h3>
					   	<?=Html::decode($detal_atalog['catalog_desc'], true);?>
					  </div>
					</div> 
		   		</div>
            </div>
            <br>
            <div class="clearfix"></div>
        </div>

        <div class="col-lg-3">
        	<div class="content-bottom-right"><h3>Katalog Lainnya</h3></div>
	        <div class="row">
	        	<?=$datarand;?>
	   		</div>
   		</div>
    </div>
</div>