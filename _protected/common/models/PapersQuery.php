<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Papers]].
 *
 * @see Papers
 */
class PapersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Papers[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Papers|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
