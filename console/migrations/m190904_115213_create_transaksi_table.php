<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transaksi}}`.
 */
class m190904_115213_create_transaksi_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%transaksi_produk}}', [
            'id' => $this->primaryKey(),
            'id_user'=>$this->integer(),
            'waktu'=>$this->integer(),
            'total'=>$this->bigInteger(),
            'status'=>$this->tinyInteger(),
            'expire'=>$this->integer(),
            'metode_pembayaran'=>$this->string(6),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()

        ],$tableOptions);

        $this->addForeignKey('fk-transaksi-user','{{%transaksi_produk}}','id_user','{{%user}}','id','cascade','cascade');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%transaksi_produk}}');
    }
}
