<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PaymentType]].
 *
 * @see PaymentType
 */
class PaymentTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PaymentType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PaymentType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
