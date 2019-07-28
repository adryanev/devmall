<?php

use yii\db\Migration;

/**
 * Class m190727_151341_add_first_admin
 */
class m190727_151341_add_first_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%user}}',[
            'id'=>1,
            'username'=>'root',
            'auth_key'=>'Pwys0TRico7Ha4YSyX2fmjABrFskscxh',
            'password_hash'=>'$2y$13$tyy5A3UZe0ipSoaWDrbpXOfBE8bph0sawnVHrGu6RFfgD7Nihq9he',
            'password_reset_token'=>null,
            'email'=>'root@mutu.test',
            'status'=>10,
            'created_at'=>0,
            'updated_at'=>0,
            'verification_token'=>'Pwys0TRico7Ha4YSyX2fmjABrFskscxh'
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190727_151341_add_first_admin cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190727_151341_add_first_admin cannot be reverted.\n";

        return false;
    }
    */
}
