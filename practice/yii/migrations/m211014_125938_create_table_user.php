<?php

use yii\db\Migration;

class m211014_125938_create_table_user extends Migration
{
    private string $tableName = 'user';

    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id'            => $this->primaryKey(),
            'username'      => $this->string()->notNull()->unique(),
            'auth_key'      => $this->string(32),
            'password_hash' => $this->string()->notNull(),
            'email'         => $this->string()->notNull()->unique(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
