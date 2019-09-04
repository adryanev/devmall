<?php

use yii\db\Migration;

/**
 * Class m190830_114249_insert_super_admin
 */
class m190830_114249_insert_super_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->insert('{{%user}}',[
            'username'=>'root',
            'auth_key'=>'Pwys0TRico7Ha4YSyX2fmjABrFskscxh',
            'password_hash'=>'$2y$13$tyy5A3UZe0ipSoaWDrbpXOfBE8bph0sawnVHrGu6RFfgD7Nihq9he',
            'password_reset_token'=>null,
            'email'=>'root@devmall.test',
            'nomor_hp'=>'08121111111',
            'status'=>1,
            'created_at'=>0,
            'updated_at'=>0,
            'verification_token'=>'Pwys0TRico7Ha4YSyX2fmjABrFskscxh'
        ]);

        $this->insert('{{%profil_user}}',[
            'id_user'=>1,
            'nama_depan'=>'Super',
            'nama_belakang'=>'Administrator',
            'tanggal_lahir'=>0,
            'jenis_kelamin'=>1,
            'avatar'=>'superadmin.jpg',
            'alamat1'=>'',
            'alamat2'=>'',
            'kelurahan'=>'',
            'kecamatan'=>'',
            'kota'=>'',
            'provinsi'=>'',
            'pekerjaan'=>'Super Admin',
            'created_at'=>0,
            'updated_at'=>0,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->truncateTable('{{%profil_user}}');
        $this->truncateTable('{{%user}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190830_114249_insert_super_admin cannot be reverted.\n";

        return false;
    }
    */
}
