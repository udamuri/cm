<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_menu".
 *
 * @property integer $menu_id
 * @property integer $menu_rang
 * @property integer $menu_parent_id
 * @property string $menu_name
 * @property string $menu_icon
 * @property string $menu_publish
 * @property string $menu_link_module
 * @property string $menu_url
 * @property string $menu_description
 */
class TableMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_id', 'menu_rang', 'menu_parent_id', 'menu_name', 'menu_icon', 'menu_publish', 'menu_link_module', 'menu_url', 'menu_description'], 'required'],
            [['menu_id', 'menu_rang', 'menu_parent_id'], 'integer'],
            [['menu_publish', 'menu_description'], 'string'],
            [['menu_name', 'menu_url'], 'string', 'max' => 256],
            [['menu_icon'], 'string', 'max' => 255],
            [['menu_link_module'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menu_id' => 'Menu ID',
            'menu_rang' => 'Menu Rang',
            'menu_parent_id' => 'Menu Parent ID',
            'menu_name' => 'Menu Name',
            'menu_icon' => 'Menu Icon',
            'menu_publish' => 'Menu Publish',
            'menu_link_module' => 'Menu Link Module',
            'menu_url' => 'Menu Url',
            'menu_description' => 'Menu Description',
        ];
    }
}
