<?php

use yii\db\Migration;

/**
 * Class m191204_105719_insert_app_config
 */
class m191204_105719_insert_app_config extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $data = [
            ['deskripsi','Lorem Ipsum'],
            ['nomor_hp','0195310295'],
            ['email','support@devmall.test'],
            ['alamat','Jl Subrantas km 5'],
            ['faq','FAQ'],
            ['tos','term of service'],
            ['download','Cara Download'],
            ['beli','Cara Beli'],
            ['pembayaran','Cara Bayar'],
            ['refund','Cara Refund'],
            ['nego','Cara Nego'],
            ['cicil','Cara cicil'],
        ];

        $this->batchInsert('{{%config}}',['key','value'],$data);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%config}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191204_105719_insert_app_config cannot be reverted.\n";

        return false;
    }
    */
}
