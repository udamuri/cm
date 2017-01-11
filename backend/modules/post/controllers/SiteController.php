<?php

namespace app\modules\post\controllers;

use yii\web\Controller;

/**
 * Default controller for the `post` module
 */
class SiteController extends Controller
{
	/*
	* @inheritdoc
    */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'set-status', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
						   return Yii::$app->mycomponent->isUserRole('member', Yii::$app->user->identity->level);
						}
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
