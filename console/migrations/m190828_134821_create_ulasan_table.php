<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ulasan}}`.
 */
class m190828_134821_create_ulasan_table extends Migration
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
        $this->createTable('{{%ulasan}}', [
            'id' => $this->primaryKey(),
            'id_produk'=>$this->integer(),
            'id_user'=>$this->integer(),
            'nilai'=>$this->float(),
            'komentar'=>$this->string(),
        ],$tableOptions);

        $this->addForeignKey('fk-ulasan-produk','{{%ulasan}}','id_produk','{{%produk}}','id','cascade','cascade');
        $this->addForeignKey('fk-ulasan-user','{{%ulasan}}','id_user','{{%user}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ulasan}}');
    }
}
