<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_contact".
 *
 * @property int $id
 * @property string $name ФИО контактного лица
 * @property string $position должность контактного лица
 * @property string $phone телефон контактного лица
 * @property string $email почта контактного лица
 * @property int $client_id котрагент
 *
 * @property Client $client
 */
class ClientContact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client_contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id'], 'integer'],
            [['name', 'position', 'phone', 'email'], 'string', 'max' => 255],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ФИО контактного лица',
            'position' => 'должность контактного лица',
            'phone' => 'телефон контактного лица',
            'email' => 'почта контактного лица',
            'client_id' => 'котрагент',
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
     * {@inheritdoc}
     * @return ClientContactQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClientContactQuery(get_called_class());
    }
}
