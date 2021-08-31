<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Scan]].
 *
 * @see Scan
 */
class ScanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Scan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Scan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
