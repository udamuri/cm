<?php 

namespace backend\modules\file\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use backend\models\TableFile;
use yii\data\Pagination;
use yii\widgets\LinkPager;

class FileModel extends Model
{
    
    public function getFile($search = "")
    {
    	 $query = (new \yii\db\Query())
                    ->select([
                        'tc.file_id',
                        'tc.file_name',
                        'tc.file_folder',
                        'tc.file_type',
                        'tc.file_size',
                        'tc.file_date_upload',
                        'tc.file_extension',
                        'tc.user_id'
                    ])
                    ->from('tbl_file tc')
                    ->where('1');
        if(!empty($search))
        {
        	$query->where('lower(tc.file_name) LIKE "%'.$search.'%" ');
        }

        $countQuery = clone $query;
        $pageSize = 24;
        //$pageSize = 1;

        $pages = new Pagination([
                'totalCount' => $countQuery->count(), 
                'pageSize'=>$pageSize
            ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['file_id'=>SORT_DESC])
            ->all();

        $arrData = [];
        foreach ($models as  $value) {
            $url = Yii::$app->mycomponent->getImage($value['file_id'].'.'.$value['file_extension'], $value['file_folder']);
            $url_resize = Yii::$app->mycomponent->getImage($value['file_id'].'_resize.'.$value['file_extension'], $value['file_folder']);
            $full_url = Yii::$app->mycomponent->getHttpUrl('/cm-admin');

            $img_url = $url ? $url : '';
            $img_url_resize = $url_resize ? $url_resize : '';


            $arrData[] = [
                'file_id'=>$value['file_id'],
                'file_name'=>$value['file_name'],
                'file_folder'=>$value['file_folder'],
                'file_type'=>$value['file_type'],
                'file_size'=>$value['file_size'],
                'file_date_upload'=>$value['file_date_upload'],
                'file_extension'=>$value['file_extension'],
                'img_url'=>$img_url.'?'.time(),
                'img_url_resize'=>$img_url_resize.'?'.time(),
            ];

        }

        $arrData = [
            'models' => $arrData,
            'pages' => $pages,
            'offset' =>$pages->offset,
            'page' =>$pages->page,
            'search' =>$search,
            'getPage' => $this->getPage($pages)
        ];

        return \yii\helpers\Json::encode($arrData);
    }

    private function getPage($pages)
    {
    	return LinkPager::widget([
            'pagination' => $pages,
        ]);
    }
}
