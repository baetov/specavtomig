<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reserve_bid}}`.
 */
class m211021_070851_create_reserve_bid_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reserve_bid}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->comment('Заказчик'),
            'technic_type_id' => $this->integer()->comment('Тип техники'),
            'technic_type_subgroup_id' => $this->integer()->comment('Подтип техники'),
            'technic_id' => $this->integer()->comment('Техника'),
            'work_kind_id' => $this->integer()->comment('Вид Работ'),
            'date' => $this->date()->comment('Дата и время подачи'),
            'time' => $this->string()->comment('Время подачи'),
            'driver_id' => $this->integer()->comment('Водитель'),
            'route' => $this->text()->comment('Маршрут'),
            'pay_form' => $this->string()->comment('Форма оплаты'),
            'price' => $this->string()->comment('Цена'),
            'hours' => $this->string()->comment('кол-во часов работы'),
            'mkad' => $this->string()->comment('км за МКАД'),
            'mkad_price' => $this->string()->comment('Цена за км'),
            'total' => $this->string()->comment('Итого'),
            'comment' => $this->text()->comment('Коментарии')
        ]);
        $this->createIndex(
            'idx-reserve_bid-client_id',
            'reserve_bid',
            'client_id'
        );
        $this->addForeignKey(
            'fk-reserve_bid-client_id',
            'reserve_bid',
            'client_id',
            'client',
            'id',
            'SET NULL'
        );
        $this->createIndex(
            'idx-reserve_bid-driver_id',
            'reserve_bid',
            'driver_id'
        );
        $this->addForeignKey(
            'fk-reserve_bid-driver_id',
            'reserve_bid',
            'driver_id',
            'driver',
            'id',
            'SET NULL'
        );
        $this->createIndex(
            'idx-reserve_bid-technic_type_id',
            'reserve_bid',
            'technic_type_id'
        );
        $this->addForeignKey(
            'fk-reserve_bid-technic_type_id',
            'reserve_bid',
            'technic_type_id',
            'technic_type',
            'id',
            'SET NULL'
        );
        $this->createIndex(
            'idx-reserve_bid-technic_type_subgroup_id',
            'reserve_bid',
            'technic_type_subgroup_id'
        );
        $this->addForeignKey(
            'fk-reserve_bid-technic_type_subgroup_id',
            'reserve_bid',
            'technic_type_subgroup_id',
            'technic_type_subgroup',
            'id',
            'SET NULL'
        );
        $this->createIndex(
            'idx-reserve_bid-technic_id',
            'reserve_bid',
            'technic_id'
        );
        $this->addForeignKey(
            'fk-reserve_bid-technic_id',
            'reserve_bid',
            'technic_id',
            'technic',
            'id',
            'SET NULL'
        );
        $this->createIndex(
            'idx-reserve_bid-work_kind_id',
            'reserve_bid',
            'work_kind_id'
        );
        $this->addForeignKey(
            'fk-reserve_bid-work_kind_id',
            'reserve_bid',
            'work_kind_id',
            'work_kind',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-reserve_bid-client_id',
            'reserve_bid'
        );
        $this->dropIndex(
            'idx-reserve_bid-client_id',
            'reserve_bid'
        );
        $this->dropForeignKey(
            'fk-reserve_bid-driver_id',
            'reserve_bid'
        );
        $this->dropIndex(
            'idx-reserve_bid-driver_id',
            'reserve_bid'
        );
        $this->dropForeignKey(
            'fk-reserve_bid-technic_type_id',
            'reserve_bid'
        );
        $this->dropIndex(
            'idx-reserve_bid-technic_type_id',
            'reserve_bid'
        );
        $this->dropForeignKey(
            'fk-reserve_bid-technic_type_subgroup_id',
            'reserve_bid'
        );
        $this->dropIndex(
            'idx-reserve_bid-technic_type_subgroup_id',
            'reserve_bid'
        );
        $this->dropForeignKey(
            'fk-reserve_bid-technic_id',
            'reserve_bid'
        );
        $this->dropIndex(
            'idx-reserve_bid-technic_id',
            'reserve_bid'
        );
        $this->dropForeignKey(
            'fk-reserve_bid-work_kind_id',
            'reserve_bid'
        );
        $this->dropIndex(
            'idx-reserve_bid-work_kind_id',
            'reserve_bid'
        );
        $this->dropTable('{{%reserve_bid}}');
    }
}
