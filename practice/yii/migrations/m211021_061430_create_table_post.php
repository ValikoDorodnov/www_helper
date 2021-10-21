<?php

use yii\db\Migration;

class m211021_061430_create_table_post extends Migration
{
    private string $tableName = 'post';

    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id'   => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Имя поста'),
            'text' => $this->text()->notNull()->comment('Текст поста')
        ]);
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
