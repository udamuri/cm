<?php

namespace app\modules\setting\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\db\Query;
use yii\widgets\ActiveForm;
use backend\modules\setting\models\SettingForm;

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
		$search = '';
		if(isset($_GET['search']))
		{
			$search =  strtolower(trim(strip_tags($_GET['search'])));
		}
		
		$query = (new \yii\db\Query())
					->select([
						'setting_id',
						'setting_name',
						'setting_content'
					])
					->from('tbl_setting');
					
		if($search !== '')
		{
			$query->where('lower(setting_name) LIKE "%'.$search.'%" ')
					->orWhere('lower(setting_content) LIKE "%'.$search.'%"');
		}
		
		$countQuery = clone $query;
		$pageSize = 10;
		$pages = new Pagination([
				'totalCount' => $countQuery->count(), 
				'pageSize'=>$pageSize
			]);
		$models = $query->offset($pages->offset)
			->limit($pages->limit)
			->orderBy(['setting_id'=>SORT_DESC])
			->all();
			
        return $this->render('index', [
			'models' => $models,
			'pages' => $pages,
			'offset' =>$pages->offset,
			'page' =>$pages->page,
			'search' =>$search
		]);
    }

    public function actionCreateSetting()
    {
        $model = new SettingForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($forum = $model->create()) {
                return $this->redirect(Yii::$app->homeUrl.'web-setting');
            }
        }

        return $this->render('add_setting', [
            'model' => $model,
        ]);
    }

    public function actionUpdateSetting($id)
    {
        $model = new SettingForm;
        $_model = $model->getSetting($id);
   
        if($_model)
        {
            if ($model->load(Yii::$app->request->post())) {
                if ($forum = $model->update($id)) {
                    return $this->redirect(Yii::$app->homeUrl.'web-setting');
                }
            }

            return $this->render('update_setting', [
                'model' => $model,
                '_model' => $_model,
            ]);
        }
        else
        {
            return $this->redirect(Yii::$app->homeUrl.'web-setting');
        }
    }
}
