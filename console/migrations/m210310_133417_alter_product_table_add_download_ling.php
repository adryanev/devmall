<?php

use yii\db\Migration;

/**
 * Class m210310_133417_alter_product_table_add_download_ling
 */
class m210310_133417_alter_product_table_add_download_ling extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%produk}}','download_link',$this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('{{%produk}}','download_link');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210310_133417_alter_product_table_add_download_ling cannot be reverted.\n";

        return false;
    }
    */
}
