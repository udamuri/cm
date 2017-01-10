<?php
namespace backend\modules\menu\models;

use yii\base\Model;
use Yii;
use backend\models\TablePost;

/**
 * Post form
 */

class MenuForm extends Model
{
	
    public $post_id;
    public $post_category_id;
    public $post_title;
    public $post_content;
    public $post_date;
    public $post_modified;
    public $post_excerpt;
    public $post_status;
    public $post_type;
    public $user_id;
  
	  
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          			
			['post_title', 'required'],
            ['post_title', 'filter', 'filter' => 'trim'],
			['post_title', 'string', 'max' => 100],
        ];
    }

    public function create()
    {
        if ($this->validate()) {
      
            $create = new TablePost();
            $create->post_title = trim(strip_tags($this->post_title));
            $create->menu_status = 1;
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
            $update = TablePost::findOne($id);
            $update->post_title = trim(strip_tags($this->post_title));
            if ($update->save(false)) {
                 return true;
            }
        }

        return null;
    }
	
    public function delete($id)
    {

        $delete = TablePost::findOne($id);
        if($delete)
        {
            return $delete->delete();
        }

        return null;  
    }

    public function getPost($id)
    {
        $arrData = [];
        $get = TablePost::findOne($id);
        if($get)
        {
            $arrData = [
                'post_id'=>$get['post_id'],
                'post_title'=>$get['post_title']
            ];
            return $arrData;
        }

        return null;
    }

    public function setStatus($id)
    {
        $set = TablePost::findOne($id);

        if($set)
        {
            if($set->post_status == 1)
            {
                $set->post_status = 0;
            }
            else
            {
                $set->post_status = 1 ;
            }
            $set->save(false);
            return $set->post_status;
        }

        return false;
    }
    
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'ID',
            'post_title' => 'Title',
        ];
    }
	
}
