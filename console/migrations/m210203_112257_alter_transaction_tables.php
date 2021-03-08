<?php

use yii\db\Migration;

/**
 * Class m210203_112257_alter_transaction_tables
 */
class m210203_112257_alter_transaction_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {


        $this->addColumn('{{%transaksi_produk}}','code',$this->string());
        $this->addColumn('{{%transaksi_produk}}','order_date',$this->integer());
        $this->addColumn('{{%transaksi_produk}}','payment_due',$this->integer());
        $this->addColumn('{{%transaksi_produk}}','payment_status',$this->tinyInteger());
        $this->addColumn('{{%transaksi_produk}}','payment_token',$this->string());
        $this->addColumn('{{%transaksi_produk}}','payment_url',$this->string());
        $this->addColumn('{{%transaksi_produk}}','base_total_price',$this->bigInteger());
        $this->addColumn('{{%transaksi_produk}}','tax_amount',$this->bigInteger());
        $this->addColumn('{{%transaksi_produk}}','tax_percent',$this->decimal());
        $this->addColumn('{{%transaksi_produk}}','discount_amount',$this->bigInteger());
        $this->addColumn('{{%transaksi_produk}}','discount_percent',$this->decimal());
        $this->addColumn('{{%transaksi_produk}}','grand_total',$this->bigInteger());
        $this->addColumn('{{%transaksi_produk}}','note',$this->text());
        $this->addColumn('{{%transaksi_produk}}','cancelled_by',$this->integer());
        $this->addColumn('{{%transaksi_produk}}','cancelled_at',$this->integer());
        $this->addColumn('{{%transaksi_produk}}','cancellation_note',$this->text());

        $this->dropColumn('{{%transaksi_detail}}','harga_transaksi');
        $this->addColumn('{{%transaksi_detail}}','base_price',$this->bigInteger());
        $this->addColumn('{{%transaksi_detail}}','tax_amount',$this->bigInteger());
        $this->addColumn('{{%transaksi_detail}}','tax_percent',$this->decimal());
        $this->addColumn('{{%transaksi_detail}}','discount_amount',$this->bigInteger());
        $this->addColumn('{{%transaksi_detail}}','discount_percent',$this->decimal());
        $this->addColumn('{{%transaksi_detail}}','bargain_price',$this->bigInteger());
        $this->addColumn('{{%transaksi_detail}}','sub_total',$this->bigInteger());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%transaksi_produk}}','code');
        $this->dropColumn('{{%transaksi_produk}}','order_date');
        $this->dropColumn('{{%transaksi_produk}}','payment_due');
        $this->dropColumn('{{%transaksi_produk}}','payment_status');
        $this->dropColumn('{{%transaksi_produk}}','payment_token');
        $this->dropColumn('{{%transaksi_produk}}','payment_url');
        $this->dropColumn('{{%transaksi_produk}}','base_total_price');
        $this->dropColumn('{{%transaksi_produk}}','tax_amount');
        $this->dropColumn('{{%transaksi_produk}}','tax_percent');
        $this->dropColumn('{{%transaksi_produk}}','discount_amount');
        $this->dropColumn('{{%transaksi_produk}}','discount_percent');
        $this->dropColumn('{{%transaksi_produk}}','grand_total');
        $this->dropColumn('{{%transaksi_produk}}','note');
        $this->dropColumn('{{%transaksi_produk}}','cancelled_by');
        $this->dropColumn('{{%transaksi_produk}}','cancelled_at');
        $this->dropColumn('{{%transaksi_produk}}','cancellation_note');

        $this->addColumn('{{%transaksi_detail}}','harga_transaksi',$this->bigInteger());
        $this->dropColumn('{{%transaksi_detail}}','base_price');
        $this->dropColumn('{{%transaksi_detail}}','tax_amount');
        $this->dropColumn('{{%transaksi_detail}}','tax_percent');
        $this->dropColumn('{{%transaksi_detail}}','discount_amount');
        $this->dropColumn('{{%transaksi_detail}}','discount_percent');
        $this->dropColumn('{{%transaksi_detail}}','bargain_price');
        $this->dropColumn('{{%transaksi_detail}}','sub_total');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210203_112257_alter_transaction_tables cannot be reverted.\n";

        return false;
    }
    */
}
