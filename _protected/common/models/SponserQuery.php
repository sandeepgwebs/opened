<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Sponser]].
 *
 * @see Sponser
 */
class SponserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Sponser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Sponser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
