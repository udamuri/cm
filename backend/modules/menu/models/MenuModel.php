<?php
namespace backend\modules\menu\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;
use backend\models\Nestamenu;
use app\components\Constants;
use backend\models\TablePost;
use backend\models\TableCategory;


class MenuModel extends Model
{
	private $order = 0;

    public function sortMenu($jsonstring = '')
    {
    	if(!empty($jsonstring))
    	{
    		$arr = \yii\helpers\Json::decode($jsonstring);
    		if(is_array($arr))
    		{
    			foreach ($arr as $value) {
    				$this->order++;
    				$model = Nestamenu::findOne(['menu_id'=>$value['id']]);
    				$model->menu_parent_id = 0;
    				$model->menu_sort = $this->order;
    				$model->save(false);
					if(isset($value['children']))
					{
						$this->sortTree($value['children'], $value['id']);
					}
				}

				return true;
    		}

    		return false;
    	}

    	return false;
    }

    private function sortTree($datachild, $parent)
	{
		foreach ($datachild as $value) {
			$this->order++;
			$model = Nestamenu::findOne(['menu_id'=>$value['id']]);
			$model->menu_parent_id = $parent;
			$model->menu_sort = $this->order;
			$model->save(false);
			if(isset($value['children']))
			{
				$this->sortTree($value['children'], $value['id']);
			}
			
		}
	}

	public function getUrlAlias()
	{
		$arrData = [];
		$modelCategory = TableCategory::find()->all();
		$modelPost = TablePost::find()->where(['post_type'=>Constants::PAGE])->all();
		$arrData[] = [
			'label' => 'No Url',
			'value' => '--null--',
		];

		if($modelCategory)
		{
			foreach ($modelCategory as $value) {
				$arrData[] = [
					'label' => $value['category_name'].'(category)',
					'value' => $value['category_name'],
				];
			}
		}

		if($modelPost)
		{
			foreach ($modelPost as  $value) {
				$arrData[] = [
					'label' => $value['post_title'].'(page)',
					'value' => $value['post_url_alias'],
				];
			}
		}

		return $arrData;
	}

}