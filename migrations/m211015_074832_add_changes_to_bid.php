<?php

use yii\db\Migration;

/**
 * Class m211015_074832_add_changes_to_bid
 */
class m211015_074832_add_changes_to_bid extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('bid', 'price', $this->string());
        $this->alterColumn('bid', 'hours', $this->string());
        $this->alterColumn('bid', 'mkad', $this->string());
        $this->alterColumn('bid', 'mkad_price', $this->string());
        $this->alterColumn('bid', 'total', $this->string());
        $this->alterColumn('bid', 'fuel', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('bid', 'price', $this->integer());
        $this->alterColumn('bid', 'hours', $this->integer());
        $this->alterColumn('bid', 'mkad', $this->integer());
        $this->alterColumn('bid', 'mkad_price', $this->integer());
        $this->alterColumn('bid', 'total', $this->integer());
        $this->alterColumn('bid', 'fuel', $this->integer());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211015_074832_add_changes_to_bid cannot be reverted.\n";

        return false;
    }
    */
}
