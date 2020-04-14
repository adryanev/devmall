<?php

use yii\db\Migration;

/**
 * Class m191107_101139_create_table_follow
 */
class m191107_101139_create_table_follow extends Migration
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

        $this->createTable('{{%follow}}', [
            'id' => $this->primaryKey(),
            'id_pengguna' => $this->integer(),
            'id_booth' => $this->integer(),
            'notification' => $this->boolean(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->addForeignKey('fk-follow-pengguna', '{{%follow}}', 'id_pengguna', '{{%user}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-follow-booth', '{{%follow}}', 'id_booth', '{{%booth}}', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-follow-pengguna', '{{%folow}}');
        $this->dropForeignKey('fk-follow-booth', '{{%follow}}');

        $this->dropTable('{{%follow}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191107_101139_create_table_follow cannot be reverted.\n";

        return false;
    }
    */
}
