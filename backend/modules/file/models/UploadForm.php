<?php 

namespace backend\modules\file\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use backend\models\TableFile;
use udamuri\imagethum\ImageThum;

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
                $model->file_extension = $file->extension;
                $model->file_date_upload = Date('Y-m-d H:i:s');
                $model->user_id = Yii::$app->user->identity->id;
                if($model->save(false))
                {
                    $file->saveAs($location.$model->file_id.'.'.$file->extension);
                    $ext = strtolower($file->extension);
                    if($ext == 'png' OR $ext == 'jpg' OR $ext == 'gif' OR $ext == 'jpeg')
                    {
                        $target_file = $location.$model->file_id.'.'.$file->extension;
                        $resized_file = $location.$model->file_id.'_resize.'.$file->extension;
                        $wmax = 300;
                        $hmax = 300;
                        $fileExt = $file->extension;
                        ImageThum::resize($target_file, $resized_file, $wmax, $hmax, $fileExt);

                        $thumbnail = $location.$model->file_id.'_thumb.'.$file->extension;
                        $wthumb = 150;
                        $hthumb = 150;
                        ImageThum::thumb($target_file, $thumbnail, $wthumb, $hthumb, $fileExt);
                    }
                }
               
            }
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $model = TableFile::findOne($id);

        if($model)
        {
            Yii::$app->mycomponent->deleteFile($model->file_id.'.'.$model->file_extension , $model->file_folder);
            Yii::$app->mycomponent->deleteFile($model->file_id.'_resize.'.$model->file_extension , $model->file_folder);
            Yii::$app->mycomponent->deleteFile($model->file_id.'_thumb.'.$model->file_extension , $model->file_folder);
            if($model->delete())
            {
                return true;
            }
        }
    }
}
