<?php

use yii\db\Migration;

/**
 * Handles the creation of table `client`.
 */
class m210130_235118_create_client_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('client', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Наименование'),
            'address' => $this->string()->comment('Адрес'),
            'post_index' => $this->string()->comment('Почтовый индекс'),
            'type' => $this->integer()->comment('Тип'),
            'created_at' => $this->dateTime(),
            'inn'=> $this->string()->comment('ИНН'),
            'ogrn'=> $this->string()->comment('ОГРН'),
            'kpp'=> $this->string()->comment('КПП'),
            'official_address'=> $this->string()->comment('Юридический адрес'),
            'address_equals'=> $this->boolean()->defaultValue(false)->comment('Фактический адрес совпадает с юридическим'),
            'director'=> $this->string()->comment('Генеральный директор'),
            'email' => $this->string()->comment('Email'),
            'phone' => $this->string()->comment('Телефон'),
            'site'=> $this->string()->comment('Сайт'),
            'bank_bik' => $this->string()->comment('БИК/SWIFT'),
            'bank_name' => $this->string()->comment('Наименование банка'),
            'bank_address' => $this->string()->comment('Адрес банка'),
            'bank_correspondent_account' => $this->string()->comment('Корреспондентский счёт'),
            'bank_register_number' => $this->string()->comment('Регистрационный номер'),
            'bank_registration_date' => $this->date()->comment('Дата регистрации'),
            'bank_payment_account' => $this->string()->comment('Расчетный счет'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('client');
    }
}
