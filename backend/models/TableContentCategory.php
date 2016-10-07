<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_content_category".
 *
 * @property integer $cat_id
 * @property integer $cat_parent_id
 * @property string $cat_name
 * @property integer $cat_status
 */
class TableContentCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_content_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_parent_id', 'cat_name', 'cat_status'], 'required'],
            [['cat_parent_id', 'cat_status'], 'integer'],
            [['cat_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => 'Cat ID',
            'cat_parent_id' => 'Cat Parent ID',
            'cat_name' => 'Cat Name',
            'cat_status' => 'Cat Status',
        ];
    }
}
