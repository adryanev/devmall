<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%coin}}`.
 */
class m200227_123101_create_coin_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%coin}}', [
            'id' => $this->primaryKey(),
            'id_booth'=>$this->integer(),
            'saldo'=>$this->bigInteger(),
            'status'=>$this->tinyInteger(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ]);
        $this->addForeignKey('fk-coin-booth', '{{%coin}}', 'id_booth', '{{%booth}}', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-coin-booth', '{{%coin}}');
        $this->dropTable('{{%coin}}');
    }
}
