<?php

use yii\db\Migration;

/**
 * Class m210203_110503_alter_table_payments
 */
class m210203_110503_alter_table_payments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%payments}}','snap_token',$this->string());
        $this->dropColumn('{{%payments}}', 'payloads');
        $this->dropColumn('{{%payments}}', 'token');
        $this->dropColumn('{{%payments}}', 'va_number');
        $this->dropColumn('{{%payments}}', 'vendor_name');
        $this->dropColumn('{{%payments}}', 'biller_code');
        $this->dropColumn('{{%payments}}', 'bill_key');
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->dropColumn('{{%payments}}','snap_token');
        $this->addColumn('{{%payments}}', 'payloads', $this->json());
        $this->addColumn('{{%payments}}', 'token', $this->string());
        $this->addColumn('{{%payments}}', 'va_number', $this->string());
        $this->addColumn('{{%payments}}', 'vendor_name', $this->string());
        $this->addColumn('{{%payments}}', 'biller_code', $this->string());
        $this->addColumn('{{%payments}}', 'bill_key', $this->string());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210203_110503_alter_table_payments cannot be reverted.\n";

        return false;
    }
    */
}
