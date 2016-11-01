<?php

namespace app\modules\menu\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\db\Query;
use yii\widgets\ActiveForm;
use backend\modules\menu\models\MenuModel;

/**
 * Default controller for the `menu` module
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
                        'actions' => ['index'],
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
    	$model = new MenuModel;
		$menu = $model->showMenu();
        return $this->render('index', ['menu'=>$menu]);
    }
}
