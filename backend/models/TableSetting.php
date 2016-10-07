<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_setting".
 *
 * @property integer $setting_id
 * @property string $setting_name
 * @property integer $setting_content
 */
class TableSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['setting_name', 'setting_content'], 'required'],
            [['setting_content'], 'string', 'max' => 256],
            [['setting_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'setting_id' => 'Setting ID',
            'setting_name' => 'Setting Name',
            'setting_content' => 'Setting Content',
        ];
    }
}
