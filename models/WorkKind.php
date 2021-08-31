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
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $bankAll = WorkType::find()->where(['work_kind_id' => $this->id,])->all();
        foreach ($bankAll as $item1) {
            $a = false;
            if ($this->workTypes == null) {
                $item1->delete();
                continue;
            }
            foreach ($this->workTypes as $item3) {
                if ($item3['id'] == $item1->id) {
                    $a = true;
                }
                if (!$a) {
                    $item1->delete();
                    break;
                }
            }
        }
        if($this->workTypes != null){
            foreach ($this->workTypes as $item) {
                $bank = WorkType::find()->where(['id' => $item['id']])->one();
                if (!$bank) {
                    (new WorkType([
                        'work_kind_id' => $this->id,
                        'name' => $item['name'],
                    ]))->save(false);
                } else {
                    $bank->name = $item['name'];
                    $bank->save(false);
                }
            }
        }
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
