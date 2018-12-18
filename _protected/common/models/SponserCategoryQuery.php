<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[SponserCategory]].
 *
 * @see SponserCategory
 */
class SponserCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SponserCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SponserCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
