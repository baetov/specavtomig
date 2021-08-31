<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%driver}}`.
 */
class m210426_131910_create_driver_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%driver}}', [
            'id' => $this->primaryKey(),
            'type' => $this->integer()->comment('Тип водителя'),
            'name' => $this->string()->comment('Ф.И.О.'),
            'birth' => $this->date()->comment('Дата рождения'),
            'passport' => $this->integer()->comment('Серия и номер паспорта'),
            'driver_license' => $this->integer()->comment('Серия и номер В.У.'),
            'crane_license' => $this->integer()->comment('Серия и номер Удостоверения'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%driver}}');
    }
}
