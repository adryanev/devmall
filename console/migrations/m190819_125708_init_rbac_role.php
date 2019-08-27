<?php

use yii\db\Migration;

/**
 * Class m190819_125708_init_rbac_role
 */
class m190819_125708_init_rbac_role extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $superadmin = $auth->createRole('superadmin');
        $admin = $auth->createRole('admin');
        $penjual = $auth->createRole('penjual');
        $pengguna = $auth->createRole('pengguna');

        $auth->add($superadmin);
        $auth->add($admin);
        $auth->add($penjual);
        $auth->add($pengguna);

        $auth->assign($superadmin,1);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190819_125708_init_rbac_role cannot be reverted.\n";

        return false;
    }
    */
}
