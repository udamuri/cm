<?php
namespace backend\modules\catalog\models;

use app\components\Constants;
use yii\base\Model;
use backend\models\TableCatalog;
use yii\helpers\Html;
use Yii;
use backend\models\TableCatalogCategory;


class CatalogForm extends Model
{
    public $catalog_id;
    public $catalog_category_id;
    public $catalog_name;
    public $catalog_desc;
    public $imageFile;
  	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

			['catalog_name', 'filter', 'filter' => 'trim'],
            ['catalog_name', 'required'],
            ['catalog_name', 'string', 'max' => 100],

            ['catalog_desc', 'filter', 'filter' => 'trim'],
            ['catalog_desc', 'required'],


            ['catalog_category_id', 'required'],
            ['catalog_category_id', 'integer'],

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
            $create = new TableCatalog();
            $create->catalog_name = trim(strip_tags($this->catalog_name));
            $create->catalog_desc = Html::encode($this->catalog_desc);
            $create->catalog_category_id = $this->catalog_category_id;
            $create->catalog_date = date('Y-m-d H:i:s');
            $create->catalog_image = '.'.$this->imageFile->extension;
            if($create->save(false)) 
            {
                $this->imageFile->saveAs(Yii::getAlias('@frontend').'/web/product/' . $create->catalog_id . '.' . $this->imageFile->extension);
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
            $update = TableCatalog::findOne($pid);
            $update->catalog_name = trim(strip_tags($this->catalog_name));
            $update->catalog_desc = Html::encode($this->catalog_desc);
            $update->catalog_category_id = $this->catalog_category_id;
            $update->catalog_date = date('Y-m-d H:i:s');
            if( $this->imageFile )
            {
                $update->catalog_image = '.'.$this->imageFile->extension;
            }
            if($update->save(false)) 
            {
                if( $this->imageFile )
                {
                    $this->imageFile->saveAs(Yii::getAlias('@frontend').'/web/product/' . $update->catalog_id . '.' . $this->imageFile->extension);
                }
                return true;
            }
        }
        
        return null;
    }

    public function updateimage($pid)
    {
        $update = TableCatalog::findOne($pid);
        $img = Yii::getAlias('@frontend').'/web/product/' . $update->catalog_id.$update->catalog_image;
        if(file_exists($img) && $update->catalog_image != '.png')
        {
            unlink($img);  
        }
        
        $update->catalog_image = '.png';
        $update->save(false);
        return true;
    }

    public function getCatalog($p_id)
    {
        $model = $this->findModel($p_id);

        $arrData = array(
                'catalog_id'=>$model['catalog_id'],
                'catalog_name'=>$model['catalog_name'],
                'catalog_category_id'=>$model['catalog_category_id'],
                'catalog_desc'=>$model['catalog_desc'],
                'catalog_image'=>$model['catalog_image'],
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
        if($model->catalog_status == 1)
        {
          $model->catalog_status = 0;
          $_b_class = 'btn btn-xs btn-danger status-catalog';
          $_b_icon = 'fa fa-times-circle';
        }
        else
        {
          $model->catalog_status = 1;
          $_b_class = 'btn btn-xs btn-primary status-catalog';
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

    public function deleteCatalog($p_id)
    {
        $delete = $this->findModel($p_id);

        $img = Yii::getAlias('@frontend').'/web/product/' . $delete->catalog_id.$delete->catalog_image;
        if(file_exists($img) && $delete->catalog_image != '.png')
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
            'catalog_name' => 'Catalog Name',
            'catalog_category_id' => 'Category',
            'catalog_desc' => 'Description',
            'imageFile' => 'Image',
        ];
    }

    public function getCategoryData()
    {
        $module = TableCatalogCategory::find()->all();
        $arrData = [
            'category_id' => '',
            'category_name' => ''
        ];

        foreach ( $module  as $value) {
            $arrData[] = [
                'category_id' => $value['category_id'],
                'category_name' => $value['category_name'],
            ];
        }
       

        return $arrData;
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
        if (($model = TableCatalog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
