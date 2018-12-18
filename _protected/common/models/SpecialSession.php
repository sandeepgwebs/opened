<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "special_session".
 *
 * @property integer $id
 * @property string $name
 * @property string $theme
 * @property string $chair
 * @property string $file
 * @property integer $status
 */
class SpecialSession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'special_session';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'theme', 'chair'], 'required'],
            [['status'], 'integer'],
			[['file'], 'file', 'extensions' => ['png','jpg','jpeg','gif','xls','csv','pdf','doc','docx','txt']],
            [['name', 'chair'], 'string', 'max' => 255],
            [['theme'], 'string'],
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
            'theme' => 'Theme',
            'chair' => 'Session Chair',
            'file' => 'File',
            'status' => 'Status',
        ];
    }
	
	public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return SpecialSessionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SpecialSessionQuery(get_called_class());
    }
}
