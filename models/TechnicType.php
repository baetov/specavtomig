<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "technic_type".
 *
 * @property int $id
 * @property string $name Вид Техники
 * @property array $subgroups подгруппы
 *
 * @property Technic[] $technics
 * @property TechnicTypeSubgroup[] $technicTypeSubgroups
 */
class TechnicType extends \yii\db\ActiveRecord
{
    public $subgroups;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'technic_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['subgroups',], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Вид Техники',
            'subgroups' => 'Подгруппа'
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($this->subgroups != null) {
            $bankAll = TechnicTypeSubgroup::find()->where(['technic_type_id' => $this->id,])->all();
            foreach ($bankAll as $item1) {
                $a = false;
                if ($this->subgroups == null) {
                    $item1->delete();
                    continue;
                }
                foreach ($this->subgroups as $item3) {
                    if ($item3['id'] == $item1->id) {
                        $a = true;
                    }
                    if (!$a) {
                        $item1->delete();
                        break;
                    }
                }
            }
            if ($this->subgroups != null) {
                foreach ($this->subgroups as $item) {
                    $bank = TechnicTypeSubgroup::find()->where(['id' => $item['id']])->one();
                    if (!$bank) {
                        (new TechnicTypeSubgroup([
                            'technic_type_id' => $this->id,
                            'name' => $item['name'],
                        ]))->save(false);
                    } else {
                        $bank->name = $item['name'];
                        $bank->save(false);
                    }
                }
            }
        }else {
            TechnicTypeSubgroup::deleteAll(['technic_type_id' => $this->id]);
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTechnics()
    {
        return $this->hasMany(Technic::className(), ['type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTechnicTypeSubgroups()
    {
        return $this->hasMany(TechnicTypeSubgroup::className(), ['technic_type_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TechnicTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TechnicTypeQuery(get_called_class());
    }
}
