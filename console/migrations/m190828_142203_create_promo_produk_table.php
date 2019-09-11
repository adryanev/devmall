<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%promo_produk}}`.
 */
class m190828_142203_create_promo_produk_table extends Migration
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
        $this->createTable('{{%promo_produk}}', [
            'id' => $this->primaryKey(),
            'id_promo'=>$this->integer(),
            'id_produk'=>$this->integer(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);

        $this->addForeignKey('fk-promo_produk-promo','{{%promo_produk}}','id_promo','{{%promo}}','id','cascade','cascade');
        $this->addForeignKey('fk-promo_produk-produk','{{%promo_produk}}','id_produk','{{%produk}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%promo_produk}}');
    }
}
