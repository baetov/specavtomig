<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "bid".
 *
 * @property int $id
 * @property int $client_id Заказчик
 * @property int $technic_type_id Тип техники
 * @property int $technic_type_subgroup_id Подтип техники
 * @property int $technic_id Техника
 * @property int $work_kind_id Вид Работ
 * @property int $work_type_id Подгруппа видов работ
 * @property string $date Дата и время подачи
 * @property string $route Маршрут
 * @property int $status Статус заявки
 * @property int $pay_status Статус оплаты
 * @property string $pay_form Форма оплаты
 * @property int $price Цена
 * @property int $hours кол-во часов работы
 * @property int $mkad км за МКАД
 * @property int $mkad_price Цена за км
 * @property int $total Итого
 * @property string $k_pay_form Форма оплаты
 * @property int $k_price Цена
 * @property int $k_hours кол-во часов работы
 * @property int $k_mkad км за МКАД
 * @property int $k_mkad_price Цена за км
 * @property int $k_total Итого
 * @property int $fuel Топливо выдано
 * @property int $mileage Общий пробег
 * @property int $author_id автор
 * @property string $garage_out Выезд из гаража
 * @property string $garage_in Возвращение в гараж
 * @property string $customer_in Прибыл к заказчику
 * @property string $customer_out Убыл от заказчика
 * @property text $comment коментарии
 * @property integer $driver_id водитель
 * @property  updated_by изменил
 * @property updated_at
 * @property string details
 *
 * @property Client $client
 * @property Technic $technic
 * @property TechnicType $technicType
 * @property TechnicTypeSubgroup $technicTypeSubgroup
 * @property WorkKind $workKind
 * @property WorkType $workType

 */
class Bid extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bid';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'technic_type_id','author_id', 'technic_type_subgroup_id', 'technic_id', 'work_kind_id', 'work_type_id', 'driver_id', 'status', 'pay_status', 'mileage','updated_by'], 'integer'],
            [['date', 'garage_out', 'garage_in', 'customer_in', 'customer_out','comment','updated_at','details'], 'safe'],
            [['route', 'price', 'hours', 'mkad', 'mkad_price', 'total', 'fuel','k_price', 'k_hours', 'k_mkad', 'k_mkad_price', 'k_total','k_pay_form'], 'string'],
            [['pay_form'], 'string', 'max' => 255],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['technic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Technic::className(), 'targetAttribute' => ['technic_id' => 'id']],
            [['technic_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TechnicType::className(), 'targetAttribute' => ['technic_type_id' => 'id']],
            [['technic_type_subgroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => TechnicTypeSubgroup::className(), 'targetAttribute' => ['technic_type_subgroup_id' => 'id']],
            [['work_kind_id'], 'exist', 'skipOnError' => true, 'targetClass' => WorkKind::className(), 'targetAttribute' => ['work_kind_id' => 'id']],
            [['work_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => WorkType::className(), 'targetAttribute' => ['work_type_id' => 'id']],
        ];
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => 'updated_at',
                'createdAtAttribute' => null,
                'value' => date('Y-m-d H:i:s'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'updatedByAttribute' => null,
                'createdByAttribute' => 'author_id',
                'value' => Yii::$app->user->id
            ],
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
            'driver_id' => 'Водитель',
            'technic_id' => 'Техника',
            'work_kind_id' => 'Вид Работ',
            'work_type_id' => 'Подгруппа видов работ',
            'date' => 'Дата',
            'route' => 'Маршрут',
            'status' => 'Статус заявки',
            'pay_status' => 'Статус оплаты',
            'pay_form' => 'Форма оплаты',
            'price' => 'Цена за час',
            'hours' => 'Кол-во часов работы',
            'mkad' => 'КМ за МКАД',
            'mkad_price' => 'Цена за КМ',
            'total' => 'Итого',
            'k_pay_form' => 'Форма оплаты',
            'k_price' => 'Цена за час',
            'k_hours' => 'Кол-во часов работы',
            'k_mkad' => 'КМ за МКАД',
            'k_mkad_price' => 'Цена за КМ',
            'k_total' => 'Итого',
            'fuel' => 'Топливо выдано',
            'mileage' => 'Общий пробег',
            'garage_out' => 'Выезд из гаража',
            'garage_in' => 'Возвращение в гараж',
            'customer_in' => 'Прибыл к заказчику',
            'customer_out' => 'Убыл от заказчика',
            'comment' => 'Комментарии',
            'author_id' => 'Автор',
            'updated_by' => 'Изменил',
            'updated_at' => 'Дата и время изменения',
            'details' => 'Подробная информация'
        ];
    }
    public function beforeSave($insert)
    {
        if ($this->isNewRecord){
                $this->updated_by = null;
                $this->updated_at = null;
        }
        if(!$this->isNewRecord){
            $this->updated_by = Yii::$app->user->identity->id;
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
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
    public function getTechnic()
    {
        return $this->hasOne(Technic::className(), ['id' => 'technic_id']);
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
     * @return \yii\db\ActiveQuery
     */
    public function getWorkType()
    {
        return $this->hasOne(WorkType::className(), ['id' => 'work_type_id']);
    }

    /**
     * {@inheritdoc}
     * @return BidQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BidQuery(get_called_class());
    }
}
