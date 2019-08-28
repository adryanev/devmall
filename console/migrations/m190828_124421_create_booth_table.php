<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%booth}}`.
 */
class m190828_124421_create_booth_table extends Migration
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
        $this->createTable('{{%booth}}', [
            'id' => $this->primaryKey(),
            'id_user'=>$this->integer()->unique(),
            'nama'=>$this->string(100)->unique(),
            'alamat1'=>$this->string(100),
            'alamat2'=>$this->string(100),
            'kelurahan'=>$this->string(50),
            'kecamatan'=>$this->string(50),
            'kota'=>$this->string(50),
            'provinsi'=>$this->string(50),
            'banner'=>$this->string(100),
            'avatar'=>$this->string(100),
            'deskripsi'=>$this->string(250),
            'email'=>$this->string(100),
            'nomor_telepon'=>$this->string(20),
            'latitude'=>$this->float(),
            'longitude'=>$this->float(),
            'status'=>$this->tinyInteger()->defaultValue(0),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);

        $this->addForeignKey('fk-booth-user','{{%booth}}','id_user','{{%user}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%booth}}');
    }
}
