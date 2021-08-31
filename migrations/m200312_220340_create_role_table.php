<?php

use yii\db\Migration;

/**
 * Handles the creation of table `role`.
 */
class m200312_220340_create_role_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('role', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('название'),
    
            'order_create' => $this->boolean()->comment('создание заказа'),
            'order_update' => $this->boolean()->comment('изменение заказа'),
            'order_delete' => $this->boolean()->comment('удаление заказа'),
            'order_view' => $this->boolean()->comment('просмотр заказа'),
            'order_view_all' => $this->boolean()->comment('просмотр всех заказов'),
         
            'directory_access' => $this->boolean()->comment('доступ к справочникам'),
            
            'user_create' => $this->boolean()->comment('создание пользователей'),
            'user_update' => $this->boolean()->comment('редактирование пользователей'),
            'user_delete' => $this->boolean()->comment('удаление пользователей'),
            'user_view' => $this->boolean()->comment('просмотр пользователей'),
            'user_view_all' => $this->boolean()->comment('просмотр всех пользователей'),
            'report_access' => $this->boolean()->comment('доступ к отчетам'),
        ]);
        $this->insert('role', [
            'name' => 'администратор',
            'order_create' => true,
            'order_update' => true,
            'order_delete' => true,
            'order_view' => true,
            'order_view_all' => true,
            'directory_access' => true,
            'user_create' => true,
            'user_update' => true,
            'user_delete' => true,
            'user_view' => true,
            'user_view_all' => true,
            'report_access' => true,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('role');
    }
}
