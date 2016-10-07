<?php

namespace app\modules\content\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\db\Query;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
use backend\modules\content\models\CategoryForm;
use backend\modules\content\models\ContentForm;

/**
 * Default controller for the `content` module
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
                        'actions' => [  'index', 
                                        'create-content', 
                                        'update-content', 
                                        'status-content',
                                        'delete-content',
                                        'index-cat', 
                                        'create-content-cat', 
                                        'update-content-cat',
                                        'status-cat'
                                    ],
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
        $search = '';
        if(isset($_GET['search']))
        {
            $search =  strtolower(trim(strip_tags($_GET['search'])));
        }
        
        $query = (new \yii\db\Query())
                    ->select([
                        'tc.content_id',
                        'tc.content_category_id',
                        'tc.content_label',
                        'tc.content_desc',
                        'tc.content_user_id',
                        'tc.content_status',
                        'tcc.cat_name',
                    ])
                    ->from('tbl_content tc')
                    ->leftJoin('tbl_content_category tcc', 'tc.content_category_id = tcc.cat_id');
                    
        if($search !== '')
        {
            $query->where('lower(cat_name) LIKE "%'.$search.'%" ');
        }
        
        $countQuery = clone $query;
        $pageSize = 10;
        $pages = new Pagination([
                'totalCount' => $countQuery->count(), 
                'pageSize'=>$pageSize
            ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['content_id'=>SORT_DESC])
            ->all();
            
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'offset' =>$pages->offset,
            'page' =>$pages->page,
            'search' =>$search
        ]);
    }

    public function actionCreateContent()
    {
        $model = new ContentForm();
        
        if ($model->load(Yii::$app->request->post())) {
            if ($forum = $model->create()) {
                return $this->redirect(Yii::$app->homeUrl.'content');
            }
        }

        $category = $model->getCategoryData();
        return $this->render('add_content', [
            'category' => $category,
            'model' => $model,
        ]);
    }

    public function actionUpdateContent($id)
    {
        $model = new ContentForm;
        $_model = $model->getContent($id);
   
        if($_model)
        {
            if ($model->load(Yii::$app->request->post())) {                   
                if ($forum = $model->update($id)) {
                    return $this->redirect(Yii::$app->homeUrl.'content');
                }
            }

            $category = $model->getCategoryData();
            return $this->render('update_content', [
                'category' => $category,
                'model' => $model,
                '_model' => $_model,
            ]);
        }
        else
        {
            return $this->redirect(Yii::$app->homeUrl.'content');
        }
    }

    public function actionStatusContent()
    {
        if (Yii::$app->request->isAjax && isset($_POST['ids_data']) ) 
        {
            $model = new ContentForm();

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

    public function actionDeleteContent($id)
    {
        $model = new ContentForm;
           
        if($model->deleteContent($id))
        {
           return $this->redirect(Yii::$app->homeUrl.'content');
        }
        else
        {
            return $this->redirect(Yii::$app->homeUrl.'content');
        }
    }


    /* -----------------------------------category----------------------------------- */
    /**
     * Renders the index view for the module
     * @return string
     */
    
    public function actionIndexCat()
    {
       	$search = '';
		if(isset($_GET['search']))
		{
			$search =  strtolower(trim(strip_tags($_GET['search'])));
		}
		
		$query = (new \yii\db\Query())
					->select([
						'cat_id',
						'cat_parent_id',
                        'cat_name',
						'cat_status'
					])
					->from('tbl_content_category');
					
		if($search !== '')
		{
			$query->where('lower(cat_name) LIKE "%'.$search.'%" ');
		}
		
		$countQuery = clone $query;
		$pageSize = 10;
		$pages = new Pagination([
				'totalCount' => $countQuery->count(), 
				'pageSize'=>$pageSize
			]);
		$models = $query->offset($pages->offset)
			->limit($pages->limit)
			->orderBy(['cat_id'=>SORT_DESC])
			->all();
			
        return $this->render('index-category', [
			'models' => $models,
			'pages' => $pages,
			'offset' =>$pages->offset,
			'page' =>$pages->page,
			'search' =>$search
		]);
    }

    public function actionCreateContentCat()
    {
        $model = new CategoryForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($forum = $model->create()) {
                return $this->redirect(Yii::$app->homeUrl.'content-category');
            }
        }

        return $this->render('add_category', [
            'model' => $model,
        ]);
    }

    public function actionUpdateContentCat($id)
    {
        $model = new CategoryForm;
        $_model = $model->getCategory($id);
   
        if($_model)
        {
            if ($model->load(Yii::$app->request->post())) {
                if ($forum = $model->update($id)) {
                    return $this->redirect(Yii::$app->homeUrl.'content-category');
                }
            }

            return $this->render('update_category', [
                'model' => $model,
                '_model' => $_model,
            ]);
        }
        else
        {
            return $this->redirect(Yii::$app->homeUrl.'content-category');
        }
    }

    public function actionStatusCat()
    {
        if (Yii::$app->request->isAjax && isset($_POST['ids_data']) ) 
        {
            $model = new CategoryForm();

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

}
