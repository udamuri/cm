<?php

use yii\db\Migration;

class m170110_003158_tbl_post extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('tbl_post', [
            'post_id' => $this->primaryKey(15),
            'post_category_id' => $this->integer(11)->defaultValue(0),
            'post_title' => $this->string(100)->notNull(),
            'post_url_alias' => $this->string(255)->notNull()->unique(),
            'post_content' => $this->text(),
            'post_date' => $this->dateTime(),
            'post_modified' => $this->dateTime(),
            'post_excerpt' => $this->text(),
            'post_status' => $this->integer(1)->defaultValue(0),
            'post_type' => $this->integer(1)->defaultValue(0), // 0 page, 1 post
            'user_id' => $this->integer(11)->defaultValue(0),
        ], $tableOptions);
        
        $this->createIndex('post_id', 'tbl_post', 'post_id', false );
        $this->createIndex('post_category_id', 'tbl_post', 'post_category_id', false );
        $this->createIndex('user_id', 'tbl_post', 'user_id', false );
    }   

    public function down()
    {
       $this->dropTable('tbl_post');
    }
}
