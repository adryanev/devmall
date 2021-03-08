<?php

use yii\db\Migration;

/**
 * Class m210308_085517_alter_transaksi_permintaan_table
 */
class m210308_085517_alter_transaksi_permintaan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%transaksi_permintaan}}','code',$this->string());
        $this->addColumn('{{%transaksi_permintaan}}','order_date',$this->integer());
        $this->addColumn('{{%transaksi_permintaan}}','payment_due',$this->integer());
        $this->addColumn('{{%transaksi_permintaan}}','payment_status',$this->tinyInteger());
        $this->addColumn('{{%transaksi_permintaan}}','payment_token',$this->string());
        $this->addColumn('{{%transaksi_permintaan}}','payment_url',$this->string());
        $this->addColumn('{{%transaksi_permintaan}}','base_total_price',$this->bigInteger());
        $this->addColumn('{{%transaksi_permintaan}}','tax_amount',$this->bigInteger());
        $this->addColumn('{{%transaksi_permintaan}}','tax_percent',$this->decimal());
        $this->addColumn('{{%transaksi_permintaan}}','discount_amount',$this->bigInteger());
        $this->addColumn('{{%transaksi_permintaan}}','discount_percent',$this->decimal());
        $this->addColumn('{{%transaksi_permintaan}}','grand_total',$this->bigInteger());
        $this->addColumn('{{%transaksi_permintaan}}','note',$this->text());
        $this->addColumn('{{%transaksi_permintaan}}','cancelled_by',$this->integer());
        $this->addColumn('{{%transaksi_permintaan}}','cancelled_at',$this->integer());
        $this->addColumn('{{%transaksi_permintaan}}','cancellation_note',$this->text());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%transaksi_permintaan}}','code');
        $this->dropColumn('{{%transaksi_permintaan}}','order_date');
        $this->dropColumn('{{%transaksi_permintaan}}','payment_due');
        $this->dropColumn('{{%transaksi_permintaan}}','payment_status');
        $this->dropColumn('{{%transaksi_permintaan}}','payment_token');
        $this->dropColumn('{{%transaksi_permintaan}}','payment_url');
        $this->dropColumn('{{%transaksi_permintaan}}','base_total_price');
        $this->dropColumn('{{%transaksi_permintaan}}','tax_amount');
        $this->dropColumn('{{%transaksi_permintaan}}','tax_percent');
        $this->dropColumn('{{%transaksi_permintaan}}','discount_amount');
        $this->dropColumn('{{%transaksi_permintaan}}','discount_percent');
        $this->dropColumn('{{%transaksi_permintaan}}','grand_total');
        $this->dropColumn('{{%transaksi_permintaan}}','note');
        $this->dropColumn('{{%transaksi_permintaan}}','cancelled_by');
        $this->dropColumn('{{%transaksi_permintaan}}','cancelled_at');
        $this->dropColumn('{{%transaksi_permintaan}}','cancellation_note');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210308_085517_alter_transaksi_permintaan_table cannot be reverted.\n";

        return false;
    }
    */
}
