<?php
namespace frontend\controllers;
use yii\helpers\Url;
use common\models\User;
use common\models\LoginForm;
use common\models\Newsletter;
use common\models\OrderComments;
use common\models\Product;
use common\models\Profile;
use common\models\ShippingAddress;
use common\models\BillingAddress;
use common\models\Review;
use common\models\Orders;
use common\models\Wishlist;
use common\models\Cart;
use yii\helpers\Html;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use yii\web\Response;
use common\traits\MessageSendTrait;

/**
 * Site controller.
 * It is responsible for displaying static pages, logging users in and out,
 * sign up and account activation, password reset.
 */
class AccountController extends FrontendController
{
	use MessageSendTrait;
    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */
	public $enableCsrfValidation = false;
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
                        'actions' => ['logout'],
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

//------------------------------------------------------------------------------------------------//
// STATIC PAGES
//------------------------------------------------------------------------------------------------//

	public function actionNewsletter()
	{	
		$model = new Newsletter();
		
		if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
		{
			$subscribe = Newsletter::find()->where(['email' => $model->email])->one();
			if(!$subscribe){
				$subscribe = new Newsletter();
				$subscribe->email = $model->email;
				if($subscribe->save()){				
					$result['message'] = 'You have subscribed Successfully!!';
					$msg1 = array();
					$msg = "Thank you for subscribing to our newsletter.<br>We look forward to keeping you up to date with all the latest news from Drish, including our new seasonal collections and offers.<br><br>We look forward to you visiting our website again soon.<br><br>";
					$this->sendEmail('Subscriber','Newletter Subscribes',$msg,$subscribe->email , 'sales@drish.com' ,'newsletter');
					$msg1['message'] = "There is a new subscriber to newsletter.";
					$this->sendEmail('Admin','New Newletter Subscriber',$msg1,'sales@drish.com', $subscribe->email ,'default');
				}else{
					$error = \yii\widgets\ActiveForm::validate($model);
					$result['type'] = 'error';
					$result['message'] = $error;				
					
					Yii::$app->response->format = Response::FORMAT_JSON;
					echo json_encode($result);
					Yii::$app->end();
					
				}
			}else{
				$result['message'] = 'You already subscribed once!!';
			}
				
			$result['type'] = 'success';
			
			Yii::$app->response->format = Response::FORMAT_JSON;
			echo json_encode($result);
			Yii::$app->end();
			
		}
			
		return false; 
				
 
	}
	public function actionReview()
    {

        // if 'rna' value is 'true', we instantiate SignupForm in 'rna' scenario
        $model =  new Review();

        // collect and validate user data
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
			$data = $model->find()->where(['user_id' => $model->user_id, 'product_id' => $model->product_id ])->one();
			if($data){
				if($data->save()){
					$result = 'success';
					Yii::$app->response->format = trim(Response::FORMAT_JSON);
					return $result;
				}
				// user could not be saved in database
				else
				{
					Yii::$app->response->format = Response::FORMAT_JSON;
					echo json_encode(\yii\widgets\ActiveForm::validate($model));
					Yii::$app->end();
				}
			}else{
				if($model->save()){
					$result = 'success';
					Yii::$app->response->format = trim(Response::FORMAT_JSON);
					return $result;
				}
				// user could not be saved in database
				else
				{
					Yii::$app->response->format = Response::FORMAT_JSON;
					echo json_encode(\yii\widgets\ActiveForm::validate($model));
					Yii::$app->end();
				}
			}
			
        }

