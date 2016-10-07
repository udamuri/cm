<?php
namespace backend\modules\content\models;

use app\components\Constants;
use yii\base\Model;
use backend\models\TableContentCategory;
use Yii;


class CategoryForm extends Model
{
    public $cat_id;
    public $cat_name;
  	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

			      ['cat_name', 'filter', 'filter' => 'trim'],
            ['cat_name', 'required'],
            ['cat_name', 'string', 'max' => 100],
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
            $create = new TableContentCategory();
            $create->cat_name = trim(strip_tags($this->cat_name));
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
            $update = TableContentCategory::findOne($pid);
            $update->cat_name = trim(strip_tags($this->cat_name));
            if($update->save(false)) 
            {
               return true;
            }
        }
        
        return null;
    }

    public function getCategory($p_id)
    {
        $model = $this->findModel($p_id);

        $arrData = array(
                'cat_name'=>$model['cat_name'],
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
        if($model->cat_status == 1)
        {
          $model->cat_status = 0;
          $_b_class = 'btn btn-xs btn-danger status-content-category';
          $_b_icon = 'fa fa-times-circle';
        }
        else
        {
          $model->cat_status = 1;
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
	

	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_name' => 'Category',
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
        if (($model = TableContentCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
