<?php

use common\helpers\TextTypesTrait;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%komisi_produk}}`.
 */
class m191126_081724_create_permintaan_produk_table extends Migration
{
    use TextTypesTrait;
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%permintaan_produk}}', [
            'id' => $this->primaryKey(),
            'id_booth'=>$this->integer(),
            'id_user'=>$this->integer(),
            'nama'=>$this->string(),
            'kriteria'=>$this->longText(),
            'deadline'=>$this->integer(),
            'harga'=>$this->bigInteger(),
            'uang_muka'=>$this->bigInteger(),
            'progres'=>$this->float(),
            'status'=>$this->tinyInteger(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()

        ]);

        $this->addForeignKey('fk-permintaan_produk_booth','{{%permintaan_produk}}','id_booth','{{%booth}}','id','cascade','cascade');
        $this->addForeignKey('fk-permintaan_produk_user','{{%permintaan_produk}}','id_user','{{%user}}','id','SET NULL','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%komisi_produk}}');
    }
}
