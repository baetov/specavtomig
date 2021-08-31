<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ClientContact]].
 *
 * @see ClientContact
 */
class ClientContactQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ClientContact[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ClientContact|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
