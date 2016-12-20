<?php
namespace backend\modules\menu\models;

use yii\base\Model;
use Yii;
use backend\models\Nestamenu;

/**
 * Menu form
 */

class MenuForm extends Model
{
	
    public $menu_id;
    public $menu_parent_id;
    public $menu_sort;
    public $menu_title;
    public $menu_link;
    public $menu_status;

	private $_user = false;
	  
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          			
			['menu_title', 'required'],
            ['menu_title', 'filter', 'filter' => 'trim'],
			['menu_title', 'string', 'max' => 100],

            ['menu_link', 'required'],
            ['menu_link', 'filter', 'filter' => 'trim'],
            ['menu_link', 'string', 'max' => 255],
     
		
        ];
    }

    public function create()
    {
        if ($this->validate()) {
            $create = new Nestamenu();
            $create->menu_parent_id = 0 ;
            $create->menu_sort = 100 ;
            $create->menu_link = trim(strip_tags($this->menu_link));
            $create->menu_title = trim(strip_tags($this->menu_title));
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
            $update = Nestamenu::findOne($id);
            $update->menu_link = trim(strip_tags($this->menu_link));
            $update->menu_title = trim(strip_tags($this->menu_title));
            if ($create->save(false)) {
                 return true;
            }
        }

        return null;
    }
	
    
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menu_id' => 'ID',
            'menu_parent_id' => 'Parent ID',
            'menu_sort' => 'Sort',
            'menu_title' => 'Title',
            'menu_link' => 'Link',
            'menu_status' => 'Status',
        ];
    }
	
}
