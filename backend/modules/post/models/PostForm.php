<?php
namespace backend\modules\menu\models;

use Yii;
use yii\helpers\Html;
use yii\base\Model;
use backend\models\TablePost;
use app\components\Constants;
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

            ['post_status', 'required'],
			['post_status', 'integer'],
            ['post_status', 'in', 'range' => [0, 1]]
        ];
    }

    public function create($post_type = 0)
    {

        if ($this->validate()) {
            $t_value = Constants::PAGE ;
            $c_value = 0 ;
            if($post_type == 1)
            {
                $t_value = Constants::POST ;
                $c_value = $this->post_category_id ;
            }
            $create = new TablePost();
            $create->post_category_id = $c_value;
            $create->post_title = trim(strip_tags($this->post_title));
            $create->post_content = Html::encode($this->post_content);
            $create->post_date = date('Y-m-d H:i:s');
            $create->post_modified = date('Y-m-d H:i:s');
            $create->post_status = (int)$this->post_status;
            $create->post_type = $t_value;
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
            'post_category_id' => 'Category ID',
            'post_title' => 'Title',
            'post_content' => 'Content',
            'post_date' => 'Date',
            'post_modified' => 'Modified',
            'post_excerpt' => 'Excerpt',
            'post_status' => 'Status',
            'post_type' => 'Type',
            'user_id' => 'User ID',
        ];
    }
	
}
