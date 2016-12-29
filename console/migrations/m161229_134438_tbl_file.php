<?php

use yii\db\Migration;

class m161229_134438_tbl_file extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('tbl_file', [
            'file_id' => $this->primaryKey(),
            'file_name' => $this->string(256)->notNull(),
            'file_folder' => $this->string(10)->notNull(),
            'file_type' => $this->string(50)->notNull(),
            'file_size' => $this->integer(11)->defaultValue(0),
            'file_date_upload' => $this->dateTime(),
            'user_id' => $this->integer(11)->defaultValue(0),
        ], $tableOptions);
    }   

    public function down()
    {
       $this->dropTable('tbl_file');
    }
    
}
