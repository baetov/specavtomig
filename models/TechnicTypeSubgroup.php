<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "technic_type_subgroup".
 *
 * @property int $id
 * @property string $name назване подгрупппы
 * @property int $technic_type_id
 *
 * @property TechnicType $technicType
 */
class TechnicTypeSubgroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'technic_type_subgroup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['technic_type_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['technic_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TechnicType::className(), 'targetAttribute' => ['technic_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'назване подгрупппы',
            'technic_type_id' => 'Technic Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTechnicType()
    {
        return $this->hasOne(TechnicType::className(), ['id' => 'technic_type_id']);
    }

    /**
     * {@inheritdoc}
     * @return TechnicTypeSubgroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TechnicTypeSubgroupQuery(get_called_class());
    }
}
