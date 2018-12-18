<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Feedata]].
 *
 * @see Feedata
 */
class FeedataQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Feedata[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Feedata|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
