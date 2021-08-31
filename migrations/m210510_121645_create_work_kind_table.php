<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work_kind}}`.
 */
class m210510_121645_create_work_kind_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work_kind}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Название'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%work_kind}}');
    }
}
