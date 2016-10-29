<?php

namespace backend\models;

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
class TableOptions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_options';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['option_id', 'option_name', 'option_label', 'option_value', 'option_autoload', 'option_status'], 'required'],
            [['option_id'], 'integer'],
            [['option_value', 'option_status'], 'string'],
            [['option_name'], 'string', 'max' => 200],
            [['option_label'], 'string', 'max' => 255],
            [['option_autoload'], 'string', 'max' => 20],
            [['option_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'option_id' => 'Option ID',
            'option_name' => 'Option Name',
            'option_label' => 'Option Label',
            'option_value' => 'Option Value',
            'option_autoload' => 'Option Autoload',
            'option_status' => 'Option Status',
        ];
    }
}
