<?php

namespace frontend\models;



use common\models\User;

use common\models\Applications;

use common\rbac\helpers\RbacHelper;

use nenad\passwordStrength\StrengthValidator;

use yii\base\Model;

use Yii;



/**

 * Model representing  Signup Form.

 */

class SignupForm extends Model

{

    public $fname;

    public $lname;

    public $email;

    public $retypeEmail;

    public $verifyCode;

    public $accesscode;





    /**

     * Returns the validation rules for attributes.

     *

     * @return array

     */

    public function rules()

    {

        return [



            [['fname'], 'required'],

            ['email', 'filter', 'filter' => 'trim'],

            ['email', 'required'],

            ['email', 'email'],

            //[['accesscode'], 'string', 'max' => 20],

            [['fname', 'lname'], 'string', 'max' => 20],

            ['email', 'string', 'max' => 255],

            ['email', 'unique', 'targetClass' => '\common\models\User', 

                'message' => 'This email address has already been taken.'],

            ['retypeEmail', 'compare', 'compareAttribute'=>'email', 'message'=>"Emails don't match"],

            ['verifyCode', 'captcha'],

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

            'retypeEmail' => Yii::t('app', 'Re-enter Email'),

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



        $user->username = $this->username;

        $user->email = $this->email;

        $user->setPassword($this->password);

        $user->generateAuthKey();

        $user->status = $this->status;



        // if scenario is "rna" we will generate account activation token

        if ($this->scenario === 'rna')

        {

            $user->generateAccountActivationToken();

        }



        // if user is saved and role is assigned return user object

        return $user->save() && RbacHelper::assignRole($user->getId()) ? $user : null;

    }

    public function application()

    {

        $user = new Applications();



        $user->fname = $this->fname;

        $user->lname = $this->lname;

        $user->email = $this->email;



        $user->accesscode = $this->accesscode;



        return $user->save();

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

}

