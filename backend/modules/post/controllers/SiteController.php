<?php

namespace app\modules\post\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\db\Query;
use yii\widgets\ActiveForm;
use backend\modules\post\models\PostForm;
use backend\modules\post\models\CategoryForm;


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
                        'actions' => ['index', 
                                      'index-category', 
                                      'create', 
                                      'create-category', 
                                      'update', 
                                      'update-category', 
                                      'set-status', 
                                      'set-status-category', 
                                      'delete'
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
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new PostForm();
        
        if ($model->load(Yii::$app->request->post())) {
            if ($post = $model->create(1)) {
                Yii::$app->session->setFlash('success', "Create New Post");
                return Yii::$app->getResponse()->redirect(Yii::$app->homeUrl.'posts');
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]); 
    }

    public function actionUpdate($id)
    {
        $model = new PostForm;
        $_model = $model->getPost($id);
   
        if($_model)
        {
            if ($model->load(Yii::$app->request->post())) {                   
                if ($menu = $model->update($id)) {
                    Yii::$app->session->setFlash('success', "Update Post");
                    return $this->redirect(Yii::$app->homeUrl.'posts');
                }
            }
            return $this->render('update', [
                'model' => $model,
                '_model' => $_model,
            ]);
        }
        else
        {
            return $this->redirect(Yii::$app->homeUrl.'posts-category');
        }
    }

    // category
    public function actionIndexCategory()
    {
        $search = '';
        if(isset($_GET['search']))
        {
            $search =  strtolower(trim(strip_tags($_GET['search'])));
        }
        
        $query = (new \yii\db\Query())
                    ->select([
                        'tc.category_id',
                        'tc.category_name',
                        'tc.category_date',
                        'tc.category_status',
                        'tc.user_id'
                    ])
                    ->from('tbl_category tc');
                    
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
            
        return $this->render('index_category', [
            'models' => $models,
            'pages' => $pages,
            'offset' =>$pages->offset,
            'page' =>$pages->page,
            'search' =>$search
        ]);
    }

    public function actionCreateCategory()
    {
        $model = new CategoryForm();
        
        if ($model->load(Yii::$app->request->post())) {
            if ($menu = $model->create()) {
                Yii::$app->session->setFlash('success', "Create New Category");
                return Yii::$app->getResponse()->redirect(Yii::$app->homeUrl.'posts-category');
            }
        }

        return $this->render('create_category', [
            'model' => $model,
        ]);
    }

    public function actionUpdateCategory($id)
    {
        $model = new CategoryForm;
        $_model = $model->getCategory($id);
   
        if($_model)
        {
            if ($model->load(Yii::$app->request->post())) {                   
                if ($menu = $model->update($id)) {
                    Yii::$app->session->setFlash('success', "Update Category");
                    return $this->redirect(Yii::$app->homeUrl.'posts-category');
                }
            }
            return $this->render('update_category', [
                'model' => $model,
                '_model' => $_model,
            ]);
        }
        else
        {
            return $this->redirect(Yii::$app->homeUrl.'posts-category');
        }
    }

    public function actionSetStatusCategory()
    {
        if($post = Yii::$app->request->post())
        {
            if(isset($post['id']))
            {
                $model = new CategoryForm;           
                if ($status = $model->setStatus($post['id'])) {
                    return $status;
                }
            }
        }

        return null;
    }
}
