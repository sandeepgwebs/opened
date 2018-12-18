<?php
namespace frontend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;

/**
 * FrontendController extends Controller and implements the behaviors() method
 * where you can specify the access control ( AC filter + RBAC) for
 * your controllers and their actions.
 */
class FrontendController extends Controller
{
    /**
     * Returns a list of behaviors that this component should behave as.
     * Here we use RBAC in combination with AccessControl filter.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'controllers' => ['article'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'admin'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'controllers' => ['article'],
                        'actions' => ['create', 'update', 'admin'],
                        'allow' => true,
                        'roles' => ['editor'],
                    ],[
                        'controllers' => ['fee'],
                        'actions' => ['index', 'pay-fee', 'submission-download','create','view', 'create-record', 'calculate','confirm-slip','confirm-fee','select-method', 'pay-fee','paypal-payment', 'make-payment','paypal-success','payment-success','payment-cancelled','payment-failed','update-fee','calculate-fee'],
                        'allow' => true,
                        'roles' => ['member'],
                    ],
                    [
                        'controllers' => ['article','cart'],
                        'actions' => ['index', 'view','add','cart','images','checkout','active-cities','active-states','remove','address','place-order','discount','payment-method','payment','payment-test','response','thank-you','thank-you-testing','pincode'],
                        'allow' => true
                    ],

                    [
                        // other rules
                    ],

                ], // rules

            ], // access

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ], // verbs

        ]; // return

    } // behaviors

} // AppController
