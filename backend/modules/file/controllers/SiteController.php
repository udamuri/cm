<?php

namespace app\modules\file\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\db\Query;
use yii\widgets\ActiveForm;
use backend\modules\file\models\UploadForm;
use yii\web\UploadedFile;

/**
 * Default controller for the `file` module
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
                        'actions' => ['index', 'delete'],
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

        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                Yii::$app->session->setFlash('success', "Upload File");
                return Yii::$app->getResponse()->redirect(Yii::$app->homeUrl.'file-manager');
            }
        }

        $search = '';
        if(isset($_GET['search']))
        {
            $search =  strtolower(trim(strip_tags($_GET['search'])));
        }
        
        $query = (new \yii\db\Query())
                    ->select([
                        'tc.file_id',
                        'tc.file_name',
                        'tc.file_folder',
                        'tc.file_type',
                        'tc.file_size',
                        'tc.file_date_upload',
                        'tc.file_extension',
                        'tc.user_id'
                    ])
                    ->from('tbl_file tc');
                    
        if($search !== '')
        {
            $query->where('lower(file_name) LIKE "%'.$search.'%" ');
        }
        
        $countQuery = clone $query;
        $pageSize = 10;
        $pages = new Pagination([
                'totalCount' => $countQuery->count(), 
                'pageSize'=>$pageSize
            ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['file_id'=>SORT_DESC])
            ->all();
            
        return $this->render('index', [
            'model' => $model,
            'models' => $models,
            'pages' => $pages,
            'offset' =>$pages->offset,
            'page' =>$pages->page,
            'search' =>$search
        ]);
    }

    public function actionDelete($id)
    {
        $model = new UploadForm;           
        if ($menu = $model->delete($id)) {
            Yii::$app->session->setFlash('success', "Delete File");
            return Yii::$app->getResponse()->redirect(Yii::$app->homeUrl.'file-manager');
        }
        return $this->redirect(Yii::$app->homeUrl.'file-manager');
    }
}
