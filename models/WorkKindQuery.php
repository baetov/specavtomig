<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[WorkKind]].
 *
 * @see WorkKind
 */
class WorkKindQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return WorkKind[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return WorkKind|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
