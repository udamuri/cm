<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_category".
 *
 * @property integer $category_id
 * @property string $category_name
 * @property string $category_date
 * @property integer $category_status
 * @property integer $user_id
 */
class TableCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name'], 'required'],
            [['category_date'], 'safe'],
            [['user_id'], 'integer'],
            [['category_status'], 'integer'],
            [['category_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
            'category_date' => 'Category Date',
            'category_status' => 'Category Status',
            'user_id' => 'User ID',
        ];
    }
}
