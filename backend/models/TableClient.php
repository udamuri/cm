<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_client".
 *
 * @property integer $client_id
 * @property string $client_name
 * @property string $client_desc
 * @property string $client_image
 * @property integer $client_status
 */
class TableClient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_name', 'client_desc', 'client_image'], 'required'],
            [['client_desc'], 'string'],
            [['client_status'], 'integer'],
            [['client_name'], 'string', 'max' => 100],
            [['client_image'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'client_id' => 'Client ID',
            'client_name' => 'Client Name',
            'client_desc' => 'Client Desc',
            'client_image' => 'Client Image',
            'client_status' => 'Client Status',
        ];
    }
}
