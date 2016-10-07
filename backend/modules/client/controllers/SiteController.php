<?php

namespace app\modules\client\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\db\Query;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
use backend\modules\client\models\ClientForm;

/**
 * Default controller for the `client` module
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
                        'actions' => [
                        				'index', 
                        				'create-client', 
                                        'update-client',
                                        'status-client',
                                        'delete-client',
                                        'save-crop-client',
                                        'get-client-image',
                        			],
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

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $search = '';
        if(isset($_GET['search']))
        {
            $search =  strtolower(trim(strip_tags($_GET['search'])));
        }
        
        $query = (new \yii\db\Query())
                    ->select([
                        'tc.client_id',
                        'tc.client_name',
                        'tc.client_image',
                        'tc.client_status'
                    ])
                    ->from('tbl_client tc');
                    
        if($search !== '')
        {
            $query->where('lower(client_name) LIKE "%'.$search.'%" ');
        }
        
        $countQuery = clone $query;
        $pageSize = 10;
        $pages = new Pagination([
                'totalCount' => $countQuery->count(), 
                'pageSize'=>$pageSize
            ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['client_id'=>SORT_DESC])
            ->all();
            
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'offset' =>$pages->offset,
            'page' =>$pages->page,
            'search' =>$search
        ]);
    }

    public function actionCreateClient()
    {
        $model = new ClientForm();
        $model->scenario = 'insert';
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($forum = $model->create()) {
                return $this->redirect(Yii::$app->homeUrl.'client');
            }
        }

        return $this->render('add_client', [
            'model' => $model,
        ]);
    }

    public function actionUpdateClient($id)
    {
        $model = new ClientForm;
        $model->scenario = 'update';
        $_model = $model->getClient($id);
        if($_model)
        {
            if ($model->load(Yii::$app->request->post())) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');                    
                if ($forum = $model->update($id)) {
                    return $this->redirect(Yii::$app->homeUrl.'client');
                }
            }

            return $this->render('update_client', [
                'model' => $model,
                '_model' => $_model,
            ]);
        }
        else
        {
            return $this->redirect(Yii::$app->homeUrl.'catalog');
        }
    }

    public function actionStatusClient()
    {
        if (Yii::$app->request->isAjax && isset($_POST['ids_data']) ) 
        {
            $model = new ClientForm();

            if ($_data = $model->setStatus($_POST['ids_data'])) 
            {
                $data = $_data;
                return \yii\helpers\Json::encode($data);
            }
            else
            {
                $data = array('status'=>'error');
                return \yii\helpers\Json::encode($data);
            }
        }
        else
        {
            $data = array('status'=>'error');
            return \yii\helpers\Json::encode($data);
        }
    }

    public function actionDeleteClient($id)
    {
        $model = new ClientForm;
        $model->scenario = 'delete';
           
        if($model->deleteClient($id))
        {
           return $this->redirect(Yii::$app->homeUrl.'client');
        }
        else
        {
            return $this->redirect(Yii::$app->homeUrl.'client');
        }
    }

    /* crop picture */ 

    public function actionGetClientImage()
    {
        if(Yii::$app->request->isAjax && isset($_POST['data-load']))
        {
            $id = (int) $_POST['data-load'] ;
            $model = new ClientForm;
            $_model = $model->getClient($id);
       
            if($_model)
            {
                $url = Yii::$app->urlManagerFrontEnd->createUrl('//').'client/'.$_model['client_id'].$_model['client_image'];
                $data = array('status'=>'success', 'imageurl'=>$url);
                return \yii\helpers\Json::encode($data);
            }
            else
            {
                $data = array('status'=>'error');
                return \yii\helpers\Json::encode($data);
            }
        }
        else
        {
            $data = array('status'=>'error');
            return \yii\helpers\Json::encode($data);
        }
    }

    public function actionSaveCropClient()
    {
      
        if (Yii::$app->request->isAjax && isset($_POST['file_image']) && isset($_POST['data-load']) ) 
        {
            $file = $_POST['file_image'];
            $img = str_replace('data:image/png;base64,', '', $file);
        
            $ids = (int) $_POST['data-load'] ;

            $pathTW = yii::getAlias('@frontend/web/client/');
            file_put_contents($pathTW.$ids.'.png', base64_decode($img));
            $pic = Yii::$app->urlManagerFrontEnd->createUrl('//').'client/'.$ids.'.png?'.time();
            $data = array('status'=>'success','pic'=>$pic);
            $model = new ClientForm();
            if($model->updateimage($ids))
            {
                return \yii\helpers\Json::encode($data);  
            }
            else
            {
                $data = array('status'=>'error');
                return \yii\helpers\Json::encode($data); 
            }
            
        }
        else
        {
            $data = array('status'=>'error');
            return \yii\helpers\Json::encode($data);
        }

    }

}
