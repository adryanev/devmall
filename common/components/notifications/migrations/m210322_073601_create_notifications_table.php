<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notification_object}}`.
 */
class m210322_073601_create_notifications_table extends Migration
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
        $this->createTable('{{%notification_object}}', [
            'id' => $this->primaryKey(),
            'entity_id'=>$this->integer(),
            'entity_type_id'=>$this->integer(),
            'status'=>$this->tinyInteger(1),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);
        $this->createTable('{{%notification_receive}}',[
            'id'=>$this->primaryKey(),
            'notification_object_id'=>$this->integer(),
            'notifier_id'=>$this->integer(),
            'status'=>$this->tinyInteger(1),
        ],$tableOptions);
        $this->addForeignKey('fk-notif_rec-notif_obj','{{%notification_receive}}','notification_object_id','{{%notification_object}}','id','cascade','cascade');
        $this->addForeignKey('fk-notif_rec-user','{{%notification_receive}}','notifier_id','{{%user}}','id');
        $this->createTable('{{%notification_send}}',[
            'id'=>$this->primaryKey(),
            'notification_object_id'=>$this->integer(),
            'actor_id'=>$this->integer(),
            'status'=>$this->tinyInteger(1)
        ],$tableOptions);
        $this->addForeignKey('fk-notif_send-notif_obj','{{%notification_send}}','notification_object_id','{{%notification_object}}','id','cascade','cascade');
        $this->addForeignKey('fk-notif_send-user','{{%notification_send}}','actor_id','{{%user}}','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%notification_receive}}');
        $this->dropTable('{{%notification_send}}');
        $this->dropTable('{{%notification_object}}');
    }
}
