<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "paper_comment".
 *
 * @property integer $id
 * @property integer $paper_id
 * @property string $comment
 * @property integer $type
 * @property integer $created_at
 *
 * @property Papers $paper
 */
class PaperComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paper_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['paper_id', 'type'], 'required'],
            [['paper_id', 'type', 'created_at'], 'integer'],
            [['comment'], 'string'],
            [['paper_id'], 'exist', 'skipOnError' => true, 'targetClass' => Papers::className(), 'targetAttribute' => ['paper_id' => 'id']],
        ];
    }
	public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
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
            'paper_id' => 'Paper ID',
            'comment' => 'Comment',
            'type' => 'Type',
            'created_at' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaper()
    {
        return $this->hasOne(Papers::className(), ['id' => 'paper_id']);
    }

    /**
     * @inheritdoc
     * @return PaperCommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaperCommentQuery(get_called_class());
    }
}
