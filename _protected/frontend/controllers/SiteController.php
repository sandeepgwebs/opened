<?php
namespace frontend\controllers;
use yii\helpers\Url;
use common\models\User;
use frontend\models\Member;
use common\rbac\models\Role;
use frontend\models\LoginForm;
use common\models\Speakers;
use common\models\Pages;
use common\models\Newsletter;
use common\models\Testimonial;
use common\models\Category;
use common\models\Downloads;
use common\models\SessionPapersSearch;
use common\models\SpecialSession;
use common\models\Members;
use common\models\Attributes;
use common\models\Applications;
use frontend\models\AccountActivation;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SearchForm;
use frontend\models\FriendForm;
use frontend\models\SignupForm;
use frontend\models\ChairSignupForm;
use frontend\models\AuthorSignupForm;
use frontend\models\ContactForm;
use common\models\Profile;
use yii\helpers\Html;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\traits\MessageSendTrait;
use frontend\models\TrackOrder;
use Yii;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use common\models\Papers;
use common\models\Paper;
use common\models\PaperComment;
use yii\helpers\ArrayHelper;
use common\traits\FileUploadTrait;
use yii\imagine\Image;
use kartik\file\FileInput;
use yii\web\UploadedFile;
use common\models\AuthorsSearch;
/**
 * Site controller.
 * It is responsible for displaying static pages, logging users in and out,
 * sign up and account activation, password reset.
 */
class SiteController extends Controller
{
	
