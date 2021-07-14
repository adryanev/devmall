<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%coin_ledger}}`.
 */
class m210304_083042_create_coin_ledger_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%coin_ledger}}', [
            'id' => $this->primaryKey(),
            'id_coin'=>$this->integer(),
            'type'=>$this->tinyInteger(),
            'amount'=>$this->bigInteger(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ]);
        $this->addForeignKey('fk-ledger-coin','{{%coin_ledger}}','id_coin','{{%coin}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%coin_ledger}}');
    }
}
