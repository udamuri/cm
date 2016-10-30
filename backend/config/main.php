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
        'content' => [
            'class' => 'app\modules\content\Module',
        ],
        'menu' => [
            'class' => 'app\modules\menu\module',
        ],
    ],
    'components' => [
        'request' => [
            'baseUrl' => $baseUrl.'/cm-admin',
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
                'help'=>'profile/site/help',
                'web-setting'=>'setting/site/index',
                'create-setting'=>'setting/site/create-setting',
                'update-setting/<id:[0-9]+>'=>'setting/site/update-setting',
                'menu'=>'menu/site/index',
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
