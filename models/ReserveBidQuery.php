<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ReserveBid]].
 *
 * @see ReserveBid
 */
class ReserveBidQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ReserveBid[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ReserveBid|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
