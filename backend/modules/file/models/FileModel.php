<?php 

namespace backend\modules\file\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use backend\models\TableFile;

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
                    ->from('tbl_file tc');
    }

    private function getCountFile()
    {
    	$count = TableFile::find()->count();
    	return $count;
    }
}
