<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%verifikasi_user}}`.
 */
class m190827_124005_create_verifikasi_user_table extends Migration
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
        $this->createTable('{{%verifikasi_user}}', [
            'id' => $this->primaryKey(),
            'id_user'=>$this->integer(),
            'nama_file'=>$this->string(),
            'jenis_verifikasi'=>$this->string(),
            'status'=>$this->tinyInteger(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer(),
        ],$tableOptions);

        $this->addForeignKey('fk-verifikasi_user-user','{{%verifikasi_user}}','id_user','{{%user}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%verifikasi_user}}');
    }
}
