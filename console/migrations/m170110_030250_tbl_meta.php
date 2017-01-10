<?php

use yii\db\Migration;

class m170110_030250_tbl_meta extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('tbl_meta', [
            'meta_id' => $this->primaryKey(15),
            'meta_key' => $this->string(100)->notNull(),
            'meta_value' => $this->string(256)->notNull(),
            'meta_date' => $this->dateTime(),
            'post_id' => $this->integer(15)->defaultValue(0),
        ], $tableOptions);
        
        $this->createIndex('post_id', 'tbl_meta', 'post_id', false );
    }   

    public function down()
    {
       $this->dropTable('tbl_meta');
    }
}
