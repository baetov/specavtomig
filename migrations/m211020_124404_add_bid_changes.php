<?php

use yii\db\Migration;

/**
 * Class m211020_124404_add_bid_changes
 */
class m211020_124404_add_bid_changes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('bid', 'date', $this->date());
        $this->alterColumn('bid', 'garage_out', $this->string());
        $this->alterColumn('bid', 'garage_in', $this->string());
        $this->alterColumn('bid', 'customer_in', $this->string());
        $this->alterColumn('bid', 'customer_out', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('bid', 'date', $this->dateTime());
        $this->alterColumn('bid', 'garage_out', $this->dateTime());
        $this->alterColumn('bid', 'garage_in', $this->dateTime());
        $this->alterColumn('bid', 'customer_in', $this->dateTime());
        $this->alterColumn('bid', 'customer_out', $this->dateTime());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211020_124404_add_bid_changes cannot be reverted.\n";

        return false;
    }
    */
}
