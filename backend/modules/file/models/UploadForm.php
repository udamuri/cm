<?php 

namespace backend\modules\file\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use backend\models\TableFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, gif, jpeg', 'maxFiles' => 4],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $foldernow = date('Y').'_'.date('m').'/';
            $location = Yii::getAlias('@frontend').'/web/media/'.$foldernow;
            Yii::$app->mycomponent->createDirectory($location);
            foreach ($this->imageFiles as $file) {
                $model = new TableFile();

                $model->file_name = $file->name;
                $model->file_folder = $foldernow;
                $model->file_type = $file->type;
                $model->file_size = $file->size;
                $model->file_date_upload = Date('Y-m-d H:i:s');
                $model->user_id = Yii::$app->user->identity->id;
                if($model->save(false))
                {
                    $file->saveAs($location.$model->file_id.'.'.$file->extension);
                }
               
            }
            return true;
        } else {
            return false;
        }
    }
}
