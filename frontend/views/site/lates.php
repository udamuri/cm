<?php

$data1 = '';
$data2 = '';
if($catalog_new)
{
    $i = 0;
    foreach ($catalog_new as $value) {
        $i++;
        if($i < 5)
        {
            $data1 .= '<div class="col-sm-3 col-xs-12">
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
        else
        {
            $data2 .= '<div class="col-sm-3 col-xs-12">
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
}

?>
<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-9">
                <h4 class="main-color">Produk Terbaru</h4>
            </div>
            <div class="col-md-3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs">
                    <a class="left fa fa-chevron-left  btn-orange" href="#carousel-example" data-slide="prev"></a>
                    <a class="right fa fa-chevron-right  btn-orange" href="#carousel-example" data-slide="next"></a>
                </div>
            </div>
        </div>
        <!--<div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">-->
        <div id="carousel-example" class="carousel slide " data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <?=$data1;?>
                    </div>
                </div>
                <div class="item">
                    <div class="row">
                         <?=$data2;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>