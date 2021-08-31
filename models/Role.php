<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property int $id
 * @property string $name название

 * @property int $order_create создание заказа
 * @property int $order_update изменение заказа
 * @property int $order_delete удаление заказа
 * @property int $order_view просмотр заказа
 * @property int $order_view_all просмотр всех заказов

 * @property int $directory_access доступ к справочникам
 * @property int $user_create создание пользователей
 * @property int $user_update редактирование пользователей
 * @property int $user_delete удаление пользователей
 * @property int $user_view просмотр пользователей
 * @property int $user_view_all просмотр всех пользователей
 * @property int $report_access доступ к отчетам
 *
 * @property User[] $users
 */
class Role extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_create', 'order_update', 'order_delete', 'order_view', 'order_view_all','directory_access', 'user_create', 'user_update', 'user_delete', 'user_view', 'user_view_all', 'report_access'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['name'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Роль',
         
            'order_create' => 'Добавление Заявки',
            'order_update' => 'Изменение Заявки',
            'order_delete' => 'Удаление Заявки',
            'order_view' => 'Просмотр Заявки',
            'order_view_all' => 'Просмотр всех заявок',

            'directory_access' => 'Доступ к справочникам',

            'user_create' => 'Добавление пользователя',
            'user_update' => 'Изменение пользователя',
            'user_delete' => 'Удаление пользователя',
            'user_view' => 'Просмотр пользователя',
            'user_view_all' => 'Просмотр всех пользователей',
        
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        $count = User::find()->where(['role_id' => $this->id])->count();

        if($count > 0){
            return false;
        }

        return parent::beforeDelete();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['role_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return RQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RQuery(get_called_class());
    }
}
