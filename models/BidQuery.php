<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Bid]].
 *
 * @see Bid
 */
class BidQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Bid[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Bid|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
