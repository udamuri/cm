<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_catalog_category".
 *
 * @property integer $category_id
 * @property integer $category_parent_id
 * @property string $category_name
 * @property integer $category_status
 */
class TableCatalogCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_catalog_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_parent_id'], 'integer'],
            [['category_name'], 'required'],
            [['category_name'], 'string', 'max' => 100],
            [['category_status'], 'integer', 'max' => 99],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_parent_id' => 'Category Parent ID',
            'category_name' => 'Category Name',
            'category_status' => 'Category Status',
        ];
    }
}
