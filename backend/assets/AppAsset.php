<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/alert.css',
        'plugins/font-awesome/css/font-awesome.min.css',
        'temp/production/css/animate.min.css',
        'temp/production/css/custom.css',
        'temp/production/css/maps/jquery-jvectormap-2.0.1.css',
        'temp/production/css/maps/jquery-jvectormap-2.0.1.css',
        'temp/production/css/icheck/flat/green.css',
        'temp/production/css/floatexamples.css',
    ];
    public $js = [
        'temp/production/js/bootstrap.min.js',
        'temp/production/js/nicescroll/jquery.nicescroll.min.js',
        'temp/production/js/progressbar/bootstrap-progressbar.min.js',
        'temp/production/js/icheck/icheck.min.js',
        'temp/production/js/moment.min2.js',
        'temp/production/js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
