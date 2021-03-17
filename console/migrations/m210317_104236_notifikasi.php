<?php

use yii\db\Schema;
use yii\db\Migration;

class m210317_104236_notifikasi extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%notifikasi}}',
            [
                'id'=> $this->primaryKey(11),
                'sender'=> $this->integer(11)->notNull(),
                'receiver'=> $this->integer(11)->notNull(),
                'context'=> $this->string(100)->notNull(),
                'id_data'=> $this->integer(11)->notNull(),
                'jenis_data'=> $this->string(50)->notNull(),
                'status'=> $this->string(20)->notNull(),
                'created_at'=> $this->integer(11)->notNull(),
                'updated_at'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%notifikasi}}');
    }
}
