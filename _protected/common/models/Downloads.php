<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;

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
            [['name', 'file'], 'required'],
            [['status', 'home_show', 'created_at', 'updated_at'], 'integer'],
			[['file'], 'file', 'extensions' => ['png','jpg','jpeg','gif','xls','csv','pdf','doc','txt']],
            [['name'], 'string', 'max' => 255],
        ];
    }
	public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
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
            'home_show' => 'Show on home page',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
