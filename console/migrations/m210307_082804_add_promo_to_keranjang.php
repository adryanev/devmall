<?php

use yii\db\Migration;

/**
 * Class m210307_082804_add_promo_to_keranjang
 */
class m210307_082804_add_promo_to_keranjang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%keranjang}}','promo',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('{{%keranjang}}','promo');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210307_082804_add_promo_to_keranjang cannot be reverted.\n";

        return false;
    }
    */
}
