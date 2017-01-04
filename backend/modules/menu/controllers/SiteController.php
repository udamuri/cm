<?php

namespace app\modules\menu\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\db\Query;
use yii\widgets\ActiveForm;
use backend\modules\menu\models\MenuModel;
use backend\modules\menu\models\MenuForm;

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
                        'actions' => ['index', 'create'],
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
        if($post = Yii::$app->request->post())
        {
            if(isset($post['output-nestable']))
            {
                $jsonstring = $post['output-nestable'];
                $models = new MenuModel();
                if($models->sortMenu($jsonstring))
                {
                    Yii::$app->session->setFlash('success', "changes saved");
                }
                else
                {
                    Yii::$app->session->setFlash('error', "there is something wrong");
                }
            }
            else
            {
                Yii::$app->session->setFlash('error', "there is something wrong");
            }
        }

        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new MenuForm();
        
        if ($model->load(Yii::$app->request->post())) {
            if ($forum = $model->create()) {
                Yii::$app->session->setFlash('success', "Create New Menu");
                return Yii::$app->getResponse()->redirect(Yii::$app->homeUrl.'menu');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
