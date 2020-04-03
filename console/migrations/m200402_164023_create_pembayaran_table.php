<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pembayaran}}`.
 */
class m200402_164023_create_pembayaran_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pembayaran}}', [
            'id' => $this->primaryKey(),
            'kode_pembayaran'=>$this->string(),
            'external_id'=>$this->integer(),
            'type'=>$this->string(),
            'jenis_pembayaran'=>$this->tinyInteger(),
            'nominal'=>$this->bigInteger(),
            'status'=>$this->tinyInteger(),
            'expire'=>$this->integer(),
            'waktu'=>$this->integer(),
            'snap_token'=>$this->string(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer(),

        ]);

        $this->createIndex('idx-pembayaran-kode_pembayaran','{{%pembayaran}}','kode_pembayaran');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pembayaran}}');
    }
}
