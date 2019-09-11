<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%promo}}`.
 */
class m190828_140126_create_promo_table extends Migration
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
        $this->createTable('{{%promo}}', [
            'id' => $this->primaryKey(),
            'id_booth'=>$this->integer(),
            'promo'=>$this->string(),
            'persentase'=>$this->float(),
            'waktu_mulai'=>$this->integer(),
            'waktu_selesai'=>$this->integer(),
            'kode_promo'=>$this->string(20),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);

        $this->addForeignKey('fk-promo-booth','{{%promo}}','id_booth','{{%booth}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%promo}}');
    }
}
