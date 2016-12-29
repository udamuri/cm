<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "nestamenu".
 *
 * @property integer $menu_id
 * @property integer $menu_parent_id
 * @property integer $menu_sort
 * @property string $menu_title
 * @property string $menu_link
 * @property integer $menu_status
 */
class Nestamenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nestamenu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_parent_id', 'menu_sort', 'menu_status'], 'integer'],
            [['menu_title'], 'string', 'max' => 100],
            [['menu_link'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menu_id' => 'Menu ID',
            'menu_parent_id' => 'Menu Parent ID',
            'menu_sort' => 'Menu Sort',
            'menu_title' => 'Menu Title',
            'menu_link' => 'Menu Link',
            'menu_status' => 'Menu Status',
        ];
    }
}
