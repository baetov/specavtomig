<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "multi_tech_subgroup".
 *
 * @property int $id
 * @property int $technic_id
 * @property int $subgroup_id
 */
class MultiTechSubgroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'multi_tech_subgroup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['technic_id', 'subgroup_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'technic_id' => 'Technic ID',
            'subgroup_id' => 'Subgroup ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MultiTechSubgroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MultiTechSubgroupQuery(get_called_class());
    }
}
