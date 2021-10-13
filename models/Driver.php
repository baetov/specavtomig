<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "driver".
 *
 * @property int $id
 * @property int $type Тип водителя
 * @property string $name Ф.И.О.
 * @property string $birth Дата рождения
 * @property int $passport Серия и номер паспорта
 * @property int $driver_license Серия и номер В.У.
 * @property int $crane_license Серия и номер Удостоверения
 */
class Driver extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'driver';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['birth'], 'safe'],
            [['name', 'driver_license', 'crane_license','phone', 'passport'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип водителя',
            'name' => 'Ф.И.О.',
            'birth' => 'Дата рождения',
            'passport' => 'Серия и номер паспорта',
            'driver_license' => 'Серия и номер В.У.',
            'crane_license' => 'Серия и номер Удостоверения',
            'phone' => 'Телефон'
        ];
    }

    /**
     * {@inheritdoc}
     * @return DriverQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DriverQuery(get_called_class());
    }
}
