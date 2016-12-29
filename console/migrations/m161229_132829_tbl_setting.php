<?php

use yii\db\Migration;

class m161229_132829_tbl_setting extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('tbl_setting', [
            'setting_id' => $this->primaryKey(),
            'setting_name' => $this->string(100)->notNull(),
            'setting_content' => $this->string(256)->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('tbl_setting');
    }

}
