<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reimbursement}}`.
 */
class m210317_102149_create_reimbursement_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reimbursement}}', [
            'id' => $this->primaryKey(),
            'id_booth'=>$this->integer(),
            'amount'=>$this->bigInteger(),
            'bank'=>$this->string(),
            'nomor_rekening'=>$this->string(),
            'status'=>$this->string(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ]);
        $this->addForeignKey('fk-reimbursement-booth','{{%reimbursement}}','id_booth','{{%booth}}','id','cascade',
        'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%reimbursement}}');
    }
}
