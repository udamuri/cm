<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_post".
 *
 * @property integer $post_id
 * @property integer $post_category_id
 * @property string $post_title
 * @property string $post_content
 * @property string $post_date
 * @property string $post_modified
 * @property string $post_excerpt
 * @property integer $post_status
 * @property integer $post_type
 * @property integer $user_id
 */
class TablePost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_category_id', 'post_status', 'post_type', 'user_id'], 'integer'],
            [['post_title'], 'required'],
            [['post_content', 'post_excerpt'], 'string'],
            [['post_date', 'post_modified'], 'safe'],
            [['post_title', 'post_url_alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'post_category_id' => 'Post Category ID',
            'post_title' => 'Post Title',
            'post_url_alias' => 'Post URL Alias',
            'post_content' => 'Post Content',
            'post_date' => 'Post Date',
            'post_modified' => 'Post Modified',
            'post_excerpt' => 'Post Excerpt',
            'post_status' => 'Post Status',
            'post_type' => 'Post Type',
            'user_id' => 'User ID',
        ];
    }
}
