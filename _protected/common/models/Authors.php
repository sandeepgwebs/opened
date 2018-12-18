<?php

namespace common\models;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

use common\models\User;
use common\models\Applications;
use common\rbac\helpers\RbacHelper;
use nenad\passwordStrength\StrengthValidator;
use yii\base\Model;
use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property integer $id
 * @property integer $paper_id
 * @property string $fname
 * @property string $lname
 * @property string $email
 * @property integer $country_id
 * @property string $organization
 * @property string $webpage
 * @property integer $corresp
 *
 * @property Papers $paper
 */
class Authors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['paper_id', 'fname', 'email', 'country_id', 'organization'], 'required'],
            [['paper_id', 'country_id', 'corresp'], 'integer'],
            [['fname', 'lname', 'email'], 'string', 'max' => 50],
            [['organization'], 'string', 'max' => 250],
            [['webpage'], 'string', 'max' => 100],
            [['paper_id'], 'exist', 'skipOnError' => true, 'targetClass' => Papers::className(), 'targetAttribute' => ['paper_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'paper_id' => 'Paper ID',
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'email' => 'Email',
            'country_id' => 'Country ID',
            'organization' => 'Organization',
            'webpage' => 'Webpage',
            'corresp' => 'Corresp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaper()
    {
        return $this->hasOne(Papers::className(), ['id' => 'paper_id']);
    }
	public function getCountries()
    {
        $countries = Countries::find()->where(['status' => 1])->orderBy('name')->all();
        return ArrayHelper::map($countries,'id','name');
    }
	public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }
    /**
     * @inheritdoc
     * @return AuthorsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthorsQuery(get_called_class());
    }
	public function sendMail($email,$subject,$body)
    {

        $send =  Yii::$app->mailer->compose(['html' => '@common/mail/views/accountcreation'], ['message'=>$body])
            ->setTo($this->email)
            ->setFrom($email)
            ->setSubject($subject)
            ->send();

    }
}
