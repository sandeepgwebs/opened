<?php

namespace frontend\controllers;

use Yii;
use common\models\Fee;
use common\models\Papers;
use common\models\Feedata;
use common\models\FeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\traits\FileUploadTrait;
use kartik\file\FileInput;
use yii\web\UploadedFile;
use yii\web\Response;
use \PayPal\Api\PaymentExecution;
use \PayPal\Api\Amount;
use \PayPal\Api\CreditCard;
use \PayPal\Api\CreditCardToken;
use \PayPal\Api\FundingInstrument;
use \PayPal\Api\Payer;
use \PayPal\Api\Payment;
use \PayPal\Api\Transaction;
use \PayPal\Api\RedirectUrls;

/**
 * FeeController implements the CRUD actions for Fee model.
 */
class FeeController extends FrontendController
{
    use FileUploadTrait;
    public  $enableCsrfValidation = false;

    /**
     * Lists all Fee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSubmissionDownload($id)
    {
		 if (($paperModel = Papers::findOne($id)) !== null) {
				$file = Yii::$app->params['uploadurl'].'/uploads/papers/'.$paperModel->pfile;
						
			if (file_exists($file)){					
			   return Yii::$app->response->sendFile($file);
			} 
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}		     
        
    }
	
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Fee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $session = Yii::$app->session;
        $model = new Fee();
		
        $model->payment_method = ($id==232)?2:$id;
		
        $model->user_id = Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post())) {
            //$session->set('userdata', Yii::$app->request->post());


            $image = UploadedFile::getInstance($model, 'file');
            if($image != '')
            {
                $name = time()."_".$image->name;
                $size = Yii::$app->params['folders']['size'];
                $main_folder = "papers";
                $image_name= $this->uploadFile($image,$name,$main_folder,$size);
                $model->file = $image_name;

            }
            $image2 = UploadedFile::getInstance($model, 'copyright_form');
            if($image2 != '')
            {
                $name = time()."_cr_".$image2->name;
                $size = Yii::$app->params['folders']['size'];
                $main_folder = "cform";
                $image_name= $this->uploadFile($image2,$name,$main_folder,$size);
                $model->copyright_form = $image_name;
            }

            $model->payment = $model->finalAmount;


            if($model->save()){
                $session->set('fee_id', $model->id);
                $session->set('fee', $model->finalAmount);
                return $this->redirect(['confirm-fee']);
            }
            echo "<pre>";
            print_r($model->errors);
            return $this->refresh();
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateRecord($id)
    {
        $session = Yii::$app->session;
        $model = new Fee();
        $model->payment_method = $id;
        $model->user_id = Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post())) {
            //$session->set('userdata', Yii::$app->request->post());


            $image = UploadedFile::getInstance($model, 'file');
            if($image != '')
            {
                $name = time()."_".$image->name;
                $size = Yii::$app->params['folders']['size'];
                $main_folder = "papers";
                $image_name= $this->uploadFile($image,$name,$main_folder,$size);
                $model->file = $image_name;

            }
            $image2 = UploadedFile::getInstance($model, 'copyright_form');
            if($image2 != '')
            {
                $name = time()."_cr_".$image2->name;
                $size = Yii::$app->params['folders']['size'];
                $main_folder = "cform";
                $image_name= $this->uploadFile($image2,$name,$main_folder,$size);
                $model->copyright_form = $image_name;
            }
            $image3 = UploadedFile::getInstance($model, 'slip');
            if($image3 != '')
            {
                $name = time()."_cr_".$image3->name;
                $size = Yii::$app->params['folders']['size'];
                $main_folder = "slips";
                $image_name= $this->uploadFile($image3,$name,$main_folder,$size);
                $model->payment_id = $image_name;
                $model->slip = $image_name;
                $model->status = 1;
            }
            $model->payment = $model->currencyOpted->symbol." ".$model->payment1;

            if($model->save()){
                return $this->redirect(['fee/confirm-slip','id'=>$model->id]);
            }
            return $this->refresh();
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create-record', [
                'model' => $model,
            ]);
        }
    }

    public function actionConfirmSlip($id)
    {
        $model = $this->findModel($id);
        return $this->render('confirm-slip', ['model' => $model]);

    }

    public function actionCalculate()
    {

        $user_type = $_POST['Fee']['user_type'];
        $no_of_papers = $_POST['Fee']['no_of_papers'];
        $journal_id = $_POST['Fee']['journal_id'];
        $xtrapay1 = 0;
        $xtrapay2 = 0;
        $xtrapay3 = 0;
        if($user_type==1){
            if($journal_id == 1){
                $payment1 = 19500;
                $payment2 = 500;
                $payment3 = 10000;
                if($no_of_papers-8>0) {
                    $xtrapay1 = ($no_of_papers - 8) * 700;
                    $xtrapay2 = ($no_of_papers - 8) * 15;
                    $xtrapay3 = ($no_of_papers - 8) * 350;
                }
            } else {
                $payment1 = 14000;
                $payment2 = 300;
                $payment3 = 7000;
                if($no_of_papers-8>0) {
                    $xtrapay1 = ($no_of_papers - 8) * 200;
                    $xtrapay2 = ($no_of_papers - 8) * 10;
                    $xtrapay3 = ($no_of_papers - 8) * 100;
                }
            }

        } elseif($user_type==2){
            if($journal_id == 1){
                $payment1 = 21500;
                $payment2 = 550;
                $payment3 = 11000;
                if($no_of_papers-8>0) {
                    $xtrapay1 = ($no_of_papers - 8) * 700;
                    $xtrapay2 = ($no_of_papers - 8) * 15;
                    $xtrapay3 = ($no_of_papers - 8) * 350;
                }
            } else {
                $payment1 = 16000;
                $payment2 = 350;
                $payment3 = 8000;
                if($no_of_papers-8>0) {
                    $xtrapay1 = ($no_of_papers - 8) * 200;
                    $xtrapay2 = ($no_of_papers - 8) * 10;
                    $xtrapay3 = ($no_of_papers - 8) * 100;
                }
            }
        } elseif($user_type == 3) {
            if ($journal_id == 1) {
                $payment1 = 6500;
                $payment2 = 120;
                $payment3 = 4000;
            } else {
                $payment1 = 6500;
                $payment2 = 120;
                $payment3 = 4000;
            }
        } else {
            if ($journal_id == 1) {
                $payment1 = 7500;
                $payment2 = 150;
                $payment3 = 4500;
            } else {
                $payment1 = 7500;
                $payment2 = 150;
                $payment3 = 4500;
            }
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'type' => 'success',
            'rfee' => $payment1 + $xtrapay1,
            'dfee'=> $payment2 + $xtrapay2,
            'bfee'=> $payment3 + $xtrapay3,

        ];

    }
    public function actionConfirmFee()
    {
        $session = Yii::$app->session;
        if(isset($_SESSION['fee_id']) && !Yii::$app->user->isGuest){
            $id = $session->get('fee_id');
            $fee = $session->get('fee');
            $model = $this->findModel($id);
            $xtrapay1 = 0;
            $xtrapay2 = 0;
            $xtrapay3 = 0;
            if($model->user_type==1){
                if($model->journal_id == 1){
                    $payment1 = 19500;
                    $payment2 = 500;
                    $payment3 = 10000;
                    if($model->no_of_papers-8>0) {
                        $xtrapay1 = ($model->no_of_papers - 8) * 700;
                        $xtrapay2 = ($model->no_of_papers - 8) * 15;
                        $xtrapay3 = ($model->no_of_papers - 8) * 350;
                    }
                } else {
                    $payment1 = 14000;
                    $payment2 = 300;
                    $payment3 = 7000;
                    if($model->no_of_papers-8>0) {
                        $xtrapay1 = ($model->no_of_papers - 8) * 200;
                        $xtrapay2 = ($model->no_of_papers - 8) * 10;
                        $xtrapay3 = ($model->no_of_papers - 8) * 100;
                    }
                }

            } elseif($model->user_type==2){
                if($model->journal_id == 1){
                    $payment1 = 21500;
                    $payment2 = 550;
                    $payment3 = 11000;
                    if($model->no_of_papers-8>0) {
                        $xtrapay1 = ($model->no_of_papers - 8) * 700;
                        $xtrapay2 = ($model->no_of_papers - 8) * 15;
                        $xtrapay3 = ($model->no_of_papers - 8) * 350;
                    }
                } else {
                    $payment1 = 16000;
                    $payment2 = 350;
                    $payment3 = 8000;
                    if($model->no_of_papers-8>0) {
                        $xtrapay1 = ($model->no_of_papers - 8) * 200;
                        $xtrapay2 = ($model->no_of_papers - 8) * 10;
                        $xtrapay3 = ($model->no_of_papers - 8) * 100;
                    }
                }
            } elseif($model->user_type==3) {
                if ($model->journal_id == 1) {
                    $payment1 = 6500;
                    $payment2 = 120;
                    $payment3 = 4000;
                } else {
                    $payment1 = 6500;
                    $payment2 = 120;
                    $payment3 = 4000;
                }
            } else {
                if ($model->journal_id == 1) {
                    $payment1 = 7500;
                    $payment2 = 150;
                    $payment3 = 4500;
                } else {
                    $payment1 = 7500;
                    $payment2 = 150;
                    $payment3 = 4500;
                }
            }
            return $this->render('calculate-payment', [
                'model' => $model,
                'payment1' => $payment1,
                'xtrapay1' => $xtrapay1,
                'payment2' => $payment2,
                'xtrapay2' => $xtrapay2,
                'payment3' => $payment3,
                'xtrapay3' => $xtrapay3,
            ]);

        } else {
            $session->remove('fee_id');
            return $this->redirect(['site/page','slug'=>'registeration']);
        }
    }
	
    public function actionSelectMethod($id){
        $session = Yii::$app->session;
		$session->set('feemodel',$id);
		return $this->render('select-method', [
			'id' => $id,                
		]);		
    }
    public function actionUpdateFee($id)
    {
        $session = Yii::$app->session;
        if(!Yii::$app->user->isGuest){
            $model = $this->findModel($id);
            $xtrapay1 = 0;
            $xtrapay2 = 0;
            $xtrapay3 = 0;
            if($model->user_type==1){
                if($model->journal_id == 1){
                    $payment1 = 19500;
                    $payment2 = 500;
                    $payment3 = 10000;
                    if($model->no_of_papers-8>0) {
                        $xtrapay1 = ($model->no_of_papers - 8) * 700;
                        $xtrapay2 = ($model->no_of_papers - 8) * 15;
                        $xtrapay3 = ($model->no_of_papers - 8) * 350;
                    }
                } else {
                    $payment1 = 14000;
                    $payment2 = 300;
                    $payment3 = 7000;
                    if($model->no_of_papers-8>0) {
                        $xtrapay1 = ($model->no_of_papers - 8) * 200;
                        $xtrapay2 = ($model->no_of_papers - 8) * 10;
                        $xtrapay3 = ($model->no_of_papers - 8) * 100;
                    }
                }

            } elseif($model->user_type==2){
                if($model->journal_id == 1){
                    $payment1 = 21500;
                    $payment2 = 550;
                    $payment3 = 11000;
                    if($model->no_of_papers-8>0) {
                        $xtrapay1 = ($model->no_of_papers - 8) * 700;
                        $xtrapay2 = ($model->no_of_papers - 8) * 15;
                        $xtrapay3 = ($model->no_of_papers - 8) * 350;
                    }
                } else {
                    $payment1 = 16000;
                    $payment2 = 350;
                    $payment3 = 8000;
                    if($model->no_of_papers-8>0) {
                        $xtrapay1 = ($model->no_of_papers - 8) * 200;
                        $xtrapay2 = ($model->no_of_papers - 8) * 10;
                        $xtrapay3 = ($model->no_of_papers - 8) * 100;
                    }
                }
            } elseif($model->user_type==3) {
                if ($model->journal_id == 1) {
                    $payment1 = 6500;
                    $payment2 = 120;
                    $payment3 = 4000;
                } else {
                    $payment1 = 6500;
                    $payment2 = 120;
                    $payment3 = 4000;
                }
            } else {
                if ($model->journal_id == 1) {
                    $payment1 = 7500;
                    $payment2 = 150;
                    $payment3 = 4500;
                } else {
                    $payment1 = 7500;
                    $payment2 = 150;
                    $payment3 = 4500;
                }
            }
            return $this->render('calculate-payment', [
                'model' => $model,
                'payment1' => $payment1,
                'xtrapay1' => $xtrapay1,
                'payment2' => $payment2,
                'xtrapay2' => $xtrapay2,
                'payment3' => $payment3,
                'xtrapay3' => $xtrapay3,
            ]);

        } else {
            $session->remove('fee_id');
            return $this->redirect(['site/page','slug'=>'registeration']);
        }
    }
    public function actionCalculateFee()
    {
        $session = Yii::$app->session;
        $model = new Fee();
        if (Yii::$app->request->isPost) {
            //$session->set('userdata', Yii::$app->request->post());


            return $this->redirect(['confirm-fee']);

            return $this->refresh();
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('calculate-fee', [
                'model' => $model,
            ]);
        }
    }
    public function actionPayFee(){
        $session = Yii::$app->session;

        if(isset($_SESSION['fee_id']) && !Yii::$app->user->isGuest){
            $id = $session->get('fee_id');
            $fee = $session->get('fee');
            $model = $this->findModel($id);
            return $this->render('pay-fee', [
                'model' => $model,
                'fee' => $fee,
            ]);
        }
    }
    public function actionPaypalPayment(){
        $session = Yii::$app->session;
		/*Yii::$app->session->setFlash('error', Yii::t('app', 'Some error occurred in paypal, please choose other payment method.'));
        return $this->redirect('index');
		die;*/
		
