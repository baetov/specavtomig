<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[WorkType]].
 *
 * @see WorkType
 */
class WorkTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return WorkType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return WorkType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
