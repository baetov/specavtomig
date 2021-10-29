<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reserve_bid".
 *
 * @property int $id
 * @property int $client_id Заказчик
 * @property int $technic_type_id Тип техники
 * @property int $technic_type_subgroup_id Подтип техники
 * @property int $technic_id Техника
 * @property int $work_kind_id Вид Работ
 * @property string $date Дата и время подачи
 * @property string $time Время подачи
 * @property int $driver_id Водитель
 * @property string $route Маршрут
 * @property string $pay_form Форма оплаты
 * @property string $price Цена
 * @property string $hours кол-во часов работы
 * @property string $mkad км за МКАД
 * @property string $mkad_price Цена за км
 * @property string $total Итого
 * @property string $comment Коментарии
 * @property int $author_id автор
 *
 * @property Client $client
 * @property Driver $driver
 * @property Technic $technic
 * @property TechnicType $technicType
 * @property TechnicTypeSubgroup $technicTypeSubgroup
 * @property WorkKind $workKind
 */
class ReserveBid extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reserve_bid';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'technic_type_id','author_id', 'technic_type_subgroup_id', 'technic_id', 'work_kind_id', 'driver_id'], 'integer'],
            [['date'], 'safe'],
            [['route', 'comment'], 'string'],
            [['time', 'pay_form', 'price', 'hours', 'mkad', 'mkad_price', 'total'], 'string', 'max' => 255],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['driver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Driver::className(), 'targetAttribute' => ['driver_id' => 'id']],
            [['technic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Technic::className(), 'targetAttribute' => ['technic_id' => 'id']],
            [['technic_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TechnicType::className(), 'targetAttribute' => ['technic_type_id' => 'id']],
            [['technic_type_subgroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => TechnicTypeSubgroup::className(), 'targetAttribute' => ['technic_type_subgroup_id' => 'id']],
            [['work_kind_id'], 'exist', 'skipOnError' => true, 'targetClass' => WorkKind::className(), 'targetAttribute' => ['work_kind_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Заказчик',
            'technic_type_id' => 'Тип техники',
            'technic_type_subgroup_id' => 'Подтип техники',
            'technic_id' => 'Техника',
            'work_kind_id' => 'Вид Работ',
            'date' => 'Дата и время подачи',
            'time' => 'Время подачи',
            'driver_id' => 'Водитель',
            'route' => 'Маршрут',
            'pay_form' => 'Форма оплаты',
            'price' => 'Цена',
            'hours' => 'Кол-во часов работы',
            'mkad' => 'КМ за МКАД',
            'mkad_price' => 'Цена за КМ',
            'total' => 'Итого',
            'comment' => 'Коментарии',
            'author_id' => 'Автор'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(Driver::className(), ['id' => 'driver_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTechnic()
    {
        return $this->hasOne(Technic::className(), ['id' => 'technic_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTechnicType()
    {
        return $this->hasOne(TechnicType::className(), ['id' => 'technic_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTechnicTypeSubgroup()
    {
        return $this->hasOne(TechnicTypeSubgroup::className(), ['id' => 'technic_type_subgroup_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkKind()
    {
        return $this->hasOne(WorkKind::className(), ['id' => 'work_kind_id']);
    }

    /**
     * {@inheritdoc}
     * @return ReserveBidQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReserveBidQuery(get_called_class());
    }
}
