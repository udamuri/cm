<?php

namespace app\modules\setting\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\db\Query;
use yii\widgets\ActiveForm;
use backend\modules\setting\models\OptionForm;

/**
 * Default controller for the `setting` module
 */
class SiteController extends Controller
{
	/**
    * @inheritdoc
    */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create-setting', 'get-setting', 'update-setting'],
                        'allow' => true,
                        'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
						   return Yii::$app->mycomponent->isUserRole('admin', Yii::$app->user->identity->level);
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
        $model = new OptionForm();
        if($model->load(Yii::$app->request->post()))
        {
            $data = Yii::$app->request->post();
            $_data = $data['OptionForm'];
            if($model->update($_data))
            {
                Yii::$app->session->setFlash('success', 'Success Update Setting Site');
            }
            else
            {
                Yii::$app->session->setFlash('error', 'ups\' sorry, something wrong');
            }

           
            return $this->redirect(Yii::$app->homeUrl.'web-setting');
        }

        $generalSetting = $model->getAllOption(1);
        $socialmediaSetting = $model->getAllOption(2);

        return $this->render('index', [
            'model' => $model,
            'generalSetting'=>$generalSetting,
            'socialmediaSetting'=>$socialmediaSetting,
        ]);
    }

}
