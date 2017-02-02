<?php

use yii\db\Migration;

class m170110_043454_tbl_category extends Migration
{
   public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('tbl_category', [
            'category_id' => $this->primaryKey(15),
            'category_name' => $this->string(255)->notNull()->unique(),
            'category_date' => $this->dateTime(),
            'category_status' => $this->integer(1)->defaultValue(0),
            'user_id' => $this->integer(11)->defaultValue(0),
        ], $tableOptions);
        
        $this->createIndex('category_id', 'tbl_category', 'category_id', false );
    }   

    public function down()
    {
       $this->dropTable('tbl_category');
    }
}
