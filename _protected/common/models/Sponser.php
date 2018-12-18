<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sponser".
 *
 * @property integer $id
 * @property string $image
 * @property string $title
 * @property integer $status
 */
class Sponser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sponser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'title'], 'required'],
            [['cat_id', 'status'], 'integer'],
            [['image', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_id' => 'Sponsor Category',
            'image' => 'Image',
            'title' => 'Title',
            'status' => 'Status',
        ];
    }
	public function getCat()
    {
        return $this->hasOne(SponsorCategory::className(), ['id' => 'cat_id']);
    }

    /**
     * @inheritdoc
     * @return SponserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SponserQuery(get_called_class());
    }
}
