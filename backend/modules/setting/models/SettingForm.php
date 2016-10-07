<?php
namespace backend\modules\setting\models;

use app\components\Constants;
use yii\base\Model;
use backend\models\TableSetting;
use Yii;


class SettingForm extends Model
{
    public $setting_id;
    public $setting_name;
    public $setting_content;
  	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

			['setting_name', 'filter', 'filter' => 'trim'],
            ['setting_name', 'required'],
            ['setting_name', 'string', 'max' => 200],

            ['setting_content', 'filter', 'filter' => 'trim'],
            ['setting_content', 'required'],
            ['setting_content', 'string', 'max' => 256],
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
            $create = new TableSetting();
            $create->setting_name = trim(strip_tags($this->setting_name));
            $create->setting_content = trim(strip_tags($this->setting_content));
            if($create->save(false)) 
            {
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
            $update = TableSetting::findOne($pid);
            $update->setting_name = trim(strip_tags($this->setting_name));
            $update->setting_content = trim(strip_tags($this->setting_content));
            if($update->save(false)) 
            {
               return true;
            }
        }
        
        return null;
    }

    public function getSetting($p_id)
    {
        $model = $this->findModel($p_id);

        $arrData = array(
                'setting_name'=>$model['setting_name'],
                'setting_content'=>$model['setting_content'],
            );
        if($arrData)
        {
            return $arrData;   
        }

        return null;
       
    }
	

	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'setting_id' => 'ID',
            'setting_name' => 'Name',
            'setting_content' => 'Content',
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
        if (($model = TableSetting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
