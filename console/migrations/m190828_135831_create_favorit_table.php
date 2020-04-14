<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favorit}}`.
 */
class m190828_135831_create_favorit_table extends Migration
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
        $this->createTable('{{%favorit}}', [
            'id' => $this->primaryKey(),
            'id_produk'=>$this->integer(),
            'id_user'=>$this->integer(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);

        $this->addForeignKey('fk-favorit-produk','{{%favorit}}','id_produk','{{%produk}}','id','cascade','cascade');
        $this->addForeignKey('fk-favorit-user','{{%favorit}}','id_user','{{%user}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%favorit}}');
    }
}
