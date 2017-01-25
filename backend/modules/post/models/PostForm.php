<?php
namespace backend\modules\post\models;

use Yii;
use yii\helpers\Html;
use yii\base\Model;
use app\components\Constants;
use backend\models\TablePost;
use backend\models\TableMeta;
/**
 * Post form
 */

class PostForm extends Model
{
	
    public $post_id;
    public $post_category_id;
    public $post_title;
    public $post_url_alias;
    public $post_content;
    public $post_date;
    public $post_modified;
    public $post_excerpt;
    public $post_status;
    public $post_type;
    public $user_id;
    public $meta_title;
    public $meta_keywords;
    public $meta_description;
    public $meta_tags;
  
	  
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          			
			['post_title', 'required'],
            ['post_title', 'filter', 'filter' => 'trim'],
            ['post_title', 'string', 'max' => 100],

            ['post_url_alias', 'required'],
            ['post_url_alias', 'filter', 'filter' => 'trim'],
            ['post_url_alias', 'string', 'max' => 255],

            ['post_excerpt', 'required'],
            ['post_excerpt', 'filter', 'filter' => 'trim'],
            ['post_excerpt', 'string', 'max' => 255],

            ['post_content', 'string'],

            ['post_status', 'required'],
            ['post_status', 'integer'],
            ['post_status', 'in', 'range' => [0, 1, 2]],

            //['post_category_id', 'required'],
			['post_category_id', 'integer'],

            ['meta_title', 'filter', 'filter' => 'trim'],
            ['meta_title', 'string', 'max' => 60],

            ['meta_keywords', 'filter', 'filter' => 'trim'],
            ['meta_keywords', 'string', 'max' => 255],

            ['meta_description', 'filter', 'filter' => 'trim'],
            ['meta_description', 'string', 'max' => 255],

            ['meta_tags', 'filter', 'filter' => 'trim'],
            ['meta_tags', 'string', 'max' => 255],
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
                if(isset($this->post_category_id))
                {
                    $c_value = $this->post_category_id ;
                }
            }
        
            $create = new TablePost();
            $create->post_category_id = $c_value;
            $create->post_title = trim(strip_tags($this->post_title));
            $create->post_excerpt = trim(strip_tags($this->post_excerpt));
            $create->post_content = Html::encode($this->post_content);
            $create->post_date = date('Y-m-d H:i:s');
            $create->post_modified = date('Y-m-d H:i:s');
            $create->post_status = (int)$this->post_status;
            $create->post_type = $t_value;
            $create->user_id = Yii::$app->user->identity->id;
            if ($create->save(false)) {

                $arrData = [];
                $arrData[] = [
                    'key'=> '_meta_title',
                    'value'=> trim(strip_tags($this->meta_title)),
                ];

                $arrData[] = [
                    'key'=> '_meta_keywords',
                    'value'=> trim(strip_tags($this->meta_keywords)),
                ];

                $arrData[] = [
                    'key'=> '_meta_description',
                    'value'=> trim(strip_tags($this->meta_description)),
                ];

                $arrData[] = [
                    'key'=> '_meta_tags',
                    'value'=> trim(strip_tags($this->meta_tags)),
                ];

                $this->cuMeta($arrData, $create->post_id);

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
    public function update($id, $post_type = 0)
    {
        $t_value = Constants::PAGE ;
        $c_value = 0 ;
        if($post_type == 1)
        {
            $t_value = Constants::POST ;
            if(isset($this->post_category_id))
            {
                $c_value = $this->post_category_id ;
            }
        }

        if ($this->validate()) {
            $update = TablePost::findOne($id);
            $update->post_category_id = $c_value;
            $update->post_title = trim(strip_tags($this->post_title));
            $update->post_excerpt = trim(strip_tags($this->post_excerpt));
            $update->post_content = Html::encode($this->post_content);
            $update->post_modified = date('Y-m-d H:i:s');
            if ($update->save(false)) {
                $arrData = [];
                $arrData[] = [
                    'key'=> '_meta_title',
                    'value'=> trim(strip_tags($this->meta_title)),
                ];

                $arrData[] = [
                    'key'=> '_meta_keywords',
                    'value'=> trim(strip_tags($this->meta_keywords)),
                ];

                $arrData[] = [
                    'key'=> '_meta_description',
                    'value'=> trim(strip_tags($this->meta_description)),
                ];

                $arrData[] = [
                    'key'=> '_meta_tags',
                    'value'=> trim(strip_tags($this->meta_tags)),
                ];

                $this->cuMeta($arrData, $update->post_id);
                return true;
            }
        }

        return null;
    }

    private function cuMeta($arrMeta = [], $pid)
    {
        if(is_array($arrMeta) && isset($pid))
        {
            
            foreach ($arrMeta as $value) {
                $meta_create =  TableMeta::find()->where(['meta_key'=>$value['key'], 'post_id'=>$pid ])->one();
                if($meta_create)
                {
                    $meta_create->meta_value =  $value['value'];
                    $meta_create->save(false);
                }
                else
                {
                    if(!empty($value['value']))
                    {
                        $meta_create = new TableMeta();
                        $meta_create->meta_key = $value['key'];
                        $meta_create->meta_date = date('Y-m-d H:i:s');
                        $meta_create->post_id =  $pid;
                        $meta_create->meta_value =  $value['value'];
                        $meta_create->save(false);
                    }
                }

               
            }
        }
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
        $meta = TableMeta::find()->where(['=', 'post_id', $id])->all();
        if($get)
        {
            $arrData = [
                'post_id'=>$get['post_id'],
                'post_category_id'=>$get['post_category_id'],
                'post_title'=>$get['post_title'],
                'post_excerpt'=>$get['post_excerpt'],
                'post_status'=>$get['post_status'],
                'post_content'=>Html::decode($get['post_content']),
                'post_meta'=>$meta,
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
            'post_url_alias' => 'URL Alias',
            'post_content' => 'Content',
            'post_date' => 'Date',
            'post_modified' => 'Modified',
            'post_excerpt' => 'Short Desc',
            'post_status' => 'Status',
            'post_type' => 'Type',
            'user_id' => 'User ID',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'meta_tags' => 'Meta Tags',
        ];
    }
	
}
