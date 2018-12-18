<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * This is the model class for table "exam_date".
 *
 * @property integer $id
 * @property string $name
 * @property integer $exam_date
 * @property integer $created_at
 * @property integer $updated_at
 */
class ExamDate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_date';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','type', 'exam_date'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name','type','exam_date'], 'string', 'max' => 2550],
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
            'name' => 'Title',
            'exam_date' => 'Date',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
