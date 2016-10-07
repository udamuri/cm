<?php

namespace app\modules\catalog\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\db\Query;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
use backend\modules\catalog\models\CategoryForm;
use backend\modules\catalog\models\CatalogForm;



/**
 * Default controller for the `catalog` module
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
                                        'create-catalog', 
                                        'update-catalog', 
                                        'save-crop-catalog',
                                        'status-catalog',
                                        'delete-catalog',
                                        'get-catalog-image',
                                        'index-category', 
                                        'create-catalog-category', 
                                        'update-catalog-category',
                                        'status-category'
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
                        'tc.catalog_id',
                        'tc.catalog_category_id',
                        'tc.catalog_name',
                        'tc.catalog_status',
                        'tc.catalog_image',
                        'tcc.category_name'
                    ])
                    ->from('tbl_catalog tc')
                    ->leftJoin('tbl_catalog_category tcc', 'tc.catalog_category_id = tcc.category_id');
                    
        if($search !== '')
        {
            $query->where('lower(catalog_name) LIKE "%'.$search.'%" ');
        }
        
        $countQuery = clone $query;
        $pageSize = 10;
        $pages = new Pagination([
                'totalCount' => $countQuery->count(), 
                'pageSize'=>$pageSize
            ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['catalog_id'=>SORT_DESC])
            ->all();
            
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'offset' =>$pages->offset,
            'page' =>$pages->page,
            'search' =>$search
        ]);
    }

    public function actionCreateCatalog()
    {
        $model = new CatalogForm();
        $model->scenario = 'insert';
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($forum = $model->create()) {
                return $this->redirect(Yii::$app->homeUrl.'catalog');
            }
        }

        $category = $model->getCategoryData();
        return $this->render('add_catalog', [
            'category' => $category,
            'model' => $model,
        ]);
    }

    public function actionUpdateCatalog($id)
    {
        $model = new CatalogForm;
        $model->scenario = 'update';
        $_model = $model->getCatalog($id);
   
        if($_model)
        {
            if ($model->load(Yii::$app->request->post())) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');                    
                if ($forum = $model->update($id)) {
                    return $this->redirect(Yii::$app->homeUrl.'catalog');
                }
            }

            $category = $model->getCategoryData();
            return $this->render('update_catalog', [
                'category' => $category,
                'model' => $model,
                '_model' => $_model,
            ]);
        }
        else
        {
            return $this->redirect(Yii::$app->homeUrl.'catalog');
        }
    }

    public function actionStatusCatalog()
    {
        if (Yii::$app->request->isAjax && isset($_POST['ids_data']) ) 
        {
            $model = new CatalogForm();

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

    public function actionDeleteCatalog($id)
    {
        $model = new CatalogForm;
        $model->scenario = 'delete';
           
        if($model->deleteCatalog($id))
        {
           return $this->redirect(Yii::$app->homeUrl.'catalog');
        }
        else
        {
            return $this->redirect(Yii::$app->homeUrl.'catalog');
        }
    }


    /* bts ------------------------------------------------------------------ */

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndexCategory()
    {
        $search = '';
		if(isset($_GET['search']))
		{
			$search =  strtolower(trim(strip_tags($_GET['search'])));
		}
		
		$query = (new \yii\db\Query())
					->select([
						'category_id',
						'category_parent_id',
                        'category_name',
						'category_status'
					])
					->from('tbl_catalog_category');
					
		if($search !== '')
		{
			$query->where('lower(category_name) LIKE "%'.$search.'%" ');
		}
		
		$countQuery = clone $query;
		$pageSize = 10;
		$pages = new Pagination([
				'totalCount' => $countQuery->count(), 
				'pageSize'=>$pageSize
			]);
		$models = $query->offset($pages->offset)
			->limit($pages->limit)
			->orderBy(['category_id'=>SORT_DESC])
			->all();
			
        return $this->render('index-category', [
			'models' => $models,
			'pages' => $pages,
			'offset' =>$pages->offset,
			'page' =>$pages->page,
			'search' =>$search
		]);
    }

    public function actionCreateCatalogCategory()
    {
        $model = new CategoryForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($forum = $model->create()) {
                return $this->redirect(Yii::$app->homeUrl.'catalog-category');
            }
        }

        return $this->render('add_category', [
            'model' => $model,
        ]);
    }

    public function actionUpdateCatalogCategory($id)
    {
        $model = new CategoryForm;
        $_model = $model->getCategory($id);
   
        if($_model)
        {
            if ($model->load(Yii::$app->request->post())) {
                if ($forum = $model->update($id)) {
                    return $this->redirect(Yii::$app->homeUrl.'catalog-category');
                }
            }

            return $this->render('update_category', [
                'model' => $model,
                '_model' => $_model,
            ]);
        }
        else
        {
            return $this->redirect(Yii::$app->homeUrl.'catalog-category');
        }
    }


    public function actionStatusCategory()
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

    /* crop picture */

    public function actionGetCatalogImage()
    {
        if(Yii::$app->request->isAjax && isset($_POST['data-load']))
        {
            $id = (int) $_POST['data-load'] ;
            $model = new CatalogForm;
            $_model = $model->getCatalog($id);
       
            if($_model)
            {
                $url = Yii::$app->urlManagerFrontEnd->createUrl('//').'product/'.$_model['catalog_id'].$_model['catalog_image'];
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

    public function actionSaveCropCatalog()
    {
      
        if (Yii::$app->request->isAjax && isset($_POST['file_image']) && isset($_POST['data-load']) ) 
        {
            $file = $_POST['file_image'];
            $img = str_replace('data:image/png;base64,', '', $file);
        
            $ids = (int) $_POST['data-load'] ;

            $pathTW = yii::getAlias('@frontend/web/product/');
            file_put_contents($pathTW.$ids.'.png', base64_decode($img));
            $pic = Yii::$app->urlManagerFrontEnd->createUrl('//').'product/'.$ids.'.png?'.time();
            $data = array('status'=>'success','pic'=>$pic);
            $model = new CatalogForm();
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
