<?php

use yii\db\Migration;

class m161124_070732_create_news_nestamenu extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%nestamenu}}', [
            'menu_id' => $this->primaryKey(),
            'menu_parent_id' => $this->integer(3)->notNull()->defaultValue(0),
            'menu_sort' => $this->integer(3)->notNull(),
            'menu_title' => $this->string(100)->notNull(),
            'menu_link' => $this->string(255),
            'menu_status' => $this->smallInteger()->notNull()->defaultValue(1),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%nestamenu}}');
    }
}
