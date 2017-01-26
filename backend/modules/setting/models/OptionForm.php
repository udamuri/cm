<?php
namespace backend\modules\setting\models;

use app\components\Constants;
use yii\base\Model;
use yii\helpers\Html;
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
    public $option_id;
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
    public function update($value)
    {
        if(is_array($value))
        {
            $_id = $value['option_id'];
            $_value = $value['option_value'];
            foreach ($_id as $key=>$value) {
              $model = $this->findModel($key);
              $model->option_value = Html::encode($_value[$key]);
              $model->save(false);
            }

            return true;
        }

        return false;
    }

    public function getDetOption($oid)
    {
        $model = $this->findModel($oid);

        $arrData = array(
                'option_id'=>$model['option_id'],
                'option_name'=>$model['option_name'],
                'option_label'=>$model['option_label'],
                'option_value'=>Html::decode($model['option_value']),
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
                'option_value'=>Html::decode($value['option_value']),
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