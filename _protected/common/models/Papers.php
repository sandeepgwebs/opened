<?php

namespace common\models;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

use common\models\User;
use common\models\Applications;
use common\rbac\helpers\RbacHelper;
use nenad\passwordStrength\StrengthValidator;
use yii\base\Model;
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
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Authors[] $authors
 * @property User $user
 */
class Papers extends ActiveRecord
{
	public $fname0, $fname1,$fname2,$fname3,$fname4,$fname5,$fname6,$fname7,$fname8;
	public $lname0, $lname1,$lname2,$lname3,$lname4,$lname5,$lname6,$lname7,$lname8;
	public $email0, $email1,$email2,$email3,$email4,$email5,$email6,$email7,$email8;
	public $country_id0, $country_id1, $country_id2, $country_id3, $country_id4, $country_id5, $country_id6, $country_id7, $country_id8;
	public $organization0, $organization1, $organization2, $organization3, $organization4, $organization5, $organization6, $organization7, $organization8;
	public $webpage0, $webpage1, $webpage2, $webpage3, $webpage4, $webpage5, $webpage6, $webpage7, $webpage8;
	public $corresp0, $corresp1, $corresp2, $corresp3, $corresp4, $corresp5, $corresp6, $corresp7, $corresp8;
	public $count = 3;
	
    
    public static function tableName()
    {
        return 'papers';
    }

   
    public function rules()
    {
        return [
            [['user_id', 'title', 'abstract', 'session_id', 'key_words', 'pfile'], 'required'],
			[['pfile'], 'file', 'extensions' => 'pdf, doc, docx',],
            [['fname0', 'email0', 'country_id0', 'organization0'],'required'],
            [['email1', 'country_id1', 'organization1'],'required', 'when' => function($model) {
			return $model->fname1 != null;}, 'whenClient' => "function (attribute, value) { return $('#papers-fname1').val() != ''; }"],
            [['email2', 'country_id2', 'organization2'],'required', 'when' => function($model) {
			return $model->fname2 != null;}, 'whenClient' => "function (attribute, value) { return $('#papers-fname2').val() != ''; }"],
            [['email3', 'country_id3', 'organization3'],'required', 'when' => function($model) {
			return $model->fname3 != null;}, 'whenClient' => "function (attribute, value) { return $('#papers-fname3').val() != ''; }"],
            [['email4', 'country_id4', 'organization4'],'required', 'when' => function($model) {
			return $model->fname4 != null;}, 'whenClient' => "function (attribute, value) { return $('#papers-fname4').val() != ''; }"],
            [['email5', 'country_id5', 'organization5'],'required', 'when' => function($model) {
			return $model->fname5 != null;}, 'whenClient' => "function (attribute, value) { return $('#papers-fname5').val() != ''; }"],
            [['email6', 'country_id6', 'organization6'],'required', 'when' => function($model) {
			return $model->fname6 != null;}, 'whenClient' => "function (attribute, value) { return $('#papers-fname6').val() != ''; }"],
            [['email7', 'country_id7', 'organization7'],'required', 'when' => function($model) {
			return $model->fname7 != null;}, 'whenClient' => "function (attribute, value) { return $('#papers-fname7').val() != ''; }"],
            [['email8', 'country_id8', 'organization8'],'required', 'when' => function($model) {
			return $model->fname8 != null;}, 'whenClient' => "function (attribute, value) { return $('#papers-fname8').val() != ''; }"],
            [['user_id', 'status', 'session_id', 'created_at', 'updated_at'], 'integer'],
			
			
			[['country_id0', 'corresp0'], 'integer'],
            [['fname0', 'lname0', 'email0'], 'string', 'max' => 50],
            [['organization0'], 'string', 'max' => 250],
            [['webpage0'], 'string', 'max' => 100],
			[['country_id1', 'corresp1'], 'integer'],
            [['fname1', 'lname1', 'email1'], 'string', 'max' => 50],
            [['organization1'], 'string', 'max' => 250],
            [['webpage1'], 'string', 'max' => 100],
			[['country_id2', 'corresp2'], 'integer'],
            [['fname2', 'lname2', 'email2'], 'string', 'max' => 50],
            [['organization2'], 'string', 'max' => 250],
            [['webpage2'], 'string', 'max' => 100],
			[['country_id3', 'corresp3'], 'integer'],
            [['fname3', 'lname3', 'email3'], 'string', 'max' => 50],
            [['organization3'], 'string', 'max' => 250],
            [['webpage3'], 'string', 'max' => 100],
			[['country_id4', 'corresp4'], 'integer'],
            [['fname4', 'lname4', 'email4'], 'string', 'max' => 50],
            [['organization4'], 'string', 'max' => 250],
            [['webpage4'], 'string', 'max' => 100],
			[['country_id5', 'corresp5'], 'integer'],
            [['fname5', 'lname5', 'email5'], 'string', 'max' => 50],
            [['organization5'], 'string', 'max' => 250],
            [['webpage5'], 'string', 'max' => 100],
			[['country_id6', 'corresp6'], 'integer'],
            [['fname6', 'lname6', 'email6'], 'string', 'max' => 50],
            [['organization6'], 'string', 'max' => 250],
            [['webpage6'], 'string', 'max' => 100],
			[['country_id7', 'corresp7'], 'integer'],
            [['fname7', 'lname7', 'email7'], 'string', 'max' => 50],
            [['organization7'], 'string', 'max' => 250],
            [['webpage7'], 'string', 'max' => 100],
			[['country_id8', 'corresp8'], 'integer'],
            [['fname8', 'lname8', 'email8'], 'string', 'max' => 50],
            [['organization8'], 'string', 'max' => 250],
            [['webpage8'], 'string', 'max' => 100],			
			
            [['abstract', 'key_words'], 'string'],
            [['email0', 'email1', 'email2', 'email3', 'email4', 'email5', 'email6', 'email7', 'email8'], 'email'],
            
            [['title', 'pfile'], 'string', 'max' => 250],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'abstract' => 'Abstract',
            'key_words' => 'Keywords',
            'pfile' => 'Select file to upload',
            'status' => 'Status',
            'session_id' => 'Session',
            'created_at' => 'Submission Date',
            'updated_at' => 'Updated At',
            'fname0' => 'First Name',
            'lname0' => 'Last Name',
            'webpage0' => 'Webpage',
            'organization0' => 'Organization',
            'email0' => 'Email',
            'country_id0' => 'Country',
            'corresp0' => 'Corresponding author',
            'fname1' => 'First Name',
            'lname1' => 'Last Name',
            'webpage1' => 'Webpage',
            'organization1' => 'Organization',
            'email1' => 'Email',
            'country_id1' => 'Country',
            'corresp1' => 'Corresponding author',
            'fname2' => 'First Name',
            'lname2' => 'Last Name',
            'webpage2' => 'Webpage',
            'organization2' => 'Organization',
            'email2' => 'Email',
            'country_id2' => 'Country',
            'corresp2' => 'Corresponding author',
            'fname3' => 'First Name',
            'lname3' => 'Last Name',
            'webpage3' => 'Webpage',
            'organization3' => 'Organization',
            'email3' => 'Email',
            'country_id3' => 'Country',
            'corresp3' => 'Corresponding author',
            'fname4' => 'First Name',
            'lname4' => 'Last Name',
            'webpage4' => 'Webpage',
            'organization4' => 'Organization',
            'email4' => 'Email',
            'country_id4' => 'Country',
            'corresp4' => 'Corresponding author',
            'fname5' => 'First Name',
            'lname5' => 'Last Name',
            'webpage5' => 'Webpage',
            'organization5' => 'Organization',
            'email5' => 'Email',
            'country_id5' => 'Country',
            'corresp5' => 'Corresponding author',
            'fname6' => 'First Name',
            'lname6' => 'Last Name',
            'webpage6' => 'Webpage',
            'organization6' => 'Organization',
            'email6' => 'Email',
            'country_id6' => 'Country',
            'corresp6' => 'Corresponding author',
        ];
    }

    public function sendMail($email,$subject,$body)
    {

        $send =  Yii::$app->mailer->compose(['html' => '@common/mail/views/accountcreation'], ['message'=>$body])
            ->setTo($email)
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setSubject($subject)
            ->send();

    }
    public function getAuthors()
    {
        return $this->hasMany(Authors::className(), ['paper_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
	public function getSession()
    {
        return $this->hasOne(SpecialSession::className(), ['id' => 'session_id']);
    }
	 public function getCountries()
    {
        $countries = Countries::find()->where(['status' => 1])->orderBy('name')->all();
        return ArrayHelper::map($countries,'id','name');
    }
     public function getSessions()
    {
        $countries = SpecialSession::find()->where(['status' => 1])->all();
        return ArrayHelper::map($countries,'id','name');
    }
	public function getPaperDecision()
	{
		if($this->status == 1 || $this->status == 0){
			return '<b style="color:#E08E0B">No decision taken<b>';
		} elseif($this->status == 2){
			return '<b style="color:#008D4C">Accepted</b>';
		} else {
			return '<b style="color:#D73925">Rejected</b>';
		}
	}

 
    public static function find()
    {
        return new PapersQuery(get_called_class());
    }
}
