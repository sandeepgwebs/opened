<?php

namespace common\models;

use Yii;
use common\models\Category;

/**
 * This is the model class for table "members".
 *
 * @property integer $id
 * @property string $name
 * @property string $from
 * @property integer $cat_id
 * @property integer $status
 */
class Members extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'members';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id'], 'required'],
            [['cat_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['from'], 'string', 'max' => 2550],
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
            'from' => 'Institution',
            'cat_id' => 'Category',
            'status' => 'Status',
        ];
    }
	public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'cat_id']);
    }
	public function getName($id)
    {
        return Category::findOne($id);
    }
}
