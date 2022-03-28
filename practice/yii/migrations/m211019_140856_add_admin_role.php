<?php

use yii\db\Migration;

class m211019_140856_add_admin_role extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $seeDetails = $auth->createPermission('seeDetails');
        $seeDetails->description = 'See Details';
        $auth->add($seeDetails);

        $auth->addChild($admin, $seeDetails);
    }

    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $seeDetails = $auth->getPermission('seeDetails');
        $auth->remove($seeDetails);

        $admin = $auth->getRole('admin');
        $auth->remove($admin);
    }
}
