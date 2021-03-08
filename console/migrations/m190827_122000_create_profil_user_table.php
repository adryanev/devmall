<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profil_user}}`.
 */
class m190827_122000_create_profil_user_table extends Migration
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
        $this->createTable('{{%profil_user}}', [
            'id' => $this->primaryKey(),
            'id_user'=>$this->integer(),
            'nama_depan'=>$this->string(20),
            'nama_belakang'=>$this->string(20),
            'tanggal_lahir'=>$this->integer(),
            'jenis_kelamin'=>$this->tinyInteger(),
            'avatar'=>$this->string(),
            'alamat1'=>$this->string(100),
            'alamat2'=>$this->string(100),
            'kelurahan'=>$this->string(50),
            'kecamatan'=>$this->string(50),
            'kota'=>$this->string(50),
            'provinsi'=>$this->string(50),
            'pekerjaan'=>$this->string(20),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer(),

        ],$tableOptions);

        $this->addForeignKey('fk-profil_user-user','{{%profil_user}}','id_user','{{%user}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profil_user}}');
    }
}
