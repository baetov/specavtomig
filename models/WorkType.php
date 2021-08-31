<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work_type".
 *
 * @property int $id
 * @property string $name Название
 * @property int $work_kind_id
 *
 * @property WorkKind $workKind
 */
class WorkType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['work_kind_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Название',
            'work_kind_id' => 'Work Kind ID',
        ];
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
     * @return WorkTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WorkTypeQuery(get_called_class());
    }
}