        return $this->render('/site/signup', [
            'model' => $model,
        ]);
    }
	public function actionIndex()
    { 
		$this->layout = 'account'; 
		if(Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->homeUrl);	
		}
		
		$userId = \Yii::$app->user->identity->id;
		$profile = Profile::find()->where(['user_id' => $userId])->one();
		$user = User::find()->where(['id' => $userId])->one();
		return $this->render('index',['profile' => $profile, 'user' => $user ]);
    }
	
    public function actionDashboard()
    { 
		return $this->render('dashboard');
    }

    public function actionInformation()
    { 
	
		if(Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->homeUrl);	
		}
		
		$userId = \Yii::$app->user->identity->id;
		$profile = Profile::find()->where(['user_id' => $userId])->one();
		if ($profile->load(Yii::$app->request->post()))
		{	

			if($profile->save()){
				Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Account Information updated successfully!'));
				return $this->redirect(['account/information']);
			}else{
				Yii::$app->response->format = Response::FORMAT_JSON;
				return \yii\widgets\ActiveForm::validate($profile);
			}
				
		}	
		return $this->render('information',['profile' => $profile]);
    }

    public function actionBillingAddress()
    { 
	
		if(Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->homeUrl);	
		}
		$userId = \Yii::$app->user->identity->id;
		$biladd = BillingAddress::find()->where(['user_id' => $userId])->one();
		$user = User::find()->where(['id' => $userId])->one();
		$profile = Profile::find()->where(['user_id' => $userId])->one();
		if(!$biladd){
			$biladd = new BillingAddress();
			$biladd->email = $user->email; 
			$biladd->fname = $profile->fname; 
			$biladd->lname = $profile->lname; 
			$biladd->phone = $profile->phone; 
			$biladd->is_shipping = 0; 
			$biladd->user_id = $userId; 
			$biladd->country_id = 101; 
			
		}
		
		$this->layout = 'account';
		if ($biladd->load(Yii::$app->request->post()))
		{	

			if($biladd->save()){
				Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Account Information updated successfully!'));
				return $this->render('address',['model' => $biladd ]);
			}else{
				Yii::$app->response->format = Response::FORMAT_JSON;
				return \yii\widgets\ActiveForm::validate($biladd);
			}
				
		}else{
			return $this->render('address',['model' => $biladd ]);			
		}

    }
	public function actionShippingAddress()
    { 
		if(Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->homeUrl);	
		}
		$userId = \Yii::$app->user->identity->id;
		$shipadd = ShippingAddress::find()->where(['user_id' => $userId])->one();
		$profile = Profile::find()->where(['user_id' => $userId])->one();
		$user = User::find()->where(['id' => $userId])->one();
		if(!$shipadd){
			$shipadd = new ShippingAddress();
			$shipadd->email = $user->email; 
			$shipadd->fname = $profile->fname; 
			$shipadd->lname = $profile->lname; 
			$shipadd->phone = $profile->phone; 
			$shipadd->user_id = $userId; 
			$shipadd->country_id = 101; 
			
		}

		$this->layout = 'account'; 
		if ($shipadd->load(Yii::$app->request->post()))
		{	

			if($shipadd->save()){
				Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Account Information updated successfully!'));
				return $this->render('address',['model' => $shipadd ]);
			}else{
				Yii::$app->response->format = Response::FORMAT_JSON;
				return \yii\widgets\ActiveForm::validate($shipadd);
			}
				
		}else{
			return $this->render('address',['model' => $shipadd ]);			
		}
    }

    public function actionNotifications()
    { 
		$this->layout = 'account'; 
		return $this->render('notifications');
    }
	public function actionProductReview()
    { 
		$this->layout = 'account'; 
		return $this->render('product-review');
    }

	public function actionAccountNewsletter()
    { 
		$this->layout = 'account'; 
		return $this->render('newsletter');
    }	
	public function actionMywishlist()
    {  
		$this->layout = 'account'; 
		if(Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->homeUrl);	
		}
		$model = Wishlist::find()->where(['client_id' => \Yii::$app->user->identity->id])->one();
		return $this->render('mywishlist',[
			'wishlist' => $model,
		]);
    }
	public function beforeAction($action)
	{
		
		$this->layout = 'account'; 
		if(Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->homeUrl);	
		}
		return parent::beforeAction($action);
	}	
	
	public function actionOrders()
    { 
		$this->layout = 'account'; 
		$app_model = new Orders;
		if(Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->homeUrl);	
		}		
		$model = $app_model->find()->where(['user_id' => \Yii::$app->user->identity->id])->all();
		$comment = new OrderComments();
		return $this->render('orders',[
			"model" => $model,
			"comment" => $comment,
		]);
    }
	public function actionOrder($id)
    {
        $models = new Orders();
		if(Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->homeUrl);	
		}
        $comments = OrderComments::find()->where(['order_id' => $id])->orderBy([
	           'created_at' => SORT_DESC,
	        ])->all();

        $orderdetail = $models->getOrderDetail($id);

        return $this->render('order', [
            'orderdetail' => $orderdetail,
            'comments' => $comments,
        ]);
    }
	public function actionReturnRequest()
    { 
		$this->layout = 'account'; 
		if(Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->homeUrl);	
		}
		if(Yii::$app->request->post()){
			$id = Yii::$app->request->post('id');
			$app_model = Orders::findOne($id);
			$app_model->refund_message = Yii::$app->request->post('msg');
			$app_model->refund_type = Yii::$app->request->post('refund_type');
			$app_model->is_refunded = 3;
			$app_model->refund_request = 1;
			if($app_model->save()){
				$orderdetail = $app_model->getOrderDetail($id);
				$orderdetail['comment'] = "Your Request has successfully Recieved! We will contact You Soon.";
				if($app_model->refund_type == 1){
					$orderdetail['refund_types'] = 'Exchange'; 
				}else{
					$orderdetail['refund_types'] = 'Return';
				}
				$this->sendEmail($orderdetail['fname'] .' '.$orderdetail['lname'],'Refund Status',$orderdetail,$orderdetail['email'],'sales@drish.com','ordercomment');
				
				$orderdetail['comment'] = $app_model->refund_message;
				
				$this->sendEmail('Admin','Refund Request',$orderdetail,Yii::$app->params['adminEmail'],'sales@drish.com','orderadmincomment');
				
				$model = Orders::find()->where(['user_id' => \Yii::$app->user->identity->id])->all();
				Yii::$app->getSession()->setFlash('success', Yii::t('app', "Your Request has Been Submitted successfully."));
				return $this->redirect('orders');
			}
		}
		
    }
	public function actionPaymentRequest($id)
    { 
		$orders = Orders::find()->where(['id' => $id])->one();
		$this->layout = 'checkout'; 
		$working_key = 'C2C9FE70D92FF18720EBBFFDA9D32B5E';//Shared by CCAVENUES
		$access_code = 'AVGD05CG83CH31DGHC';//Shared by CCAVENUES
		$merchant_data = '72818';
		$ccavenue_data = array();
		$orderdata = $orders->getOrderDetail($orders->id);
		$ccavenue_data['tid'] = time();
		$ccavenue_data['merchant_id'] =  $merchant_data;			
		$ccavenue_data['order_id'] = $orders->id;			
		$ccavenue_data['amount'] =  $orders->grand_total;
		$ccavenue_data['currency'] = 'INR';
		$ccavenue_data['redirect_url'] = Url::to(['account/response'],true);
		$ccavenue_data['cancel_url'] = Url::to(['account/response'],true);
		$ccavenue_data['language'] = 'EN'; 
		$ccavenue_data['billing_name'] = $orderdata['billing']['fname'] . ' ' . $orderdata['billing']['lname'];
		$ccavenue_data['billing_address'] = $orderdata['billing']['address'];
		$ccavenue_data['billing_city'] = $orderdata['billing']['city'];
		$ccavenue_data['billing_state'] = $orderdata['billing']['state'];
		$ccavenue_data['billing_zip'] = $orderdata['billing']['zip'];
		$ccavenue_data['billing_country'] = $orderdata['billing']['country'];
		$ccavenue_data['billing_tel'] = $orderdata['billing']['phone'];
		$ccavenue_data['billing_email'] =  $orderdata['billing']['email']; 		

		if ($orderdata['billing']['is_shipping'] != 0) {
			$ccavenue_data['delivery_name'] = $orderdata['shipping']['fname'] . ' ' . $orderdata['billing']['lname'];
			$ccavenue_data['delivery_address'] = $orderdata['shipping']['address'];
			$ccavenue_data['delivery_city'] = $orderdata['shipping']['city'];
			$ccavenue_data['delivery_state'] = $orderdata['shipping']['state'];
			$ccavenue_data['delivery_zip'] = $orderdata['shipping']['zip'];
			$ccavenue_data['delivery_country'] = $orderdata['shipping']['country'];
			$ccavenue_data['delivery_tel'] = $orderdata['shipping']['phone'];
		} else {
			
			$ccavenue_data['delivery_name'] = $orderdata['billing']['fname'] . ' ' . $orderdata['billing']['lname'];
			$ccavenue_data['delivery_address'] = $orderdata['billing']['address'];
			$ccavenue_data['delivery_city'] = $orderdata['billing']['city'];
			$ccavenue_data['delivery_state'] = $orderdata['billing']['state'];
			$ccavenue_data['delivery_zip'] = $orderdata['billing']['zip'];
			$ccavenue_data['delivery_country'] = $orderdata['billing']['country'];
			$ccavenue_data['delivery_tel'] = $orderdata['billing']['phone'];

		}
		$ccavenue_data['merchant_param1'] = $orderdata['usertype'];
		$ccavenue_data['merchant_param2'] = $orderdata['id'];
		return $this->render('//cart/payment',['order'=>$ccavenue_data,'model'=>$orders]);
		
    }
	
	public function actionResponse(){
		
		if($_POST){
			$order = new Orders();
			$workingKey='CF34CAAC98A43CC89DD8C66543F929C3';		//Working Key should be provided here.
			$encResponse= $_POST["encResp"];			//This is the response sent by the CCAvenue Server
			$rcvdString= $order->decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
			$order_status="";
			$decryptValues=explode('&', $rcvdString);
			$dataSize=sizeof($decryptValues);
		
			for($i = 0; $i < $dataSize; $i++)
			{
				$information=explode('=',$decryptValues[$i]);
				if($i==0)	$order_id=$information[1];
				if($i==1)	$tracking_id=$information[1];
				if($i==3)	$order_status=$information[1];
			}
			$orders = Orders::find()->where(['id' => $order_id])->one();
			if($order_status==="Success")
			{
				$orders->transaction_id = $tracking_id;
				$orders->payment_status = 1;
				$orders->status = 4;
				$orders->save();
				
				//send mail to customer
				$orderdata = $orders->getOrderDetail($order_id);

				$this->sendEmail($orderdata['fname'] .' '.$orderdata['lname'],'PAYMENT RECEIVED',$orderdata,$orderdata['email'],'sales@drish.com','payment');	
				
				$admin_mail = Yii::$app->params['adminEmail'];
				$msg = 'Payment for order no #'.$order_id.' has been received.Ccavenue transaction Id of this order is '.$tracking_id;
				$body = array('message'=>$msg);
				//send mail to admin
				$this->sendEmail('','PAYMENT RECEIVED',$body,$admin_mail,'sales@drish.com','default');	
					

			}
			else if($order_status==="Aborted")
			{
				$orders->transaction_id = $tracking_id;
				$orders->save();


			}
			else if($order_status==="Failure")
			{
				$orders->transaction_id = $tracking_id;
				$orders->save();
				
			}
			else
			{
				$order_status ="Failure";

			}
			return Yii::$app->response->redirect(['cart/thank-you','orderid'=>$order_id,'status'=>$order_status]);
			
		}
	}	
}
