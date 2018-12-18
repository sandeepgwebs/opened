<?php
namespace frontend\models;

use yii\base\Model;
use Yii;

/**
 * ContactForm is the model behind the contact form.
 */
class TrackOrder extends Model
{
    public $orderid;
    public $email;


    /**
     * Returns the validation rules for attributes.
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['orderid', 'email','verifyCode'], 'required'],
            ['email' , 'email'],
            ['orderid' , 'string'],

        ];
    }

    /**
     * Returns the attribute labels.
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'orderid'=> Yii::t('app', 'Tracking Code'),
            'email' => Yii::t('app', 'Your Email'),
            'verifyCode' => Yii::t('app', 'Verification Code'),
        ];
    }

}
