<?php
namespace backend\modules\menu\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;


class MenuModel extends Model
{
	
    /* Function menu_showNested
     * @desc Create inifinity loop for nested list from database
     * @return echo string
    */
    
    public $jsonstring ='';
    public function menu_showNested($parentID) {
        $rowParent = (new \yii\db\Query())
                    ->select('*')
                    ->from('tbl_menu')
                    ->where('1')
                    ->andWhere(['menu_parent_id'=>$parentID])
                    ->orderBy(['menu_rang'=>SORT_ASC])
                    ->all();

        $listParent = '';
        if (count($rowParent) > 0) {
            //$listParent .= "\n";
            $listParent .= "<ol class='dd-list'>";
                $listParentD = '';
                foreach ($rowParent as $value) {
                    //$listParentD .= "";
                    $classPublish ='glyphicon-ok';
                    $btnclass = 'btn-success';
                    if($value['menu_publish'] == 0)
                    {
                        $classPublish = 'glyphicon-remove';
                        $btnclass = 'btn-danger';
                    }

                    $checkDelete = $this->checkMenuParent($value['menu_id']);
                    $delete = '';
                    if($checkDelete <= 0)
                    {
                        $delete ='<button id="menu_delete'.$value['menu_id'].'" class="f08 btn btn-danger btn-xs menu_clickdelete" title="Delete" data-placement="bottom" data-toggle="tooltip" type="button">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>';
                    }

                    $listParentD .= "<li class='dd-item' data-id='".$value['menu_id']."'>";
                        $listParentD .= "<div class='dd-handle'>".$value['menu_name']."</div>";
                        $listParentD .= "<div class='menu-container-edit'>";
                        $listParentD .= $delete.'&nbsp';
                        $listParentD .= "<button id='dinamic_menu_publish".$value['menu_id']."' class='f08 btn btn-xs ".$btnclass." menu_clickpublish'  data-placement='bottom' type='button'><span id='menu_publish_icon".$value['menu_id']."' class='glyphicon ".$classPublish."'></span></button>&nbsp;";
                        $listParentD .= "<button id='dinamic_menu_update".$value['menu_id']."' class='f08 btn btn-xs btn-info menu_clickupdate'  data-placement='bottom' type='button'><span class='glyphicon glyphicon-pencil'></span></button>";
                        $listParentD .= "</div>";
                        $listParentD .= $this->menu_showNested($value['menu_id']);
                    
                    $listParentD .= "</li>";    
                }
            $listParent .= $listParentD;
            $listParent .= "</ol>";
        }

        return $listParent;
    } 

    //Show the top parent elements from DB
    public function showMenu()
    {
        $row = (new \yii\db\Query())
                    ->select('*')
                    ->from('tbl_menu')
                    ->where('1')
                    ->andWhere(['menu_parent_id'=>0])
                    ->orderBy(['menu_rang'=>SORT_ASC])
                    ->all();
        
        $list = '';
        $list .= "<div class='cf nestable-lists'>";
            $list .= "<div class='dd' id='nestable'>";
                $list .= "<ol class='dd-list'>";
                    $lst = '';
                    foreach ($row as $value) {
                        //$lst .= "\n";
                        $classPublish ='glyphicon-ok';
                        $btnclass = 'btn-success';
                        if($value['menu_publish'] == 0)
                        {
                            $classPublish = 'glyphicon-remove';
                            $btnclass = 'btn-danger';
                        }
                        $checkDelete = $this->checkMenuParent($value['menu_id']);
                        $delete = '';
                        if($checkDelete <= 0)
                        {
                            $delete ='<button id="menu_delete'.$value['menu_id'].'" class="f08 btn btn-danger btn-xs menu_clickdelete" title="Delete" data-placement="bottom" data-toggle="tooltip" type="button">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>';
                        }

                        $lst .= "<li class='dd-item' data-id='".$value['menu_id']."'>";
                            $lst .= "<div class='dd-handle'>".$value['menu_name']."</div>";
                            $lst .= "<div class='menu-container-edit'>";
                            $lst .= $delete.'&nbsp';
                            $lst .= "<button id='dinamic_menu_publish".$value['menu_id']."' class='f08 btn ".$btnclass." btn-xs menu_clickpublish'  data-placement='bottom' type='button'><span id='menu_publish_icon".$value['menu_id']."' class='glyphicon ".$classPublish."'></span></button>&nbsp;";
                            $lst .= "<button id='dinamic_menu_update".$value['menu_id']."' class='f08 btn btn-info btn-xs menu_clickupdate'  data-placement='bottom' type='button'><span class='glyphicon glyphicon-pencil'></span></button>";
                            $lst .= "</div>";
                            $lst .= $this->menu_showNested($value['menu_id']);
                        
                        $lst .= "</li>";
                    }
                $list .= $lst;
                $list .= "</ol>";
            $list .= "</div>";
        $list .= "</div>";
        return $list;
    }

    private function checkMenuParent($id)
    {
        $menuParentCount = (new \yii\db\Query())
            ->select('count(*) as CountParent')
            ->from('tbl_menu')
            ->where('1')
            ->andWhere(['menu_parent_id'=>$id])
            ->one();
        return $menuParentCount['CountParent'];
    }
}