<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

use \yii\web\Request;
$baseUrl = str_replace('/backend/web', '', (new Request)->getBaseUrl());

return [
    'id' => 'app-backend',
    'name' => 'Administrator',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'profile' => [
            'class' => 'app\modules\profile\Module',
        ],
        'setting' => [
            'class' => 'app\modules\setting\Module',
        ],
        'catalog' => [
            'class' => 'app\modules\catalog\Module',
        ],
        'client' => [
            'class' => 'app\modules\client\Module',
        ],
        'content' => [
            'class' => 'app\modules\content\Module',
        ],
    ],
    'components' => [
        'request' => [
            'baseUrl' => $baseUrl.'/arsyicom-admin',
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'mycomponent' => [
            'class' => 'app\components\TaskComponent',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager'=>[
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            //'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                'dashboard'=>'site/index',
                'logout'=>'site/logout',
                'profile'=>'profile/site/index',
                'web-setting'=>'setting/site/index',
                'create-setting'=>'setting/site/create-setting',
                'update-setting/<id:[0-9]+>'=>'setting/site/update-setting',
                'catalog'=>'catalog/site/index',
                'create-catalog'=>'catalog/site/create-catalog',
                'update-catalog/<id:[0-9]+>'=>'catalog/site/update-catalog',
                'delete-catalog/<id:[0-9]+>'=>'catalog/site/delete-catalog',
                'catalog-category'=>'catalog/site/index-category',
                'create-catalog-category'=>'catalog/site/create-catalog-category',
                'update-catalog-category/<id:[0-9]+>'=>'catalog/site/update-catalog-category',
                'client'=>'client/site/index',
                'create-client'=>'client/site/create-client',
                'update-client/<id:[0-9]+>'=>'client/site/update-client',
                'delete-client/<id:[0-9]+>'=>'client/site/delete-client',
                'content'=>'content/site/index',
                'content-category'=>'content/site/index-cat',
                'create-content-category'=>'content/site/create-content-cat',
                'update-content-category/<id:[0-9]+>'=>'content/site/update-content-cat',
                'create-content'=>'content/site/create-content',
                'update-content/<id:[0-9]+>'=>'content/site/update-content',
                'delete-content/<id:[0-9]+>'=>'content/site/delete-content',
            ],
        ],
        //Yii::$app->urlManagerFrontEnd->createUrl('//')
        'urlManagerFrontEnd' => [
            'class' => 'yii\web\urlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => $baseUrl,
        ],
    ],
    'params' => $params,
];
