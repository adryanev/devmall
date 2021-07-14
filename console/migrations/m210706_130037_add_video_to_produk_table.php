<?php

use yii\db\Migration;

/**
 * Class m210706_130037_add_video_to_produk_table
 */
class m210706_130037_add_video_to_produk_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%produk}}', 'video');
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%produk}}', 'video', $this->string());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210706_130037_add_video_to_produk_table cannot be reverted.\n";

        return false;
    }
    */
}
