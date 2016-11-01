<?php

namespace app\modules\profile\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\db\Query;
use yii\widgets\ActiveForm;
use common\models\User;
use backend\modules\profile\models\PasswordForm;
use backend\modules\profile\models\UserForm;

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
                        'actions' => ['index', 'change-password', 'update-user', 'save-crop-profil', 'help'],
                        'allow' => true,
                        'roles' => ['@'],
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

    public function actionIndex()
    {
    	$modes = User::findOne(Yii::$app->user->identity->id);
        return $this->render('index',['modes'=>$modes]);
    }

    public function actionChangePassword()
	{
		$model = new PasswordForm();
		if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
		{
			if($model->resetPassword())
			{
				$data = array('status'=>'success');
				return \yii\helpers\Json::encode($data);
			}
			else
			{
				Yii::$app->response->format = 'json';
				$data = array('status'=>'form-error','error-form'=>ActiveForm::validate($model));
				return \yii\helpers\Json::encode($data);
				Yii::$app->end();
			}
		}
		else
		{
			$data = array('status'=>'error');
			return \yii\helpers\Json::encode($data);
		}
	}

    public function actionUpdateUser()
    {
        $model = new UserForm;

        if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            if($model->update())
            {
                $data = array('status'=>'success');
                return \yii\helpers\Json::encode($data);
            }
            else
            {
                Yii::$app->response->format = 'json';
                $data = array('status'=>'form-error','error-form'=>ActiveForm::validate($model));
                return \yii\helpers\Json::encode($data);
                Yii::$app->end();
            }
        }
        else
        {
            $data = array('status'=>'error');
            return \yii\helpers\Json::encode($data);
        }
    }

    public function actionSaveCropProfil()
    {
      
        if (Yii::$app->request->isAjax && isset($_POST['file_image'])) 
        {
            $file = $_POST['file_image'];
            $img = str_replace('data:image/png;base64,', '', $file);
        
            $pathTW = yii::getAlias('@backend/web/folderuser/');
            file_put_contents($pathTW.Yii::$app->user->identity->id.'profile.png', base64_decode($img));
            $pic = Yii::$app->homeUrl.'folderuser/'.Yii::$app->user->identity->id.'profile.png?'.time();
            $data = array('status'=>'success','pic'=>$pic);
            return \yii\helpers\Json::encode($data);
        }
        else
        {
            $data = array('status'=>'error');
            return \yii\helpers\Json::encode($data);
        }

    }

    public function actionHelp()
    {
        return $this->render('help');  
    }
}
