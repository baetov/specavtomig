<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TechnicType]].
 *
 * @see TechnicType
 */
class TechnicTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TechnicType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TechnicType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
