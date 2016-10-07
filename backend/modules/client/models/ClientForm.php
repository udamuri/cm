<?php
namespace backend\modules\client\models;

use app\components\Constants;
use yii\base\Model;
use backend\models\TableCatalog;
use yii\helpers\Html;
use Yii;
use backend\models\TableClient;


class ClientForm extends Model
{
    public $client_id;
    public $client_name;
    public $client_desc;
    public $imageFile;
  	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

			['client_name', 'filter', 'filter' => 'trim'],
            ['client_name', 'required'],
            ['client_name', 'string', 'max' => 100],

            ['client_desc', 'filter', 'filter' => 'trim'],
            ['client_desc', 'required'],

            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif', 'on' => 'insert'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif', 'on' => 'update'],
        ];
    }
	
    /**
     * Create Pasien.
     *
     * @return user|null the saved model or null if saving fails
    */
    public function create()
    {
        if ($this->validate()) {
            $create = new TableClient();
            $create->client_name = trim(strip_tags($this->client_name));
            $create->client_desc = Html::encode($this->client_desc);
            $create->client_image = '.'.$this->imageFile->extension;
            if($create->save(false)) 
            {
                $this->imageFile->saveAs(Yii::getAlias('@frontend').'/web/client/' . $create->client_id . '.' . $this->imageFile->extension);
                return true;
            }
        }

        return null;
    }

    /**
     * Update Pasien.
     *
     * @return user|null the saved model or null if saving fails
    */
    public function update($pid)
    {
     
        if ($this->validate()) {
            $update = TableClient::findOne($pid);
            $update->client_name = trim(strip_tags($this->client_name));
            $update->client_desc = Html::encode($this->client_desc);
            if( $this->imageFile )
            {
                $update->client_image = '.'.$this->imageFile->extension;
            }
            if($update->save(false)) 
            {
                if( $this->imageFile )
                {
                    $this->imageFile->saveAs(Yii::getAlias('@frontend').'/web/client/' . $update->client_id . '.' . $this->imageFile->extension);
                }
                return true;
            }
        }
        
        return null;
    }

    public function updateimage($pid)
    {
        $update = TableClient::findOne($pid);
        $img = Yii::getAlias('@frontend').'/web/client/' . $update->client_id.$update->client_image;
        if(file_exists($img) && $update->client_image != '.png')
        {
            unlink($img);  
        }
        
        $update->client_image = '.png';
        $update->save(false);
        return true;
    }

    public function getClient($p_id)
    {
        $model = $this->findModel($p_id);

        $arrData = array(
                'client_id'=>$model['client_id'],
                'client_name'=>$model['client_name'],
                'client_desc'=>$model['client_desc'],
                'client_image'=>$model['client_image'],
            );
        if($arrData)
        {
            return $arrData;   
        }

        return null;
       
    }

    public function setStatus($p_id)
    {
        $model = $this->findModel($p_id);
        if($model->client_status == 1)
        {
          $model->client_status = 0;
          $_b_class = 'btn btn-xs btn-danger status-client';
          $_b_icon = 'fa fa-times-circle';
        }
        else
        {
          $model->client_status = 1;
          $_b_class = 'btn btn-xs btn-primary status-client';
          $_b_icon = 'fa fa-check-square-o';
        }

        if($model->save(false))
        {
            return [
                'status' => 'success',
                'icon' => $_b_icon,
                'btn' => $_b_class,
            ];
        }

        return false;
    }

    public function deleteClient($p_id)
    {
        $delete = $this->findModel($p_id);

        $img = Yii::getAlias('@frontend').'/web/client/' . $delete->client_id.$delete->client_image;
        if(file_exists($img) && $delete->client_image != '.png')
        {
            unlink($img);  
        }
    
        if($delete->delete())
        {
            return true;
        }

        return false;
    }
	
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'client_name' => 'Client Name',
            'client_desc' => 'Description',
            'imageFile' => 'Image',
        ];
    }

	
	/**
     * Finds the UserPost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserPost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TableClient::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
