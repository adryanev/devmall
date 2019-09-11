<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%nego}}`.
 */
class m190828_132834_create_nego_table extends Migration
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
        $this->createTable('{{%nego}}', [
            'id' => $this->primaryKey(),
            'id_produk'=>$this->integer()->unique(),
            'harga_satu'=>$this->bigInteger(),
            'harga_dua'=>$this->bigInteger(),
            'harga_tiga'=>$this->bigInteger(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);

        $this->addForeignKey('fk-nego-produk','{{%nego}}','id_produk','{{%produk}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%nego}}');
    }
}
