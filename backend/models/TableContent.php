<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_content".
 *
 * @property integer $content_id
 * @property integer $content_category_id
 * @property string $content_label
 * @property string $content_desc
 * @property string $content_date
 * @property integer $content_status
 * @property string $content_meta_keyword
 * @property string $content_meta_desc
 * @property integer $content_user_id
 */
class TableContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_category_id', 'content_label', 'content_desc', 'content_date', 'content_status', 'content_meta_keyword', 'content_meta_desc', 'content_user_id'], 'required'],
            [['content_category_id', 'content_status', 'content_user_id'], 'integer'],
            [['content_desc'], 'string'],
            [['content_date'], 'safe'],
            [['content_label'], 'string', 'max' => 100],
            [['content_meta_keyword', 'content_meta_desc'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'content_id' => 'Content ID',
            'content_category_id' => 'Content Category ID',
            'content_label' => 'Content Label',
            'content_desc' => 'Content Desc',
            'content_date' => 'Content Date',
            'content_status' => 'Content Status',
            'content_meta_keyword' => 'Content Meta Keyword',
            'content_meta_desc' => 'Content Meta Desc',
            'content_user_id' => 'Content User ID',
        ];
    }
}
