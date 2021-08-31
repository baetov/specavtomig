<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work_type}}`.
 */
class m210510_121653_create_work_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Название'),
            'work_kind_id' => $this->integer()
        ]);
        $this->createIndex(
            'idx-work_type-work_kind_id',
            'work_type',
            'work_kind_id'
        );
        $this->addForeignKey(
            'fk-work_type-work_kind_id',
            'work_type',
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
            'fk-work_type-work_kind_id',
            'work_type'
        );

        $this->dropIndex(
            'idx-work_type-work_kind_id',
            'work_type'
        );
        $this->dropTable('{{%work_type}}');
    }
}
