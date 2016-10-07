<?php
namespace backend\modules\catalog\models;

use app\components\Constants;
use yii\base\Model;
use backend\models\TableCatalogCategory;
use Yii;


class CategoryForm extends Model
{
    public $category_id;
    public $category_name;
  	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

			      ['category_name', 'filter', 'filter' => 'trim'],
            ['category_name', 'required'],
            ['category_name', 'string', 'max' => 100],
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
            $create = new TableCatalogCategory();
            $create->category_name = trim(strip_tags($this->category_name));
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
            $update = TableCatalogCategory::findOne($pid);
            $update->category_name = trim(strip_tags($this->category_name));
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
                'category_name'=>$model['category_name'],
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
        if($model->category_status == 1)
        {
          $model->category_status = 0;
          $_b_class = 'btn btn-xs btn-danger status-catalog-category';
          $_b_icon = 'fa fa-times-circle';
        }
        else
        {
          $model->category_status = 1;
          $_b_class = 'btn btn-xs btn-primary status-catalog-category';
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
            'category_name' => 'Category',
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
        if (($model = TableCatalogCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
