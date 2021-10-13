<?php

use yii\db\Migration;

/**
 * Class m211013_115349_driver_change
 */
class m211013_115349_driver_change extends Migration
{
    /**
     * {@inheritdoc}
     */
      /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('driver', 'driver_license', $this->string());
        $this->alterColumn('driver', 'crane_license', $this->string());
        $this->alterColumn('driver', 'passport', $this->string());
        $this->addColumn('driver', 'phone', $this->string()->comment('Телефон'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('driver', 'driver_license', $this->integer());
        $this->alterColumn('driver', 'crane_license', $this->integer());
        $this->alterColumn('driver', 'passport', $this->integer());
        $this->dropColumn('driver', 'phone');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211013_115349_driver_change cannot be reverted.\n";

        return false;
    }
    */
}
