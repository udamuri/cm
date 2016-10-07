<?php
namespace backend\modules\content\models;

use app\components\Constants;
use yii\base\Model;
use backend\models\TableContent;
use backend\models\TableContentCategory;
use yii\helpers\Html;
use Yii;


class ContentForm extends Model
{
    public $content_id;
    public $content_category_id;
    public $content_label;
    public $content_desc;
    public $content_meta_keyword;
    public $content_meta_desc;


  	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

			      ['content_label', 'filter', 'filter' => 'trim'],
            ['content_label', 'required'],
            ['content_label', 'string', 'max' => 100],

            ['content_desc', 'filter', 'filter' => 'trim'],
            ['content_desc', 'required'],
            ['content_desc', 'string'],

            ['content_category_id', 'required'],
            ['content_category_id', 'integer'],

            ['content_meta_keyword', 'filter', 'filter' => 'trim'],
            ['content_meta_keyword', 'string', 'max' => 256],

            ['content_meta_desc', 'filter', 'filter' => 'trim'],
            ['content_meta_desc', 'string', 'max' => 256],
        ];
    }
	
    /**
     * Create Pasien.
     *
     * @return user|null the saved model or null if saving fails
    */
    public function create()
    {
        if ($this->validate()) {
            $create = new TableContent();
            $create->content_label = trim(strip_tags($this->content_label));
            $create->content_category_id = $this->content_category_id;
            $create->content_desc = Html::encode($this->content_desc);
            $create->content_meta_keyword = trim(strip_tags($this->content_meta_keyword));
            $create->content_meta_desc = trim(strip_tags($this->content_meta_desc));
            $create->content_date = date('Y-m-d H:i:s');
            $create->content_user_id = Yii::$app->user->identity->id;
            if($create->save(false)) 
            {
               return true;
            }
        }

        return null;
    }

    /**
     * Update Pasien.
     *
     * @return user|null the saved model or null if saving fails
    */
    public function update($pid)
    {
     
        if ($this->validate()) {
            $update = TableContent::findOne($pid);
            $update->content_label = trim(strip_tags($this->content_label));
            $update->content_category_id = $this->content_category_id;
            $update->content_desc = Html::encode($this->content_desc);
            $update->content_meta_keyword = trim(strip_tags($this->content_meta_keyword));
            $update->content_meta_desc = trim(strip_tags($this->content_meta_desc));
            if($update->save(false)) 
            {
               return true;
            }
        }
        
        return null;
    }

    public function getContent($p_id)
    {
        $model = $this->findModel($p_id);

        $arrData = array(
                'content_label'=>$model['content_label'],
                'content_category_id'=>$model['content_category_id'],
                'content_desc'=>$model['content_desc'],
                'content_meta_keyword'=>$model['content_meta_keyword'],
                'content_meta_desc'=>$model['content_meta_desc'],
            );
        if($arrData)
        {
            return $arrData;   
        }

        return null;
       
    }

    public function setStatus($p_id)
    {
        $model = $this->findModel($p_id);
        if($model->content_status == 1)
        {
          $model->content_status = 0;
          $_b_class = 'btn btn-xs btn-danger status-content-category';
          $_b_icon = 'fa fa-times-circle';
        }
        else
        {
          $model->content_status = 1;
          $_b_class = 'btn btn-xs btn-primary status-content-category';
          $_b_icon = 'fa fa-check-square-o';
        }

        if($model->save(false))
        {
            return [
                'status' => 'success',
                'icon' => $_b_icon,
                'btn' => $_b_class,
            ];
        }

        return false;
    }

    public function getCategoryData()
    {
        $module = TableContentCategory::find()->all();
        $arrData = [
            'cat_id' => '',
            'cat_name' => ''
        ];
        $arrData[] = [
            'cat_id' => '0',
            'cat_name' => 'Single Page'
        ];
        foreach ( $module  as $value) {
            $arrData[] = [
                'cat_id' => $value['cat_id'],
                'cat_name' => $value['cat_name'],
            ];
        }
       

        return $arrData;
    }
	
    public function deleteContent($p_id)
    {
        $delete = $this->findModel($p_id);
    
        if($delete->delete())
        {
            return true;
        }

        return false;
    }

	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'content_id' => 'ID',
            'content_category_id' => 'Category',
            'content_label' => 'Label',
            'content_desc' => 'Description',
            'content_date' => 'Date',
            'content_status' => 'Status',
            'content_meta_keyword' => 'Meta Keyword',
            'content_meta_desc' => 'Meta Description',
            'content_user_id' => 'User ID',
        ];
    }
	
	/**
     * Finds the UserPost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserPost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TableContent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
