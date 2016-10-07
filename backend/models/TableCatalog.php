<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_catalog".
 *
 * @property integer $catalog_id
 * @property string $catalog_name
 * @property string $catalog_desc
 * @property string $catalog_date
 * @property integer $catalog_status
 * @property string $catalog_meta_keywords
 * @property string $catalog_meta_desc
 */
class TableCatalog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_catalog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['catalog_name', 'catalog_desc', 'catalog_date', 'catalog_status', 'catalog_meta_keywords', 'catalog_meta_desc'], 'required'],
            [['catalog_desc'], 'string'],
            [['catalog_date'], 'safe'],
            [['catalog_status', 'catalog_category_id'], 'integer'],
            [['catalog_name'], 'string', 'max' => 100],
            [['catalog_image'], 'string', 'max' => 5],
            [['catalog_meta_keywords', 'catalog_meta_desc'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'catalog_id' => 'Catalog ID',
            'catalog_name' => 'Catalog Name',
            'catalog_desc' => 'Catalog Desc',
            'catalog_date' => 'Catalog Date',
            'catalog_status' => 'Catalog Status',
            'catalog_meta_keywords' => 'Catalog Meta Keywords',
            'catalog_meta_desc' => 'Catalog Meta Desc',
            'catalog_meta_desc' => 'Catalog Image',
        ];
    }
}
