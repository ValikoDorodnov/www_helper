<?php

use app\models\User;
use yii\db\Migration;

class m211014_134154_create_admin_user extends Migration
{
    public function safeUp()
    {
        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@admin.com';
        $user->setPassword('admin');
        $user->save();
    }

    public function safeDown()
    {
        $user = User::findByUsername('admin');
        $user?->delete();
    }
}
