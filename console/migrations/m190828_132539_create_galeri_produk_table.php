<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%galeri_produk}}`.
 */
class m190828_132539_create_galeri_produk_table extends Migration
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
        $this->createTable('{{%galeri_produk}}', [
            'id' => $this->primaryKey(),
            'id_produk'=>$this->integer(),
            'keterangan'=>$this->string(),
            'nama_berkas'=>$this->string(),
            'jenis_berkas'=>$this->string(20),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);

        $this->addForeignKey('fk-galeri_produk-produk','{{%galeri_produk}}','id_produk','{{%produk}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%galeri_produk}}');
    }
}