        if(isset($_SESSION['fee_id']) && !Yii::$app->user->isGuest){
            $id = $session->get('fee_id');
            $fee = $session->get('fee');
            $model = $this->findModel($id);



            $payment =   $this->makePaymentUsingPayPal($model->payment, 'USD', 'test', \Yii::$app->urlManager->createAbsoluteUrl('fee/paypal-success?success=true'), \Yii::$app->urlManager->createAbsoluteUrl('fee/paypal-success?success=false') );

            header("Location: " . $this->getLink($payment->getLinks(), "approval_url") );
            exit;

        }
    }
	public function actionMakePayment($id)
	{
		$session = Yii::$app->session;
		if($id == 2){
			
			$id = $session->get('feemodel');
            $model = $this->findModel($id);
			return $this->redirect(['select-method','id'=>$id]);
			$newmodel = new Feedata();
			$newmodel->fee_id = $model->id;
			$newmodel->user_type = $model->user_type;
			$newmodel->journal_id = $model->journal_id;
			$newmodel->status = $model->status;
			$newmodel->no_of_papers = $model->no_of_papers;
			$newmodel->created_at = $model->created_at;
			$newmodel->updated_at = $model->updated_at;
			$newmodel->payment_method = $model->payment_method;
			$newmodel->payment = $model->payment;
			$newmodel->payment_id = $model->payment_id;
			
			$model->payment_method = 2;
			$model->payment = $model->finalAmount;
			if($newmodel->save() && $model->save()){
				$session->set('fee_id', $model->id);
                $session->set('fee', $model->payment);
            $payment =   $this->makePaymentUsingPayPal($model->payment, 'USD', 'IRES', \Yii::$app->urlManager->createAbsoluteUrl('fee/paypal-success?success=true'), \Yii::$app->urlManager->createAbsoluteUrl('fee/paypal-success?success=false') );

            header("Location: " . $this->getLink($payment->getLinks(), "approval_url") );
            exit;
			}
		} elseif($id == 3) {
			$id = $session->get('feemodel');
            $model = $this->findModel($id);
			
			$newmodel = new Feedata();
			$newmodel->fee_id = $model->id;
			$newmodel->user_type = $model->user_type;
			$newmodel->journal_id = $model->journal_id;
			$newmodel->status = $model->status;
			$newmodel->no_of_papers = $model->no_of_papers;
			$newmodel->created_at = $model->created_at;
			$newmodel->updated_at = $model->updated_at;
			$newmodel->payment_method = $model->payment_method;
			$newmodel->payment = $model->payment;
			$newmodel->payment_id = $model->payment_id;
			$newmodel->save();
			$model->payment_method = 3;
			$model->payment = $model->finalAmount;
			if($newmodel->save() && $model->save()){
				$session->set('fee_id', $model->id);
                $session->set('fee', $model->payment);
				return $this->render('pay-fee', [
                'model' => $model,
                'fee' => $model->payment,
            ]);
			}
		} else {
			$session->remove('feemodel');
			return $this->redirect(['index']);
		}
	}

    public function actionPaypalSuccess()
    {
		print_r(Yii::$app->request->get());
		print_r($_GET);
		die;
        $session = Yii::$app->session;
        $payid = Yii::$app->request->get('PayerID');
        $token = Yii::$app->request->get('token');
        $id = $session->get('fee_id');
        $fee = $session->get('fee');

        if(Yii::$app->request->get('success') == 'true' && isset($payid)) {

            $model = $this->findModel($id);
            $model->status = 1;
            $model->payment_id = $payid;
            if($model->save()) {
                $body = '<p>Your payment of $' . $fee . ' for ' . Yii::$app->name . ' paper submission is successful. Your paypal transaction id for any further reference is ' . $model->payment_id . '. <br><br>Please send all required documents i.e. papers in IRES format,copyright form, registration form, fee transaction proof and student id(if applicable) on icires2017@gmail.com</p>';
                $model->sendMail(Yii::$app->params['adminEmail'], 'Payment for ' . Yii::$app->name . ' is successful', $body);
                return $this->render('paypal-success', [
                    'model' => $model,
                ]);
            }
        } elseif(Yii::$app->request->get('success') == 'false' && isset($payid)){
            $model = $this->findModel($id);
            $model->status = 2;
            $model->payment_id = $payid;
            if($model->save()) {
                $body = '<p>Your payment of $' . $fee . ' for ' . Yii::$app->name . ' paper submission has failed. Your paypal transaction id for any further reference is ' . $model->payment_id . '</p>';
                $model->sendMail(Yii::$app->params['adminEmail'], 'Payment for ' . Yii::$app->name . ' has failed', $body);
                return $this->render('paypal-failed', [
                    'model' => $model,
                ]);
            }
        } elseif(isset($token)) {
			$model = $this->findModel($id);
            $model->status = 3;
            $model->payment_id = $token;
            if($model->save()) {
                $body = '<p>Your payment of $' . $fee . ' for ' . Yii::$app->name . ' paper submission has been cancelled. Your paypal transaction id for any further reference is ' . $model->payment_id . '</p>';
                $model->sendMail(Yii::$app->params['adminEmail'], 'Payment for ' . Yii::$app->name . ' has been cancelled', $body);
                return $this->render('paypal-cancelled', [
                    'model' => $model,
                ]);
            }
		}
    }



    public function actionPaymentCancelled(){
        if($_POST){
            $id = $_POST['udf1'];
            $model = $this->findModel($id);
            $model->status = 3;
            $model->payment_id = $_POST['txnid'];
            if($model->save()){
                $body = '<p>Your payment for IRES 2017 paper submission has been cancelled. Your transaction id for any further reference is '.$model->payment_id.'</p>';
                $model->sendMail(Yii::$app->params['adminEmail'], 'Payment for '.Yii::$app->name.' cancelled', $body);
                return $this->render('cancel', [
                    'model' => $model,
                ]);
            }
        }
    }
    public function actionPaymentSuccess(){
        if($_POST){
            $id = $_POST['udf1'];
            $model = $this->findModel($id);
            $model->status = 1;
            $model->payment_id = $_POST['txnid'];
            if($model->save()){
                $body = '<p>Your payment for IRES 2017 paper submission is successful. Your transaction id for any further reference is '.$model->payment_id.'. <br><br>Please send all required documents i.e. papers in IRES format,copyright form, registration form, fee transaction proof and student id(if applicable) on icires2017@gmail.com</p>';
                $model->sendMail(Yii::$app->params['adminEmail'], 'Payment for '.Yii::$app->name.' is successful', $body);
                return $this->render('payment-success', [
                    'model' => $model,
                ]);
            }
        }
    }
    public function actionPaymentFailed(){
        if($_POST){
            $id = $_POST['udf1'];
            $model = $this->findModel($id);
            $model->status = 2;
            $model->payment_id = $_POST['txnid'];
            if($model->save()){
                $body = '<p>Your payment for IRES 2017 paper submission has failed. Your transaction id for any further reference is '.$model->payment_id.'</p>';
                $model->sendMail(Yii::$app->params['adminEmail'], 'Payment for '.Yii::$app->name.' has failed', $body);
                return $this->render('payment-failed', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing Fee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Fee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	public function actionExecutePay($pid,$cid)
    {
        $payment = $this->executePayment($pid, $cid);
		print_r($payment);
		
    }

    /**
     * Finds the Fee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



    public function makePaymentUsingPayPal($total, $currency, $paymentDesc, $returnUrl, $cancelUrl) {
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        // Specify the payment amount.
        $amount = new Amount();
        $amount->setCurrency($currency);
        $amount->setTotal($total);

        // ###Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. Transaction is created with
        // a `Payee` and `Amount` types
        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription($paymentDesc);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($returnUrl);
        $redirectUrls->setCancelUrl($cancelUrl);

        $payment = new Payment();
        $payment->setRedirectUrls($redirectUrls);
        $payment->setIntent("sale");
        $payment->setPayer($payer);
        $payment->setTransactions(array($transaction));

        $payment->create($this->ApiContext());

        return $payment;
    }


    /**
     * Completes the payment once buyer approval has been
     * obtained. Used only when the payment method is 'paypal'
     *
     * @param string $paymentId id of a previously created
     * 		payment that has its payment method set to 'paypal'
     * 		and has been approved by the buyer.
     *
     * @param string $payerId PayerId as returned by PayPal post
     * 		buyer approval.
     */
    public function ApiContext() {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AaUylwSaTPlXmojSKjPKjAxPy5Qw5MbZtyY_WzQMo4fwjbjR70dkXH5FXhTUQid51ai6E3OJ9iiFl5AU',     // ClientID
                'ENMiPsq7vjSkmvAioTZcfosMzFOFTqxaZ9crVZbScVLHcCb7DIguS2LQk4T8MoxscIAT0PjhglsjN8-R'      // ClientSecret
            )
        );
        if(Yii::$app->params['settings']['is_live'] == 1){
            $mode = 'live';
        }
        else{
            $mode = 'sandbox';
        }
        $apiContext->setConfig(
            array(
                'mode' => $mode,
            )
        );
        return $apiContext;
    }
    public function executePayment($paymentId, $payerId) {

        $payment = $this->getPaymentDetails($paymentId);
        $paymentExecution = new PaymentExecution();
        $paymentExecution->setPayerId($payerId);
        $payment = $payment->execute($paymentExecution, $this->ApiContext());

        return $payment;
    }
    public function getLink(array $links, $type) {

        foreach($links as $link) {

            if($link->getRel() == $type) {
                return $link->getHref();
            }

        } 
        return "";

    }
    /**
     * Retrieves the payment information based on PaymentID from Paypal APIs
     *
     * @param $paymentId
     *
     * @return Payment
     */
    public function getPaymentDetails($paymentId) {
        $payment = Payment::get($paymentId, $this->ApiContext());
        return $payment;
    }


}
