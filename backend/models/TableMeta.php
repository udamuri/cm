<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_meta".
 *
 * @property integer $meta_id
 * @property string $meta_key
 * @property string $meta_value
 * @property string $meta_date
 * @property integer $post_id
 */
class TableMeta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_meta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meta_key', 'meta_value'], 'required'],
            [['meta_date'], 'safe'],
            [['post_id'], 'integer'],
            [['meta_key'], 'string', 'max' => 100],
            [['meta_value'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'meta_id' => 'Meta ID',
            'meta_key' => 'Meta Key',
            'meta_value' => 'Meta Value',
            'meta_date' => 'Meta Date',
            'post_id' => 'Post ID',
        ];
    }
}
