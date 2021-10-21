<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work_kind".
 *
 * @property int $id
 * @property string $name Название
 *
 * @property WorkType[] $workTypes
 */
class WorkKind extends \yii\db\ActiveRecord
{
    public $workTypes;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_kind';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['workTypes'],'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'workTypes' => 'Типы работ'
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkTypes()
    {
        return $this->hasMany(WorkType::className(), ['work_kind_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return WorkKindQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WorkKindQuery(get_called_class());
    }
}
