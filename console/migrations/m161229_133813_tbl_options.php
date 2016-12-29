<?php

use yii\db\Migration;

class m161229_133813_tbl_options extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('tbl_options', [
            'option_id' => $this->primaryKey(),
            'option_name' => $this->string(200)->notNull(),
            'option_label' => $this->string(200)->notNull(),
            'option_value' => $this->text(),
            'option_autoload' => $this->string(20)->notNull(),
            'option_status' => $this->integer(1)->defaultValue(0),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('tbl_options');
    }

}
