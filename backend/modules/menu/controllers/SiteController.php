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
                        'actions' => ['index', 'create', 'update', 'set-status', 'delete', 'slide'],
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

            return Yii::$app->getResponse()->redirect(Yii::$app->homeUrl.'menu');
        }

        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new MenuForm();
        
        if ($model->load(Yii::$app->request->post())) {
            if ($menu = $model->create()) {
                Yii::$app->session->setFlash('success', "Create New Menu");
                return Yii::$app->getResponse()->redirect(Yii::$app->homeUrl.'menu');
            }
        }

        $xmodel = new MenuModel();
        $ymodel = $xmodel->getUrlAlias();
        return $this->render('create', [
            'model' => $model,
            'ymodel' =>$ymodel,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = new MenuForm;
        $_model = $model->getMenu($id);
   
        if($_model)
        {
            if ($model->load(Yii::$app->request->post())) {                   
                if ($menu = $model->update($id)) {
                    Yii::$app->session->setFlash('success', "Update Menu");
                    return $this->redirect(Yii::$app->homeUrl.'menu');
                }
            }
            $xmodel = new MenuModel();
            $ymodel = $xmodel->getUrlAlias();
            return $this->render('update', [
                'model' => $model,
                '_model' => $_model,
                'ymodel' =>$ymodel,
            ]);
        }
        else
        {
            return $this->redirect(Yii::$app->homeUrl.'menu');
        }
    }

    public function actionSetStatus()
    {
        if($post = Yii::$app->request->post())
        {
            if(isset($post['id']))
            {
                $model = new MenuForm;           
                if ($status = $model->setStatus($post['id'])) {
                    return $status;
                }
            }
        }

        return null;
    }

    public function actionDelete($id)
    {
        $model = new MenuForm;           
        if ($menu = $model->delete($id)) {
            Yii::$app->session->setFlash('success', "Delete Menu");
            return $this->redirect(Yii::$app->homeUrl.'menu');
        }
        return $this->redirect(Yii::$app->homeUrl.'menu');
    }

    //slide

    public function actionSlide()
    {
        return $this->render('slide');
    }
}
