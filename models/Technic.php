<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "technic".
 *
 * @property int $id
 * @property string $name Название Техники
 * @property string $model Модель 
 * @property string $gos_num Гос Номер
 * @property string $characteristics Техническе характеристики
 * @property string $equipment Останстка
 * @property int $type_id Тип техники
 * @property int $subgroup_id Подгруппа типа техники
 * @property array $subgroups Подгруппа типа техники
 * @property int reserved_by
 * @property boolean reserve
 *
 * @property TechnicTypeSubgroup $subgroup
 * @property TechnicType $type
 */
class Technic extends \yii\db\ActiveRecord
{
    public $subgroups;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'technic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'subgroup_id','reserved_by'], 'integer'],
            [['subgroups','reserve'],'safe'],
            [['name', 'model', 'gos_num', 'characteristics', 'equipment'], 'string', 'max' => 255],
//            [['subgroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => TechnicTypeSubgroup::className(), 'targetAttribute' => ['subgroup_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TechnicType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название Техники',
            'model' => 'Модель ',
            'gos_num' => 'Гос Номер',
            'characteristics' => 'Техническе характеристики',
            'equipment' => 'Останстка',
            'type_id' => 'Тип техники',
            'subgroups' => 'Подгруппа типа техники',
            'reserved_by' => 'Кто занял',
            'reserve' => 'Занят/Свободен'
        ];
    }
    public function afterSave($insert, $changedAttributes)
    {
        if ($this->subgroups != null) {
            $allSubs = MultiTechSubgroup::find()->where(['technic_id' => $this->id])->all();
            foreach ($allSubs as $sub){
                if (array_search($sub, $this->subgroups) !== false){
                    continue;
                }else{
                    $sub->delete();
                }
            }
            foreach ($this->subgroups as $subSub) {
                $subSub2 = MultiTechSubgroup::find()->where(['technic_id' => $this->id, 'subgroup_id' => $subSub])->one();
                if (!$subSub2) {
                    (new MultiTechSubgroup([
                        'subgroup_id' => $subSub,
                        'technic_id' => $this->id
                    ]))->save(false);
                }
            }

        }

        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
    public function afterDelete()
    {
        MultiTechSubgroup::deleteAll(['technic_id' => $this->id]);
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubgroup()
    {
        return $this->hasOne(TechnicTypeSubgroup::className(), ['id' => 'subgroup_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TechnicType::className(), ['id' => 'type_id']);
    }

    /**
     * {@inheritdoc}
     * @return TechnicQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TechnicQuery(get_called_class());
    }
}
