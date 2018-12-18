<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "feedata".
 *
 * @property integer $id
 * @property integer $fee_id
 * @property integer $user_type
 * @property integer $track_id
 * @property integer $journal_id
 * @property integer $no_of_papers
 * @property string $payment
 * @property integer $status
 * @property integer $payment_method
 * @property string $payment_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthorType $userType
 * @property Fee $fee
 * @property Journal $journal
 * @property PaymentType $paymentMethod
 * @property Track $track
 */
class Feedata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedata';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fee_id', 'user_type', 'journal_id', 'created_at', 'updated_at'], 'required'],
            [['fee_id', 'user_type', 'track_id', 'journal_id', 'no_of_papers', 'status', 'payment_method', 'created_at', 'updated_at'], 'integer'],
            [['payment'], 'string', 'max' => 30],
            [['payment_id'], 'string', 'max' => 255],
            [['user_type'], 'exist', 'skipOnError' => true, 'targetClass' => AuthorType::className(), 'targetAttribute' => ['user_type' => 'id']],
            [['fee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fee::className(), 'targetAttribute' => ['fee_id' => 'id']],
            [['journal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Journal::className(), 'targetAttribute' => ['journal_id' => 'id']],
            [['payment_method'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentType::className(), 'targetAttribute' => ['payment_method' => 'id']],
            [['track_id'], 'exist', 'skipOnError' => true, 'targetClass' => Track::className(), 'targetAttribute' => ['track_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fee_id' => 'Fee ID',
            'user_type' => 'User Type',
            'track_id' => 'Track ID',
            'journal_id' => 'Journal ID',
            'no_of_papers' => 'No Of Papers',
            'payment' => 'Payment',
            'status' => 'Status',
            'payment_method' => 'Payment Method',
            'payment_id' => 'Payment ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserType()
    {
        return $this->hasOne(AuthorType::className(), ['id' => 'user_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFee()
    {
        return $this->hasOne(Fee::className(), ['id' => 'fee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournal()
    {
        return $this->hasOne(Journal::className(), ['id' => 'journal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentType::className(), ['id' => 'payment_method']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrack()
    {
        return $this->hasOne(Track::className(), ['id' => 'track_id']);
    }

    /**
     * @inheritdoc
     * @return FeedataQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FeedataQuery(get_called_class());
    }
}
