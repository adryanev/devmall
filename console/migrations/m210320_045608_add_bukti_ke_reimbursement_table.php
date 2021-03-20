<?php

use yii\db\Migration;

/**
 * Class m210320_045608_add_bukti_ke_reimbursement_table
 */
class m210320_045608_add_bukti_ke_reimbursement_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%reimbursement}}','bukti',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%reimbursement}}','bukti');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210320_045608_add_bukti_ke_reimbursement_table cannot be reverted.\n";

        return false;
    }
    */
}
