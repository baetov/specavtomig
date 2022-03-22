<?php

use yii\db\Migration;

/**
 * Class m220321_102516_add_cols
 */
class m220321_102516_add_cols extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('bid', 'updated_by', $this->integer()->comment('Изменил'));
        $this->addColumn('bid', 'updated_at', $this->dateTime()->comment('Дата и время изменения'));
        $this->addColumn('technic', 'reserved_by', $this->integer()->comment('Занял'));
        $this->addColumn('technic', 'reserve', $this->boolean()->comment('Свободен/Занят'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('bid','updated_by');
        $this->dropColumn('bid','updated_at');
        $this->dropColumn('technic','reserved_by');
        $this->dropColumn('technic','reserve');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220321_102516_add_cols cannot be reverted.\n";

        return false;
    }
    */
}
