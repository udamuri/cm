<?php
/*
name : Muri Budiman
date : dec 20, 2016
*/
namespace udamuri\nestablemenu;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\db\Query;
use yii\widgets\ActiveForm;
use yii\base\ErrorException;

class TreeMenu extends \yii\base\Widget
{
   
 	public $options = [
        'class' => 'cf nestable-lists'
    ];

   	public $containerID  = 'default-nestable';
    public $table_name = false;
    public $output = '';
    public $button = [];
    public $delete_url = 'javascript:void(0);';
    public $update_url = 'javascript:void(0);';

    public function run()
    {
        NestableAsset::register($this->getView());
        $this->registerScript($this->containerID);
        return $this->createMenu();
    }

    protected function createMenu()
    {
        if($this->table_name)
        {
            return $this->parentMenu($this->table_name);
        }
        return false;
    }

    protected function parentMenu($table = 'nestamenu')
    {
        try {
            $query = new Query;
            $query->select('menu_id, menu_parent_id, menu_sort, menu_title, menu_link, menu_status')
                ->from($table)
                ->where(['menu_parent_id'=>0])
                ->orderBy('menu_sort');
            $rows = $query->all();

            $menu = '<div class="dd" id="'.$this->containerID.'">';
            $menu .= '<ol class="dd-list">';
            foreach ($rows as $value) {
                $btn_status = '<button id="btn_status_'.$value['menu_id'].'" data-id="'.$value['menu_id'].'" type="button" class="btn btn-warning btn-sm btn_status">OFF</button>';
                if($value['menu_status'] == 1)
                {
                    $btn_status = '<button id="btn_status_'.$value['menu_id'].'" data-id="'.$value['menu_id'].'" type="button" class="btn btn-primary btn-sm btn_status">ON</button>';
                }

                $submenu = ''; 
                $btn_delete = '<a href="'.$this->delete_url.'/'.$value['menu_id'].'" data-id="'.$value['menu_id'].'" class="btn btn-danger btn-sm">Delete</a>';
                if($submenu = $this->childMenu($value['menu_id'], $table))
                {
                    $btn_delete = '';   
                }

                $menu .= '<li class="dd-item" data-id="'.$value['menu_id'].'">
                            <div class="dd-handle">
                                '.$value['menu_title'].'
                            </div>
                            <div class="dd-button">
                                <div class="btn-group" role="group" aria-label="...">
                                    '.$btn_delete.'
                                    <a href="'.$this->update_url.'/'.$value['menu_id'].'" data-id="'.$value['menu_id'].'" class="btn btn-success btn-sm">Update</a>
                                    '.$btn_status.'
                                </div>
                            </div>';

                $menu .=    $submenu;
                $menu .= '</li>'; 
            }

            $menu .= '</ol>';
            $menu .= '</div>';

            $menu .= '<div class="clearfix"></div>';
            $menu .= '<div class="'.$this->output.'"><textarea name="output-nestable" class="form-control" id="'.$this->containerID.'-output"></textarea></div>';
            $menu .= '<div class="clearfix"></div>';
           
            if(is_array($this->button) && count($this->button) )
            {
                $menu .= '<div>';
                foreach ($this->button as $value) {
                    $type = 'button';
                    if(isset($value['type']) && $value['type'] == 'submit')
                    {
                        $type = $value['type'];
                        $menu .= '<button id="'.$value['id'].'" class="btn '.$value['btn-class'].'" type="'.$type.'" >'.$value['label'].'</button>&nbsp;';
                    }
                    else
                    {
                        if( isset($value['url']))
                        {
                            $menu .= '<a href="'.$value['url'].'" id="'.$value['id'].'" class="btn '.$value['btn-class'].'"  >'.$value['label'].'</a>&nbsp;'; 
                        }
                    }
                   
                }
                $menu .= '</div>';
            }

            return Html::tag('div', $menu , $this->options);
        } catch (ErrorException $e) {
            Yii::warning("something went wrong");
        }

    }

    protected function childMenu($id = 0, $table)
    {
        $query = new Query;
        $query->select('menu_id, menu_parent_id, menu_sort, menu_title, menu_link, menu_status')
            ->from($table)
            ->where(['menu_parent_id'=>$id])
            ->orderBy('menu_sort');
        $rows = $query->all();

        $menu = '';
        if($rows)
        {
            $menu .= '<ol class="dd-list">';
            foreach ($rows as $value) {
                $btn_status = '<button id="btn_status_'.$value['menu_id'].'" data-id="'.$value['menu_id'].'" type="button" class="btn btn-warning btn-sm btn_status">OFF</button>';
                if($value['menu_status'] == 1)
                {
                    $btn_status = '<button id="btn_status_'.$value['menu_id'].'" data-id="'.$value['menu_id'].'" type="button" class="btn btn-primary btn-sm btn_status">ON</button>';
                }

                $submenu = ''; 
                $btn_delete = '<a href="'.$this->delete_url.'/'.$value['menu_id'].'" data-id="'.$value['menu_id'].'" class="btn btn-danger btn-sm">Delete</a>';
                if($submenu = $this->childMenu($value['menu_id'], $table))
                {
                    $btn_delete = '';   
                }

                $menu .= '<li class="dd-item" data-id="'.$value['menu_id'].'">
                            <div class="dd-handle">
                                '.$value['menu_title'].'
                            </div>
                            <div class="dd-button">
                                <div class="btn-group" role="group" aria-label="...">
                                  '.$btn_delete.'
                                  <a href="'.$this->update_url.'/'.$value['menu_id'].'" data-id="'.$value['menu_id'].'" class="btn btn-success btn-sm">Update</a>
                                  '.$btn_status.'
                                </div>
                            </div>';

                $menu .=    $submenu;
                $menu .= '</li>'; 
            }
            $menu .= '</ol>';
        }

        return $menu;
    }

    protected function registerScript($id)
    {
$jsx = <<< 'SCRIPT'
        MenunestableObj.initialScript();
SCRIPT;
        $this->getView()->registerJs('MenunestableObj.content ="'.$this->containerID.'" ');
        $this->getView()->registerJs($jsx);
    }

}
