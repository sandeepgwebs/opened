<?php
namespace frontend\models;

use common\models\User;
use common\models\Countries;
use common\models\States;
use common\rbac\helpers\RbacHelper;
use nenad\passwordStrength\StrengthValidator;
use yii\base\Model;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Model representing  Signup Form.
 */
class AuthorSignupForm extends Model
{
    public $fname;
    public $lname;
    public $email;
    public $phone;
    public $country;
    public $state;
    public $city;
    public $password;
    public $repassword;


    /**
     * Returns the validation rules for attributes.
     *
     * @return array
     */
    public function rules()
    {
        return [

            [['fname', 'phone', 'password', 'email'], 'required'],
            ['country', 'required', 'message' => 'Please select one of the countries.'],
            ['state', 'required', 'message' => 'Please select one of the states.'],
            ['city', 'required', 'message' => 'Please select one of the cities.'],
            [['country', 'state', 'city', 'phone'], 'integer'],
            ['fname', 'filter', 'filter' => 'trim'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            $this->passwordStrengthRule(),
            ['repassword', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match"],
            //[['accesscode'], 'string', 'max' => 20],
            [['fname', 'lname'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User',
                'message' => 'This email address has already been taken.'],
           [['phone'], 'string', 'min' => 8, 'message'=>"Contact number should be integer with minimum 8 digits"],

        ];
    }

    /**
     * Set password rule based on our setting value (Force Strong Password).
     *
     * @return array Password strength rule
     */
    private function passwordStrengthRule()
    {
        // get setting value for 'Force Strong Password'
        $fsp = Yii::$app->params['fsp'];

        // password strength rule is determined by StrengthValidator 
        // presets are located in: vendor/nenad/yii2-password-strength/presets.php
        $strong = [['password'], StrengthValidator::className(), 'preset'=>'normal'];

        // use normal yii rule
        $normal = ['password', 'string', 'min' => 6];

        // if 'Force Strong Password' is set to 'true' use $strong rule, else use $normal rule
        return ($fsp) ? $strong : $normal;
    }

    /**
     * Returns the attribute labels.
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'fname' => Yii::t('app', 'First Name'),
            'lname' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email'),
        ];
    }

    /**
     * Signs up the user.
     * If scenario is set to "rna" (registration needs activation), this means
     * that user need to activate his account using email confirmation method.
     *
     * @return User|null The saved model or null if saving fails.
     */

    public function signup()
    {
        $user = new User();

        $user->username = $this->email;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->status = 10;
        $user->usertype = 2;

        // if scenario is "rna" we will generate account activation token
        if ($this->scenario === 'rna')
        {
            $user->generateAccountActivationToken();
        }

        // if user is saved and role is assigned return user object
        return $user->save() && RbacHelper::assignRole($user->getId()) ? $user : null;
    }

    /**
     * Sends email to registered user with account activation link.
     *
     * @param  object $user Registered user.
     * @return bool         Whether the message has been sent successfully.
     */
    public function sendAccountActivationEmail($user)
    {
        return Yii::$app->mailer->compose('accountActivationToken', ['user' => $user])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account activation for ' . Yii::$app->name)
            ->send();
    }
    public function sendMail($email,$subject,$body)
    {

        $send =  Yii::$app->mailer->compose(['html' => '@common/mail/views/accountcreation'], ['message'=>$body])
            ->setTo($this->email)
            ->setFrom($email)
            ->setSubject($subject)
            ->send();

    }

    public function getCountries()
    {

        $countries = Countries::find()->where(['status' => 1])->orderBy('name')->all();

        return ArrayHelper::map($countries,'id','name');

    }
    public function getStates()
    {

        $states = States::find()->where(['status' => 1,'country_id'=>101])->orderBy('name')->all();

        return ArrayHelper::map($states,'id','name');

    }
}
