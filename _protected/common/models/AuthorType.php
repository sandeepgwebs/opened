<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "author_type".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $payment1
 * @property integer $payment2
 *
 * @property Fee[] $fees
 */
class AuthorType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'author_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'payment1', 'payment2'], 'required'],
            [['status', 'payment1', 'payment2'], 'integer'],
            [['name'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'payment1' => 'Payment1',
            'payment2' => 'Payment2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFees()
    {
        return $this->hasMany(Fee::className(), ['user_type' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AuthorTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthorTypeQuery(get_called_class());
    }
}
