<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%technic_type_subgroup}}`.
 */
class m210510_104754_create_technic_type_subgroup_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%technic_type_subgroup}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('назване подгрупппы'),
            'technic_type_id' => $this->integer()
        ]);
        $this->createIndex(
            'idx-technic_type_subgroup-technic_type_id',
            'technic_type_subgroup',
            'technic_type_id'
        );
        $this->addForeignKey(
            'fk-technic_type_subgroup-technic_type_id',
            'technic_type_subgroup',
            'technic_type_id',
            'technic_type',
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
            'fk-technic_type_subgroup-technic_type_id',
            'technic_type_subgroup'
        );

        $this->dropIndex(
            'idx-technic_type_subgroup-technic_type_id',
            'technic_type_subgroup'
        );
        $this->dropTable('{{%technic_type_subgroup}}');
    }
}
