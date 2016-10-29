<?php
namespace backend\modules\setting\models;

use app\components\Constants;
use yii\base\Model;
use backend\models\TableOptions;
use Yii;

/**
 * This is the model class for table "tbl_options".
 *
 * @property integer $option_id
 * @property string $option_name
 * @property string $option_label
 * @property string $option_value
 * @property string $option_autoload
 * @property string $option_status
 */

class OptionForm extends Model
{
    public $setting_id;
    public $option_value;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			    //['option_value[0]', 'filter', 'filter' => 'trim'],
          //['option_value[0]', 'required'],
        ];
    }
	
   
    /**
     * Update Option.
     *
     * @return option_value|null the saved model or null if saving fails
    */
    public function update()
    {
        return var_dump($this->option_value);
    }

    public function getDetOption($oid)
    {
        $model = $this->findModel($oid);

        $arrData = array(
                'option_id'=>$model['option_id'],
                'option_name'=>$model['option_name'],
                'option_label'=>$model['option_label'],
                'option_value'=>$model['option_value'],
                'option_autoload'=>$model['option_autoload'],
                'option_status'=>$model['option_status'],
            );
        if($arrData)
        {
            return $arrData;   
        }

        return null;
       
    }

    public function getAllOption($load)
    {
        $model = TableOptions::find()
                ->where(['=', 'option_status', (string)$load])
                ->all();

        
        $arrData = [];
        foreach ($model as $value) {
            $arrData[] = [
                'option_id'=>$value['option_id'],
                'option_name'=>$value['option_name'],
                'option_label'=>$value['option_label'],
                'option_value'=>$value['option_value'],
                'option_autoload'=>$value['option_autoload'],
                'option_status'=>$value['option_status'],
            ];
        }

        
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
            'option_value' => 'Value',
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
        if (($model = TableOptions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}