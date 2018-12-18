<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "downloads".
 *
 * @property integer $id
 * @property string $name
 * @property string $file
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Downloads extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'downloads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'file', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'file'], 'string', 'max' => 255],
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
            'file' => 'File',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
