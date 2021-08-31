<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bid}}`.
 */
class m210514_122004_create_bid_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bid}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->comment('Заказчик'),
            'technic_type_id' => $this->integer()->comment('Тип техники'),
            'technic_type_subgroup_id' => $this->integer()->comment('Подтип техники'),
            'technic_id' => $this->integer()->comment('Техника'),
            'work_kind_id' => $this->integer()->comment('Вид Работ'),
            'work_type_id' => $this->integer()->comment('Подгруппа видов работ'),
            'date' => $this->dateTime()->comment('Дата и время подачи'),
            'driver_id' => $this->integer()->comment('Водитель'),
            'route' => $this->text()->comment('Маршрут'),
            'status' => $this->integer()->comment('Статус заявки'),
            'pay_status' => $this->integer()->comment('Статус оплаты'),
            'pay_form' => $this->string()->comment('Форма оплаты'),
            'price' => $this->integer()->comment('Цена'),
            'hours' => $this->integer()->comment('кол-во часов работы'),
            'mkad' => $this->integer()->comment('км за МКАД'),
            'mkad_price' => $this->integer()->comment('Цена за км'),
            'total' => $this->integer()->comment('Итого'),
            'fuel' => $this->integer()->comment('Топливо выдано'),
            'mileage' => $this->integer()->comment('Общий пробег'),
            'garage_out' => $this->dateTime()->comment('Выезд из гаража'),
            'garage_in' => $this->dateTime()->comment('Возвращение в гараж'),
            'customer_in' => $this->dateTime()->comment('Прибыл к заказчику'),
            'customer_out' => $this->dateTime()->comment('Убыл от заказчика'),
            'comment' => $this->text()->comment('Коментарии')
        ]);
        $this->createIndex(
            'idx-bid-client_id',
            'bid',
            'client_id'
        );
        $this->addForeignKey(
            'fk-bid-client_id',
            'bid',
            'client_id',
            'client',
            'id',
            'SET NULL'
        );
        $this->createIndex(
            'idx-bid-driver_id',
            'bid',
            'driver_id'
        );
        $this->addForeignKey(
            'fk-bid-driver_id',
            'bid',
            'driver_id',
            'driver',
            'id',
            'SET NULL'
        );
        $this->createIndex(
            'idx-bid-technic_type_id',
            'bid',
            'technic_type_id'
        );
        $this->addForeignKey(
            'fk-bid-technic_type_id',
            'bid',
            'technic_type_id',
            'technic_type',
            'id',
            'SET NULL'
        );
        $this->createIndex(
            'idx-bid-technic_type_subgroup_id',
            'bid',
            'technic_type_subgroup_id'
        );
        $this->addForeignKey(
            'fk-bid-technic_type_subgroup_id',
            'bid',
            'technic_type_subgroup_id',
            'technic_type_subgroup',
            'id',
            'SET NULL'
        );
        $this->createIndex(
            'idx-bid-technic_id',
            'bid',
            'technic_id'
        );
        $this->addForeignKey(
            'fk-bid-technic_id',
            'bid',
            'technic_id',
            'technic',
            'id',
            'SET NULL'
        );
        $this->createIndex(
            'idx-bid-work_kind_id',
            'bid',
            'work_kind_id'
        );
        $this->addForeignKey(
            'fk-bid-work_kind_id',
            'bid',
            'work_kind_id',
            'work_kind',
            'id',
            'SET NULL'
        );
        $this->createIndex(
            'idx-bid-work_type_id',
            'bid',
            'work_type_id'
        );
        $this->addForeignKey(
            'fk-bid-work_type_id',
            'bid',
            'work_type_id',
            'work_type',
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
            'fk-bid-client_id',
            'bid'
        );
        $this->dropIndex(
            'idx-bid-client_id',
            'bid'
        );
        $this->dropForeignKey(
            'fk-bid-driver_id',
            'bid'
        );
        $this->dropIndex(
            'idx-bid-driver_id',
            'bid'
        );
        $this->dropForeignKey(
            'fk-bid-technic_type_id',
            'bid'
        );
        $this->dropIndex(
            'idx-bid-technic_type_id',
            'bid'
        );
        $this->dropForeignKey(
            'fk-bid-technic_type_subgroup_id',
            'bid'
        );
        $this->dropIndex(
            'idx-bid-technic_type_subgroup_id',
            'bid'
        );
        $this->dropForeignKey(
            'fk-bid-technic_id',
            'bid'
        );
        $this->dropIndex(
            'idx-bid-technic_id',
            'bid'
        );
        $this->dropForeignKey(
            'fk-bid-work_kind_id',
            'bid'
        );
        $this->dropIndex(
            'idx-bid-work_kind_id',
            'bid'
        );
        $this->dropForeignKey(
            'fk-bid-work_type_id',
            'bid'
        );
        $this->dropIndex(
            'idx-bid-work_type_id',
            'bid'
        );
        $this->dropTable('{{%bid}}');
    }
}
