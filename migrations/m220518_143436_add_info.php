<?php

use yii\db\Migration;

/**
 * Class m220518_143436_add_info
 */
class m220518_143436_add_info extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('bid', 'details', $this->text()->comment('Подробная информация'));
        $this->addColumn('bid', 'k_pay_form', $this->string()->comment('Форма оплаты'));
        $this->addColumn('bid', 'k_price', $this->string()->comment('Цена'));
        $this->addColumn('bid', 'k_hours', $this->string()->comment('кол-во часов работы'));
        $this->addColumn('bid', 'k_mkad', $this->string()->comment('км за МКАД'));
        $this->addColumn('bid', 'k_mkad_price', $this->string()->comment('Цена за км'));
        $this->addColumn('bid', 'k_total', $this->string()->comment('Итого'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('bid','details');
        $this->dropColumn('bid','k_pay_form');
        $this->dropColumn('bid','k_price');
        $this->dropColumn('bid','k_hours');
        $this->dropColumn('bid','k_mkad');
        $this->dropColumn('bid','k_mkad_price');
        $this->dropColumn('bid','k_total');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220518_143436_add_info cannot be reverted.\n";

        return false;
    }
    */
}
