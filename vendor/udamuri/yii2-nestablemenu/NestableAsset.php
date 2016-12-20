<?php

namespace udamuri\nestablemenu;

use \Yii;

class NestableAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@vendor/udamuri/yii2-nestablemenu/assets';

    public $js = [
        'jquery.nestable.js',
        'menunestable.js'
    ];
    
    public $css = [
        'nestable.css'
    ];
    
    public $depends = [
        'yii\web\JqueryAsset'
    ];
    
    public function init()
    {
        parent::init();
       // $this->js[] = 'i18n/' . Yii::$app->language . '.js'; // dynamic file added
    }
}