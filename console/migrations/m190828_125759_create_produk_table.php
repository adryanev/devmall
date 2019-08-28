<?php

use common\helpers\TextTypesTrait;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%produk}}`.
 */
class m190828_125759_create_produk_table extends Migration
{

    use TextTypesTrait;
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

        $this->createTable('{{%produk}}', [
            'id' => $this->primaryKey(),
            'id_booth'=>$this->integer()->unique(),
            'nama'=>$this->string(),
            'deskripsi'=>$this->text()->notNull(),
            'spesifikasi'=>$this->text()->notNull(),
            'fitur'=>$this->text()->notNull(),
            'harga'=>$this->bigInteger(),
            'demo'=>$this->string(),
            'manual'=>$this->string(),
            'nego'=>$this->boolean(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);

        $this->addForeignKey('fk-produk-booth','{{%produk}}','id','{{%booth}}','id','cascade','cascade');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%produk}}');
    }
}
