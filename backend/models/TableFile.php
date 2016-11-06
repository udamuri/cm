<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_file".
 *
 * @property integer $file_id
 * @property string $file_name
 * @property string $file_type
 * @property integer $file_size
 * @property string $file_date_upload
 * @property integer $user_id
 */
class TableFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_name', 'file_type', 'file_size', 'file_date_upload', 'user_id', 'file_folder'], 'required'],
            [['file_size', 'user_id'], 'integer'],
            [['file_date_upload'], 'safe'],
            [['file_folder'], 'string', 'max' => 10],
            [['file_name'], 'string', 'max' => 256],
            [['file_type'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file_id' => 'File ID',
            'file_name' => 'File Name',
            'file_name' => 'File Folder',
            'file_type' => 'File Type',
            'file_size' => 'File Size',
            'file_date_upload' => 'File Date Upload',
            'user_id' => 'User ID',
        ];
    }
}
