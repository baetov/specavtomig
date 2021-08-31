<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%technic}}`.
 */
class m210510_104758_create_technic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%technic}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Название Техники'),
            'model' => $this->string()->comment('Модель '),
            'gos_num' => $this->string()->comment('Гос Номер'),
            'characteristics' => $this->string()->comment('Техническе характеристики'),
            'equipment' => $this->string()->comment('Останстка'),
            'type_id' => $this->integer()->comment('Тип техники'),
            'subgroup_id' => $this->integer()->comment('Подгруппа типа техники')
        ]);
        $this->createIndex(
            'idx-technic-technic_type_id',
            'technic',
            'type_id'
        );
        $this->addForeignKey(
            'fk-technic-technic_type_id',
            'technic',
            'type_id',
            'technic_type',
            'id',
            'SET NULL'
        );
        $this->createIndex(
            'idx-technic-subgroup_id',
            'technic',
            'subgroup_id'
        );
        $this->addForeignKey(
            'fk-technic-subgroup_id',
            'technic',
            'subgroup_id',
            'technic_type_subgroup',
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
            'fk-technic-technic_type_id',
            'technic'
        );

        $this->dropIndex(
            'idx-technic-technic_type_id',
            'technic'
        );
        $this->dropForeignKey(
            'fk-technic-subgroup_id',
            'technic'
        );

        $this->dropIndex(
            'idx-technic-subgroup_id',
            'technic'
        );
        $this->dropTable('{{%technic}}');
    }
}
