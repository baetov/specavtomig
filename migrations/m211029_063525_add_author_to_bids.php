<?php

use yii\db\Migration;

/**
 * Class m211029_063525_add_author_to_bids
 */
class m211029_063525_add_author_to_bids extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('bid', 'author_id', $this->integer()->comment('автор'));
        $this->addColumn('reserve_bid', 'author_id', $this->integer()->comment('автор'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('bid','author_id');
        $this->dropColumn('reserve_bid','author_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211029_063525_add_author_to_bids cannot be reverted.\n";

        return false;
    }
    */
}
