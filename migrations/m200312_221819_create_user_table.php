<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m200312_221819_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'login' => $this->string()->notNull()->comment('Логин'),
            'name' => $this->string()->comment('ФИО'),
            'email' => $this->string()->comment('email'),
            'phone' => $this->string()->comment('телефон'),
            'type' => $this->string()->comment('тип пользователя'),
            'birth_date' => $this->date()->comment('дата рождения'),
            'role_id' => $this->integer()->comment('Роль'),
            'avatar' => $this->string()->comment('Аватар'),
            'password_hash' => $this->string()->notNull()->comment('Зашифрованный пароль'),
            'access' => $this->boolean()->defaultValue(true)->comment('Доступ'),
            'inn' => $this->string()->comment('ИНН'),
            'address' => $this->string()->comment('Адрес'),
            'is_deletable' => $this->boolean()->notNull()->defaultValue(true)->comment('Можно удалить или нельзя'),
            'created_at' => $this->dateTime(),
            'crew_id' => $this->integer()->comment('Компания')
        ]);
        $this->createIndex(
            'idx-user-role_id',
            'user',
            'role_id'
        );
      



        $this->addForeignKey(
            'fk-user-role_id',
            'user',
            'role_id',
            'role',
            'id',
            'SET NULL'
        );
       



        $this->insert('user', [
            'login' => 'admin@admin.com',
            'role_id' => '1',
            'name' => 'Администратор',
            'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
            'is_deletable' => false,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {

        $this->dropForeignKey(
            'fk-user-role_id',
            'user'
        );

        $this->dropIndex(
            'idx-user-role_id',
            'user'
        );
       


        $this->dropTable('user');
    }
}
