<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'level' => $this->integer(2)->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->execute('INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `level`, `created_at`, `updated_at`) VALUES(1, "muribudiman", "bH6TzAW14WCsApOrNJa9xCXMURJD-tYO", "$2y$13$ZhJaFCaf24xdlkUoNA9vV.9jxLTLz5XXl8jYR14jzlrAeUSKzRGHm", NULL, "udamuri@gmail.com", 10, 84, 1469931763, 1477723541)');
        
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
