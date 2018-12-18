<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "journal".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 *
 * @property Fee[] $fees
 */
class Journal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'journal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFees()
    {
        return $this->hasMany(Fee::className(), ['journal_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return JournalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JournalQuery(get_called_class());
    }
}
