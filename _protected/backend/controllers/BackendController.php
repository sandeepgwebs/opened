<?php
namespace backend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;

/**
 *
 *
 *
 *
 *
 * BackendController extends Controller and implements the behaviors() method
 * where you can specify the access control ( AC filter + RBAC) for 
 * your controllers and their actions.
 */
class BackendController extends Controller
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
						'controllers' => ['site'],
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
						'controllers' => ['site'],
                        'actions' => ['logout','index'],
                        'allow' => true,
						'roles' => ['admin','theCreator'],
                    ],				
				
                    [
                        'controllers' => ['user', 'gallery', 'downloads', 'special-session', 'sponser', 'sponsor-category'],
                        'actions' => ['index', 'view', 'create', 'update','update-any-status', 'delete'],
                        'allow' => true,
                        'roles' => ['admin','theCreator'],
                    ],
					[
                        'controllers' => ['speakers','exam-date','category','members','slider'],
                        'actions' => ['index', 'create', 'update','update-any-status', 'delete','viewmembers'],
                        'allow' => true,
                        'roles' => ['admin','theCreator'],
                    ],
				
                    [
                        'controllers' => ['pages','type','special-session','downloads'],
                        'actions' => ['index', 'create','update','update-any-status','manage','save','remove','move','delete'],
                        'allow' => true,
                        'roles' => ['admin','theCreator'],
                    ],		
                    [
                        'controllers' => ['downloads'],
                        'actions' => ['show-home'],
                        'allow' => true,
                        'roles' => ['admin','theCreator'],					
                    ],		
                    [
                        'controllers' => ['special-session'],
                        'actions' => ['activate-account','activate-chair'],
                        'allow' => true,
                        'roles' => ['admin','theCreator'],					
                    ],			
                    [
                        'controllers' => ['papers'],
                        'actions' => ['submission-download'],
                        'allow' => true,
                        'roles' => ['admin','theCreator'],					
                    ],		
                    [
                        'controllers' => ['uploadfile'],
                        'actions' => ['browse', 'create','update-any-status','update','url'],
                        'allow' => true,
                        'roles' => ['admin','theCreator'],					
                    ],
                    [
                        'controllers' => ['attributes','entity','type','menu','slider-images'],
                        'actions' => ['home-slider','create-values','update-any-status','index', 'term-value','view', 'create', 'update','viewmenus','c-menu','values','status','url','browse','inactive','active','manage-attributes','add-attributes','sort-general-attrs','sort-slider-attrs','update-attr-value','sort-attr-values','viewattribute'],
                        'allow' => true,
                        'roles' => ['admin','theCreator'],
                    ],
                  
                   
                    [
                        'controllers' => ['setting-attributes'],
                        'actions' => ['index','update-any-status', 'create','upload','update','web-set','viewattribute','view'],
                        'allow' => true,
                        'roles' => ['admin','theCreator'],
                    ],					
                    [
                        'controllers' => ['uploadfile'],
                        'actions' => ['url','update-any-status','browse'],
                        'allow' => true,
                        'roles' => ['admin','theCreator'],
                    ],						
					
                ], // rules
				
				/*'denyCallback' => function ($rule, $action) {
					if(Yii::$app->user->isGuest){	
						return $this->redirect(['site/login']); 
					}else{						
						return $this->redirect(Yii::$app->params['baseurl']);
					}
				},*/
      				

            ], // access

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ], // verbs

        ]; // return

    } // behaviors
	
	//update any status
    public function actionUpdateAnyStatus(){


		if(Yii::$app->request->isAjax && Yii::$app->request->post('status_token')){
			$add = 'Inactive';
			$remove = 'Active';
			
            $id = Yii::$app->request->post('id');
            $field = Yii::$app->request->post('field');
			if($field == 'status'){
				$add = 'Inactive';
				$remove = 'Active';
			}
			
            $model = Yii::$app->request->post('model');
			
			if($model){
				$model = 'common\models\\'.$model;
				$model = $model::findOne($id);
			}else{
				$model = $this->findModel($id);
			}
			
			if($model->$field == 1){

				$result = (bool)$model->updateAttributes([$field => 0]);
				Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
				return [
					'result' => $result,
					'action' => $add,
				];
			} else {

				$result = (bool)$model->updateAttributes([$field => 1]);
				Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
				return [
					'result' => $result,
					'action' => $remove,
				];
			}
        }
    }
} // BackendController