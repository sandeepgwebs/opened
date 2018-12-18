<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "configs".
 *
 * @property integer $id
 * @property string $name
 * @property string $message
 * @property integer $status
 */
class Configs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'configs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'message'], 'required'],
            [['message'], 'string'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 100],
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
            'message' => 'Message',
            'status' => 'Status',
        ];
    }

    /**
     * @inheritdoc
     * @return ConfigsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConfigsQuery(get_called_class());
    }
}
