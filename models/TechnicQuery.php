<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Technic]].
 *
 * @see Technic
 */
class TechnicQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Technic[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Technic|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
