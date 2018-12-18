<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "track".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 *
 * @property Fee[] $fees
 */
class Track extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'track';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 150],
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
        return $this->hasMany(Fee::className(), ['track_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return TrackQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TrackQuery(get_called_class());
    }
}