	use MessageSendTrait;
	use FileUploadTrait;
    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','account'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
			'eauth' => [
                        // required to disable csrf validation on OpenID requests
                        'class' => \nodge\eauth\openid\ControllerBehavior::className(),
                        'only' => ['login'],
                    ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Declares external actions for the controller.
     *
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
				
            ],
        ];
    }


    public function actionIndex()
    { 

		$model = new ContactForm();
		
        if ($model->load(Yii::$app->request->post())) 
        {
			
            if ($model->contact(Yii::$app->params['adminEmail'])) 
            {
                Yii::$app->session->setFlash('success', 
                    'Thank you for contacting us. We will respond to you as soon as possible.');
            } 
            else 
            {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } 
        
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSend()
    {
        $send =  Yii::$app->mailer->compose(['html' => '@common/mail/views/accountcreation'], ['message'=>"Test Message"])
            ->setTo("gnetblogers@gmail.com")
            ->setFrom("admin@iresconf.org")
            ->setSubject("Test Subject1")
            ->send();
			print_r($send);
			/* $msg = "let me know when you got this email. (Amitab)";

			// send email
			if(mail("gnetblogers@gmail.com,gurwinder.gwebs@mail.com","Test email from drish.com server",$msg)){
				echo "mail successfully sent!";
			}else{
				print_r(error_get_last());
			} */
    }

	public function actionSociallogin()
    {
        return $this->render('sociallogin');
    }

    public function actionContact()
    {

        $model = new ContactForm();
		$this->layout = "simple";
        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            if ($model->contact(Yii::$app->params['adminEmail'])) 
            {
                Yii::$app->session->setFlash('success', 
                    'Thank you for contacting us. We will respond to you as soon as possible.');
            } 
            else 
            {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } 
        
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
   
    public function actionLogin()
    {
        $this->layout = 'main-login';
        if (!Yii::$app->user->isGuest){
            return $this->goHome();
        }

        // get setting value for 'Login With Email'
        $lwe = Yii::$app->params['lwe'];

        // if 'lwe' value is 'true' we instantiate LoginForm in 'lwe' scenario
        $model = $lwe ? new LoginForm(['scenario' => 'lwe']) : new LoginForm();

        // now we can try to log in the user
        if ($model->load(Yii::$app->request->post()) && $model->login()) 
        {
			if(Yii::$app->request->get('tc')=="sb"){
				return $this->redirect(['papers/create']);
			} else {				
            return $this->redirect(['site/special-session']);
			}
        }
        // user couldn't be logged in, because he has not activated his account
        elseif($model->notActivated())
        {
            // if his account is not activated, he will have to activate it first
            Yii::$app->session->setFlash('error', 
                'You have to activate your account first. Please check your email.');

            return $this->refresh();
        }    
        // account is activated, but some other errors have happened
        else
        {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
	
	public function actionChairLogin()
    {
        $this->layout = 'main-login';
        if (!Yii::$app->user->isGuest) 
        {
			
            return $this->goHome();
        }

        // get setting value for 'Login With Email'
        $lwe = Yii::$app->params['lwe'];

        // if 'lwe' value is 'true' we instantiate LoginForm in 'lwe' scenario
        $model = $lwe ? new LoginForm(['scenario' => 'lwe']) : new LoginForm();

        // now we can try to log in the user
        if($model->load(Yii::$app->request->post()) && $model->chairlogin()) 
        {			
			{			
				return $this->redirect(['site/my-account']);
			}
        }
        // user couldn't be logged in, because he has not activated his account
        elseif($model->notActivated())
        {
			
            // if his account is not activated, he will have to activate it first
            Yii::$app->session->setFlash('error', 
                'Your account is not active. Please contact administartor to activate your account.');

        }    
        // account is activated, but some other errors have happened
        else
        {
            return $this->render('chair-login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionDownloadList()
    {
        $file = Yii::$app->params['uploadurl'].'/uploads/downloads/List of Registered Papers.pdf';

            if (file_exists($file)) {

                Yii::$app->response->sendFile($file);

            }
    }

    public function actionSignout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            if($model->sendEmail()) 
            {
				return $this->redirect(['request-send','email'=>$model->email]);
                Yii::$app->session->setFlash('success', 
                    'Check your email for further instructions.');

                return $this->goHome();
            } 
            else 
            {
                Yii::$app->session->setFlash('error', 
                    'Sorry, we are unable to reset password for email provided.');
            }
        }
        else
        {
            return $this->render('requestPasswordResetToken', [
                'model' => $model,
            ]);
        }
    }
	public function actionRequestSend($email)
    {
		return $this->render('request-send',['email'=> $email]); 			             
    }

    public function actionResetPassword($token)
    {
        try 
        {
            $model = new ResetPasswordForm($token);
        } 
        catch (InvalidParamException $e) 
        {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) 
            && $model->validate() && $model->resetPassword()) 
        {
            Yii::$app->session->setFlash('success', 'Password has been changed successfully. Please login to your account.');
			if($model->_user->usertype==3){
				return $this->redirect(['site/chair-login']);
			} else {
				return $this->redirect(['site/login']);
			}
        }
        else
        {
            return $this->render('resetPassword', [
                'model' => $model,
            ]);
        }       
    }   

	public function actionSignup()
    {
		
        $session = Yii::$app->session;
        $this->layout = 'main-login';
        if(!isset($_SESSION['accountmsg'])){
			
            $model = new SignupForm();

            // collect and validate user data
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $token = str_split('abcdefghijklmnopqrstuvwxyz' . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                shuffle($token);
                do {
                    $rand = '';
                    foreach (array_rand($token, 20) as $k) $rand .= $token[$k];
                } while(Applications::findOne(['accesscode' => $rand]) !== null);

                $model->accesscode = $rand;

                if (($oldApplication = Applications::findOne(['email' => $model->email])) !== null) {
					
                    $body = "<h3>Dear " . $model->fname . " " .$model->lname."</h3>";
                    if ($oldApplication->status == 0) {
                        $body .= '<p>We received a request to create '.Yii::$app->params['siteName'].' account for you. To create a '.Yii::$app->params['siteName'].' account, please click this link:</p>';
                        $body .= Html::a(Html::encode(Url::to(['/site/create', 'code' => $oldApplication->accesscode], true)), Url::to(['/site/create', 'code' => $oldApplication->accesscode], true));
                        $model->sendMail('admin@iresconf.org', 'Create IRES 2017 Account', $body);
                        $session->set('accountmsg', 'We received your application. A mail with further instructions has been sent to the email address ' . $model->email . '. If you do not get message in inbox of your email account, please check <span style="color:red;">spam</span> of your email.');
                    } elseif ($oldApplication->status == 1) {
                        $body .= '<p>We received a request to create '.Yii::$app->params['siteName'].' account for you. Since you already have an '.Yii::$app->params['siteName'].' account,
you do not have to create a new one. If you forgot
your user name or password, please click this link:</p>';
                        $body .= Html::a(Html::encode(Url::to(['/site/request-password-reset'], true)), Url::to(['/site/request-password-reset', 'code' => $oldApplication->accesscode], true));
                        $model->sendMail('admin@iresconf.org', 'Create '.Yii::$app->params['siteName'].' Account', $body);
                        $session->set('accountmsg', 'We received your application. A mail with further instructions has been sent to the email address ' . $model->email . '. If you do not get message in inbox of your email account, please check <span style="color:red;">spam</span> of your email.');
                    } else {
                        $body .= '<p>We received a request to create '.Yii::$app->params['siteName'].' account for you, but your account has been blocked</p>';
                        $model->sendMail('admin@iresconf.org', 'Create '.Yii::$app->params['siteName'].' Account', $body);
                        $session->set('accountmsg', 'We received your application. A mail with further instructions has been sent to the email address ' . $model->email . '. If you do not get message in inbox of your email account, please check <span style="color:red;">spam</span> of your email.');
                    }
                    return $this->refresh();
                } else {
					if($model->application()){
					$body = "<h3>Dear " . $model->fname . " " .$model->lname."</h3>";
                    
                        $body .= '<p>We received a request to create '.Yii::$app->params['siteName'].' account for you. To create a '.Yii::$app->params['siteName'].' account, please click this link:</p>';
                        $body .= Html::a(Html::encode(Url::to(['/site/create', 'code' => $model->accesscode], true)), Url::to(['/site/create', 'code' => $model->accesscode], true));
                        $model->sendMail('admin@iresconf.org', 'Create '.Yii::$app->params['siteName'].' Account', $body);
                        $session->set('accountmsg', 'We received your application. A mail with further instructions has been sent to the email address '.$model->email.'. If you do not get message in inbox of your email account, please check <span style="color:red;">spam</span> of your email.');
					}
						return $this->refresh();
					}                  

            } else {				
				return $this->render('signup', [
					'model' => $model,
			]);
			}
        } else {
            $msg = $session->get('accountmsg');
            $session->remove('accountmsg');
            return $this->render('signup2', [
                'message' => $msg,
            ]);
        }
    }	

	/*public function actionSignup()
    {
		
        $session = Yii::$app->session;
        $this->layout = 'main-login';
        if(!isset($_SESSION['accountmsg'])){
			
            $model = new SignupForm();

            // collect and validate user data
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $token = str_split('abcdefghijklmnopqrstuvwxyz' . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                shuffle($token);
                do {
                    $rand = '';
                    foreach (array_rand($token, 20) as $k) $rand .= $token[$k];
                } while(Applications::findOne(['accesscode' => $rand]) !== null);

                $model->accesscode = $rand;

                if (($oldApplication = Applications::findOne(['email' => $model->email])) !== null) {
					
                    $body = "<h3>Dear " . $model->fname . " " .$model->lname."</h3>";
                    if ($oldApplication->status == 0) {
                        $body .= '<p>We received a request to create a '.Yii::$app->params['siteName'].' account for you. To create a '.Yii::$app->params['siteName'].' account, please click this link:</p>';
                        $body .= Html::a(Html::encode(Url::to(['/site/create', 'code' => $oldApplication->accesscode], true)), Url::to(['/site/create', 'code' => $oldApplication->accesscode], true));
                        $model->sendMail(Yii::$app->params['adminEmail'], 'Create IRES 2017 Account', $body);
                        $session->set('accountmsg', 'We received your application. A mail with further instructions has been sent to the email address ' . $model->email . '. If you do not get message in inbox of your email account, please check <span style="color:red;">spam</span> of your email.');
                    } elseif ($oldApplication->status == 1) {
                        $body .= '<p>We received a request to create a '.Yii::$app->params['siteName'].' account for you. Since you already have an '.Yii::$app->params['siteName'].' account,
you do not have to create a new one. If you forgot
your user name or password, please click this link:</p>';
                        $body .= Html::a(Html::encode(Url::to(['/site/request-password-reset'], true)), Url::to(['/site/request-password-reset', 'code' => $oldApplication->accesscode], true));
                        $model->sendMail(Yii::$app->params['adminEmail'], 'Create '.Yii::$app->params['siteName'].' Account', $body);
                        $session->set('accountmsg', 'We received your application. A mail with further instructions has been sent to the email address ' . $model->email . '. If you do not get message in inbox of your email account, please check <span style="color:red;">spam</span> of your email.');
                    } else {
                        $body .= '<p>We received a request to create a '.Yii::$app->params['siteName'].' account for you, but your account has been blocked</p>';
                        $model->sendMail(Yii::$app->params['adminEmail'], 'Create '.Yii::$app->params['siteName'].' Account', $body);
                        $session->set('accountmsg', 'We received your application. A mail with further instructions has been sent to the email address ' . $model->email . '. If you do not get message in inbox of your email account, please check <span style="color:red;">spam</span> of your email.');
                    }
                    return $this->refresh();
                } else {
					if($model->application()){
					$body = "<h3>Dear " . $model->fname . " " .$model->lname."</h3>";
                    
                        $body .= '<p>We received a request to create a '.Yii::$app->params['siteName'].' account for you. To create an '.Yii::$app->params['siteName'].' account, please click this link:</p>';
                        $body .= Html::a(Html::encode(Url::to(['/site/create', 'code' => $model->accesscode], true)), Url::to(['/site/create', 'code' => $model->accesscode], true));
                        $model->sendMail(Yii::$app->params['adminEmail'], 'Create '.Yii::$app->params['siteName'].' Account', $body);
                        $session->set('accountmsg', 'We received your application. A mail with further instructions has been sent to the email address ' . $model->email . '.');
					}
						return $this->refresh();
					}                  

            } else {				
				return $this->render('signup', [
					'model' => $model,
			]);
			}
        } else {
            $msg = $session->get('accountmsg');
            $session->remove('accountmsg');
            return $this->render('signup2', [
                'message' => $msg,
            ]);
        }
    }*/
	
	public function actionCreate()
    {
        $session = Yii::$app->session;
        $this->layout = 'main-login';
        $code = Yii::$app->request->get('code');

        if(isset($code)){
            $code = Yii::$app->request->get('code');
            if(($model = Applications::findOne(['accesscode' => $code]))!==null){
                if($model->status == 0){
                    $user = new Member(['scenario' => 'create']);
                    $user->fname = $model->fname;
                    $user->lname = $model->lname;
                    $user->email = $model->email;
                    $user->username = $model->email;
                    $user->status = 10;
                    if (Yii::$app->request->isAjax && $user->load(Yii::$app->request->post())) {
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        return ActiveForm::validate($user);
                    }
                    $role = new Role();
                    $role->item_name = "member";
                    $user->usertype = 2;

                    if($user->load(Yii::$app->request->post()) && $user->validate()){
                        $user->setPassword($user->password);
                        $user->generateAuthKey();
                        if ($user->save()){
                            $role->user_id = $user->getId();
                            $role->save();
                            $profile = new Profile();
                            $profile->user_id = $user->id;
                            $profile->fname = $user->fname;
                            $profile->lname = $user->lname;
                            $profile->phone = $user->phone;
                            $profile->usercity = $user->usercity;

                            $profile->save();
                            $model->status = 1;
                            $model->save();
                        }
                        $session->set('newaccount', $user->email);
                        return $this->redirect('welcome');
                    } else {
						//var_dump($user->errors);
                        return $this->render('create', [
                            'user' => $user,
                            'role' => $role,
                        ]);
                    }

                } elseif($model->status == 1) {
                    $user = Member::findOne(['email' => $model->email]);
                    return $this->render('account-complete', [
                        'user' => $user,
                    ]);
                } else {

                }
            } else {
                echo "Invalid access token";
            }
        } else {
            return $this->goHome();
        }

    }
	
	public function actionChairSignup()
    {
		$session = Yii::$app->session;
        $this->layout = 'main-login';
        // get setting value for 'Registration Needs Activation'
        $rna = Yii::$app->params['rna'];
        // if 'rna' value is 'true', we instantiate SignupForm in 'rna' scenario
        $model = $rna ? new ChairSignupForm(['scenario' => 'rna']) : new ChairSignupForm();

        // if validation didn't pass, reload the form to show errors
        if (!$model->load(Yii::$app->request->post()) || !$model->validate()) {
            return $this->render('chair-signup', ['model' => $model]);
        }
        // try to save user data in database, if successful, the user object will be returned
        $user = $model->chairsignup();
        if (!$user) {
            // display error message to user
            Yii::$app->session->setFlash('error', Yii::t('app', 'We couldn\'t sign you up, please contact us.'));
            return $this->refresh();
        } else {
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->fname = $model->fname;
            $profile->lname = $model->lname;
            $profile->phone = $model->phone;
            $profile->usercity = null;
            $profile->save();
			
			$spe_sess = new SpecialSession();

			$image = UploadedFile::getInstance($model, 'file');
			if($image != '')
			{
					
				$name = $image->name;
				$size = Yii::$app->params['folders']['size'];
				$main_folder = "downloads";
				$image_name= $this->uploadFile($image,$name,$main_folder,$size);
				$spe_sess->file = $image_name;
											
			}
			$spe_sess->name = $model->name;
			$spe_sess->theme = $model->theme;
			$spe_sess->user_id = $user->id;
			$spe_sess->status = 3;
			$spe_sess->chair = $model->fname.($model->lname?' '.$model->lname:'');
			$spe_sess->save();
			$body = '<p>We received a request to create '.Yii::$app->name.' chair account for you. We are reviewing your account and will contact you within 2-3 working days</p>';
                        $model->sendMail(Yii::$app->params['adminEmail'], Yii::$app->name.'Session Chair Account Created', $body);
                        /*Yii::$app->session->setFlash('success', 'We received your application. A mail with further instructions has been sent to the email address ' . $model->email . '. If you do not get message in inbox of your email account, please check <span style="color:red;">spam</span> of your email.');*/
						//return $this->render('welcome-chair', ['user' => $user]);
        }
        // user is saved but activation is needed, use signupWithActivation()
        
        // now we will try to log user in
        // if login fails we will display error message, else just redirect to home page
		 $session->set('session_id', $spe_sess->id);
        return $this->redirect('welcome-chair');
		
    }

    public function actionRegister($id)
    {
        $session = Yii::$app->session;
        $this->layout = 'main-login';
        if(!Yii::$app->user->isGuest)
        {
            if($id == 1){
                return $this->redirect(['fee/create-record', 'id' => $id]);
            }
            return $this->redirect(['fee/create', 'id' => $id]);
        }
        // get setting value for 'Registration Needs Activation'
        $rna = Yii::$app->params['rna'];
        // if 'rna' value is 'true', we instantiate SignupForm in 'rna' scenario
        $model = $rna ? new AuthorSignupForm(['scenario' => 'rna']) : new AuthorSignupForm();
        $model->country = 101;
        $lwe = Yii::$app->params['lwe'];

        // if 'lwe' value is 'true' we instantiate LoginForm in 'lwe' scenario
        $model1 = $lwe ? new LoginForm(['scenario' => 'lwe']) : new LoginForm();
        if(isset($_POST['AuthorSignupForm'])) {
            if($model->load(Yii::$app->request->post()) && $model->validate()) {
                $user = $model->signup();
                if (!$user) {
                    // display error message to user
                    Yii::$app->session->setFlash('error', Yii::t('app', 'We couldn\'t sign you up, please contact us.'));
                    return $this->refresh();
                } else {
                    $profile = new Profile();
                    $profile->user_id = $user->id;
                    $profile->fname = $model->fname;
                    $profile->lname = $model->lname;
                    $profile->phone = $model->phone;
                    $profile->usercity = $model->city;
                    $profile->save();

                    $body = '<p>Your '.Yii::$app->params['siteName'].' author account has been created successfully. You can login to your acount by visting below link:<br><br></p>';
                    $body .= Html::a(Html::encode(Url::to(['/account/login'], true)), Url::to(['/account/login'], true));
                    //$model->sendMail(Yii::$app->params['adminEmail'], Yii::$app->params['siteName'].' Account created successfully', $body);
                    /*Yii::$app->session->setFlash('success', 'We received your application. A mail with further instructions has been sent to the email address ' . $model->email . '. If you do not get message in inbox of your email account, please check <span style="color:red;">spam</span> of your email.');*/
                    //return $this->render('welcome-chair', ['user' => $user]);
                    if (!Yii::$app->user->login($user)) {
                        // display error message to user
                        Yii::$app->session->setFlash('warning', Yii::t('app', 'Please try to log in.'));
                        // log this error, so we can debug possible problem easier.
                        Yii::error('Login after sign up failed! User '.Html::encode($user->username).' could not log in.');
                        return $this->goHome();
                    }
                    if($id == 1){
                        return $this->redirect(['fee/create-record', 'id' => $id]);
                    }
                    return $this->redirect(['fee/create', 'id' => $id]);
                }
            } else {
                print_r($model->errors);
                Yii::$app->session->setFlash('error', Yii::t('app', 'Some error occurred while signing you up, please try again.'));
                return $this->render('register', ['model' => $model,'user'=>$model1]);
            }
        } elseif(isset($_POST['LoginForm'])) {
            if ($model1->load(Yii::$app->request->post()) && $model1->login())
            {
                if($id == 1){
                    return $this->redirect(['fee/create-record', 'id' => $id]);
                }
                return $this->redirect(['fee/create', 'id' => $id]);
            }
            // user couldn't be logged in, because he has not activated his account
            elseif($model1->notActivated())
            {
                // if his account is not activated, he will have to activate it first
                Yii::$app->session->setFlash('error', 'You have to activate your account first. Please check your email.');
                return $this->refresh();
            }
        }

            // if validation didn't pass, reload the form to show errors

        // try to save user data in database, if successful, the user object will be returned

        return $this->render('register', ['model' => $model,'user'=>$model1]);
        return $this->redirect('welcome-chair');

    }
	
	public function actionWelcome()
    {
        $session = Yii::$app->session;
        if(isset($_SESSION['newaccount'])){
            $email = $_SESSION['newaccount'];
            $user = Member::findOne(['email' => $email]);
            return $this->render('welcome', ['user' => $user]);
        } else {
            return $this->goHome();
        }
    }
	public function actionWelcomeChair()
    {
		$session = Yii::$app->session;
		if(isset($_SESSION['session_id'])){
			$id = $session->get('session_id');
            $session->remove('session_id');
			if (($model = SpecialSession::findOne($id)) !== null) {
				return $this->render('welcome-chair',['model'=> $model]); 
			} else {
				throw new NotFoundHttpException('The requested page does not exist.');
			}
		} else {
			return $this->goHome();
		}               
    }
    private function signupWithActivation($model, $user)
    {
        // try to send account activation email
        if ($model->sendAccountActivationEmail($user)) 
        {
            Yii::$app->session->setFlash('success', 
                'Hello '.Html::encode($user->username).'. 
                To be able to log in, you need to confirm your registration. 
                Please check your email, we have sent you a message.');
        }
        // email could not be sent
        else 
        {
            // display error message to user
            Yii::$app->session->setFlash('error', 
                "We couldn't send you account activation email, please contact us.");

            // log this error, so we can debug possible problem easier.
            Yii::error('Signup failed! 
                User '.Html::encode($user->username).' could not sign up.
                Possible causes: verification email could not be sent.');
        }
    }
    public function actionActivateAccount($token)
    {
        try 
        {
            $user = new AccountActivation($token);
        } 
        catch (InvalidParamException $e) 
        {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($user->activateAccount()) 
        {
            Yii::$app->session->setFlash('success', 
                'Success! You can now log in. 
                Thank you '.Html::encode($user->username).' for joining us!');
        }
        else
        {
            Yii::$app->session->setFlash('error', 
                ''.Html::encode($user->username).' your account could not be activated, 
                please contact us!');
        }

        return $this->redirect('login');
    }
	public function actionTellAFriend(){
		$this->layout="page";
		$model = new FriendForm();
		if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
			if ($model->contact($model)) 
            {
                return "success";
            } 
            else 
            {
                 return "fail";
            }
        }
		return $this->render('tell-a-friend', [
                'model' => $model,
        ]);
	}
	public function actionPage($slug){
		//$this->layout="page";
		
		$page = Pages::find()->where(['slug' =>$slug ])->one();
		if($page->id==5){
				$this->layout="main-leftbar";
			}
		$model1 = new ContactForm();
		
        if ($model1->load(Yii::$app->request->post())) 
        {
			
            if ($model1->contact(Yii::$app->params['adminEmail'])) 
            {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } 
            else 
            {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        }
		if($page){
			if($page->id==5){
				return $this->render('page1', [
                'model' => $page,
            ]);	
			}
			if($page->id==7){
				return $this->render('register-page', [
                'model' => $page,
            ]);	
			}
			return $this->render('page', [
                'model' => $page,
            ]);	
		}else{
			 throw new NotFoundHttpException('The requested page does not exist.');
		}
		
	}
	public function actionCommittees(){
		
		$model1 = new ContactForm();
		$member = new Members();
		$cats = Category::findAll(['status'=>1]);
        if ($model1->load(Yii::$app->request->post())) 
        {
			
            if ($model1->contact(Yii::$app->params['adminEmail'])) 
            {
                Yii::$app->session->setFlash('success', 
                    'Thank you for contacting us. We will respond to you as soon as possible.');
            } 
            else 
            {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        }
		return $this->render('committees', [
			'cats' => $cats,
			'members' => $member,
		]);	
		
		
	}
	public function actionPaymentSuccess(){	
		$this->layout="main-leftbar";
		if(Yii::$app->request->post()){
			echo "<pre>";
			print_r(Yii::$app->request->post());
			die;
			return $this->render('payment-success', [
			
		]);	
        } else {
			return $this->render('payment-success', [
			
		]);	
		}	
	}
	public function actionPaymentCancel(){		
		if(Yii::$app->request->post()){
			echo "<pre>";
			print_r(Yii::$app->request->post());
			die;
			return $this->render('payment-cancel', [
			
		]);	
        } else {
			echo "hello cancel";
		}	
	}
	public function actionPaymentFailure(){		
			Yii::$app->controller->enableCsrfValidation = false;
			echo "<pre>";
			print_r(Yii::$app->request->post());
			die;
			
	}
	public function actionSpeakers(){ 
	
		$model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) 
        {
			
            if ($model->contact(Yii::$app->params['adminEmail'])) 
            {
                Yii::$app->session->setFlash('success', 
                    'Thank you for contacting us. We will respond to you as soon as possible.');
            } 
            else 
            {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } 
		$speaker = Speakers::findAll(['status'=>1]);
		return $this->render('speakers', [
			'model' => $speaker,
		]);	
		
	}
	public function actionDownloads(){
		
		$model1 = new ContactForm();
		$downloads = Downloads::findAll(['status'=>1]);
        if ($model1->load(Yii::$app->request->post())) 
        {
			
            if ($model1->contact(Yii::$app->params['adminEmail'])) 
            {
                Yii::$app->session->setFlash('success', 
                    'Thank you for contacting us. We will respond to you as soon as possible.');
            } 
            else 
            {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        }
		return $this->render('downloads', [
			'downloads' => $downloads,
		]);	
		
		
	}
	public function actionSpecialSession(){
		$this->layout="main-leftbar";
		$model1 = new ContactForm();
		$special_session = SpecialSession::findAll(['status'=>1]);
        if ($model1->load(Yii::$app->request->post())) 
        {
			
            if ($model1->contact(Yii::$app->params['adminEmail'])) 
            {
                Yii::$app->session->setFlash('success', 
                    'Thank you for contacting us. We will respond to you as soon as possible.');
            } 
            else 
            {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        }
		return $this->render('special-session', [
			'downloads' => $special_session,
		]);	
		
		
	}
    public function actionAccount()
    {
        return $this->render('account', []);
    }
    public function actionMyAccount()
    {
        $searchModel = new SessionPapersSearch();
		$id  = Yii::$app->user->identity->id; 
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('my-account', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	public function actionView($id)
    {
		$searchModel = new AuthorsSearch();
		$sid = Yii::$app->user->identity->id;
		$session = SpecialSession::find()->where(['user_id'=>$sid])->all();
		$ids = ArrayHelper::getColumn($session, 'id');
		if (($model = Papers::findOne(['id'=>$id,'session_id'=>$ids])) === null) {        
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);
        return $this->render('view', [
            'model' => $model,
			'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionRejectPaper($paper_id)
    {
		
		
		if (($model = Paper::findOne($paper_id)) === null) {        
            throw new NotFoundHttpException('The requested page does not exist.');
        }
		$commentModel = new PaperComment();
		$commentModel->paper_id = $model->id;
		$commentModel->type = 1;		
		
		if ($commentModel->load(Yii::$app->request->post()) && $commentModel->save()) {
			$model->status = 3;
			$model->update();
			$body = '<h3>Hello '.Yii::$app->user->identity->profile->fname.' '.Yii::$app->user->identity->profile->lname.':</h3><p>Your paper with title "'.$model->title.'" has been Rejected.</p>';
			if($commentModel !=""){
				$body .= '<h3>Message by Session Chair:</h3><p>'.$commentModel->comment.'</p>';
			}
				
			
			$send =  Yii::$app->mailer->compose(['html' => '@common/mail/views/paperaccepted'], ['message'=>$body])
            ->setTo(Yii::$app->user->identity->email)
            ->setFrom("admin@iresconf.org")
            ->setSubject("IRES 2017 paper accepted")
            ->send();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('reject-paper', [
				'model' => $commentModel,
			]);
        }       
    }
	public function actionAcceptPaper($paper_id)
    {
		
		if (($model = Paper::findOne($paper_id)) === null) {        
            throw new NotFoundHttpException('The requested page does not exist.');
        }
		$commentModel = new PaperComment();
		$commentModel->paper_id = $model->id;
		$commentModel->type = 1;		
		
		if ($commentModel->load(Yii::$app->request->post()) && $commentModel->save()) {
			$model->status = 2;
			$model->update();
			$body = '<h3>Congratulations '.Yii::$app->user->identity->profile->fname.' '.Yii::$app->user->identity->profile->lname.':</h3><p>Your paper with title "'.$model->title.'" has been accepted.</p>';
			if($commentModel !=""){
				$body .= '<h3>Acceptance Message by Session Chair:</h3><p>'.$commentModel->comment.'</p>';
			}
				
			
			$send =  Yii::$app->mailer->compose(['html' => '@common/mail/views/paperaccepted'], ['message'=>$body])
            ->setTo(Yii::$app->user->identity->email)
            ->setFrom("admin@iresconf.org")
            ->setSubject("IRES 2017 paper accepted")
            ->send();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('accept-paper', [
				'model' => $commentModel,
			]);
        }       
    }
    public function actionSessionPapers()
    {
        return $this->render('my-account', []);
    }
	
    public function actionGallery()
    {
        return $this->render('gallery');
    }	
		
}
 