<?php

use yii\db\Migration;

/**
 * Class m210321_050551_add_source_to_coin_ledger_table
 */
class m210321_050551_add_source_to_coin_ledger_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%coin_ledger}}','source',$this->string());
        $this->addColumn('{{%coin_ledger}}','source_type',$this->string());


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%coin_ledger}}','source');
        $this->dropColumn('{{%coin_ledger}}','source_type');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210321_050551_add_source_to_coin_ledger_table cannot be reverted.\n";

        return false;
    }
    */
}
