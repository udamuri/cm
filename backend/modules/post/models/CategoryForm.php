<?php
namespace backend\modules\post\models;

use Yii;
use yii\base\Model;
use backend\models\TableCategory;
use backend\models\TablePost;

/**
 * Post form
 */

class CategoryForm extends Model
{
	
    public $category_id;
    public $category_name;
    public $category_date;
    public $category_status;
    public $user_id;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          			
			['category_name', 'required'],
            ['category_name', 'filter', 'filter' => 'trim'],
			['category_name', 'string', 'max' => 255],
            ['category_name', 'checkCategoryName'],
        ];
    }

    public function checkCategoryName($attribute, $params)
    {
        $alias = Yii::$app->mycomponent->toAscii($this->category_name);
        $model = TableCategory::find()->where(['category_name'=>$alias])->one();
        $_model = TablePost::find()->where(['post_url_alias'=>$alias])->one();
        if(($model && $model->post_id != $this->post_id) || !empty($_model->post_url_alias) )
        {
            $this->addError($attribute, 'This category name already been taken.');
        }
    }

    public function create()
    {
        if ($this->validate()) {
      
            $create = new TableCategory();
            $create->category_name = Yii::$app->mycomponent->toAscii(trim(strip_tags(strtolower($this->category_name))));
            $create->category_date = date('Y-m-d H:i:s');
            $create->category_status = 1;
            $create->user_id = Yii::$app->user->identity->id;
            if ($create->save(false)) {
                 return true;
            }
        }

        return null;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function update($id)
    {
        if ($this->validate()) {
            $update = TableCategory::findOne($id);
            $update->category_name = Yii::$app->mycomponent->toAscii(trim(strip_tags(strtolower($this->category_name))));
            if ($update->save(false)) {
                 return true;
            }
        }

        return null;
    }
	
    public function delete($id)
    {

        $delete = TableCategory::findOne($id);
        if($delete)
        {
            return $delete->delete();
        }

        return null;  
    }

    public function getCategory($id)
    {
        $arrData = [];
        $get = TableCategory::findOne($id);
        if($get)
        {
            $arrData = [
                'category_id'=>$get['category_id'],
                'category_name'=>$get['category_name'],
                'category_date'=>$get['category_date'],
                'category_status'=>$get['category_status'],
                'user_id'=>$get['user_id']
            ];
            return $arrData;
        }

        return null;
    }

    public function setStatus($id)
    {
        $set = TableCategory::findOne($id);

        if($set)
        {
            if($set->category_status == 1)
            {
                $set->category_status = 0;
            }
            else
            {
                $set->category_status = 1 ;
            }
            $set->save(false);
            return $set->category_status;
        }

        return false;
    }
    
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
            'category_date' => 'Category Date',
            'category_status' => 'Category Status',
            'user_id' => 'User ID',
        ];
    }
	
}
