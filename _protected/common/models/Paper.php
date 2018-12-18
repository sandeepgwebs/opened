<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "papers".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $abstract
 * @property string $key_words
 * @property string $pfile
 * @property integer $session_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Authors[] $authors
 * @property PaperComment[] $paperComments
 * @property SpecialSession $session
 * @property User $user
 */
class Paper extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'papers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'abstract', 'key_words', 'pfile', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'session_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['abstract', 'key_words'], 'string'],
            [['title', 'pfile'], 'string', 'max' => 250],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => SpecialSession::className(), 'targetAttribute' => ['session_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'abstract' => 'Abstract',
            'key_words' => 'Key Words',
            'pfile' => 'Pfile',
            'session_id' => 'Session ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Authors::className(), ['paper_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaperComments()
    {
        return $this->hasMany(PaperComment::className(), ['paper_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSession()
    {
        return $this->hasOne(SpecialSession::className(), ['id' => 'session_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return PaperQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaperQuery(get_called_class());
    }
}
