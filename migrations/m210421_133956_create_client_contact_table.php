<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client_contact}}`.
 */
class m210421_133956_create_client_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%client_contact}}', [
            'id' => $this->primaryKey(),
            'name' =>$this->string()->comment('ФИО контактного лица'),
            'position' =>$this->string()->comment('должность контактного лица'),
            'phone' =>$this->string()->comment('телефон контактного лица'),
            'email' =>$this->string()->comment('почта контактного лица'),
            'client_id' => $this->integer()->comment('котрагент'),
        ]);
        $this->createIndex(
            'idx-client_contact-client_id',
            'client_contact',
            'client_id'
        );


        $this->addForeignKey(
            'fk-client_contact-client_id',
            'client_contact',
            'client_id',
            'client',
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
            'fk-client_contact-client_id',
            'client_contact'
        );

        $this->dropIndex(
            'idx-client_contact-client_id',
            'client_contact'
        );
        $this->dropTable('{{%client_contact}}');
    }
}
