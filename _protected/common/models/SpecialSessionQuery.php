<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[SpecialSession]].
 *
 * @see SpecialSession
 */
class SpecialSessionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SpecialSession[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SpecialSession|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
