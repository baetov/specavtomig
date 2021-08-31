<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%technic_type}}`.
 */
class m210510_104706_create_technic_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%technic_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Вид Техники')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%technic_type}}');
    }
}
