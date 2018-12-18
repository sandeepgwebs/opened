<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Speakers]].
 *
 * @see Speakers
 */
class SpeakersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Speakers[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Speakers|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
