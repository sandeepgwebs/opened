<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Papers;
use common\models\Configs;
use common\models\Authors;
use common\models\AuthorsSearch;
use common\models\PapersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\traits\FileUploadTrait;
use yii\imagine\Image;
use kartik\file\FileInput;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * PapersController implements the CRUD actions for Papers model.
 */
class PapersController extends Controller
{
    /**
     * @inheritdoc
     */
	 use FileUploadTrait;
    public function behaviors()
    {
        return [
			'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                   
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Papers models.
     * @return mixed
     */
    public function actionIndex()
    {
		$this->layout = 'main-leftbar';
        $searchModel = new PapersSearch();
		$id  = Yii::$app->user->identity->id; 
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Papers model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		if(!Yii::$app->user->isGuest){
		$this->layout = 'main-leftbar';
		$searchModel = new AuthorsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);
        return $this->render('view', [
            'model' => $this->findModel($id),
			'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
		} else {
			return $this->redirect(['site/login', 'tc'=>'sb']);
		}
    }

    /**
     * Creates a new Papers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	public function actionCreateAuthor($paper_id=0)
    {
		$model = new Authors();
		if(!Yii::$app->user->isGuest){
			$this->layout = 'main-login';
			if ($model->load(Yii::$app->request->post())) {
				$model->paper_id =  $paper_id;
				$model->save();
				$body = "<h3>Dear " . $model->fname."</h3>";
				$body .= '<p>New Author has been Added submitted successfully!.<br>The paper Id is: <b>scesm-'.$paper_id.'</b></p>';
				$model->sendMail($model->email, 'New Author Submition', $body);
				return $this->redirect(['view','id' =>$paper_id]);
			}else {
				return $this->render('authors/create', [
					'model' => $model,
					'paper_id' => $paper_id,
				]);
			}
           
        } 
		else {
			return $this->redirect(['site/login', 'tc'=>'sb']);
		}
    } 
	public function actionUpdateAuthor($paper_id=0,$id=0)
    {
		$model = Authors::findOne($id);
		if(!Yii::$app->user->isGuest){
			$this->layout = 'main-login';
			if($model->load(Yii::$app->request->post())) {
				$model->paper_id =  $paper_id;
				$model->save();
				$body = "<h3>Dear " . $model->fname."</h3>";
				$body .= '<p>New Author has been Updated submitted successfully!.<br>The paper Id is: <b>scesm-'.$paper_id.'</b></p>';
				$model->sendMail($model->email, 'Author Updated', $body);
				 return $this->redirect(['view','id' =>$paper_id]);
			}else {
				return $this->render('authors/update', [
					'model' => $model,
					'paper_id' => $paper_id,
				]);
			}
           
        } 
		else {
			return $this->redirect(['site/login', 'tc'=>'sb']);
		}
    }
    public function actionCreate()
    {
		if(!Yii::$app->user->isGuest){
			$submissionStatus = Configs::findOne(1);
			if($submissionStatus->status == 1){
				$this->layout = 'main-login';
				$model = new Papers();
				$model->user_id  = Yii::$app->user->identity->id;
				$image = UploadedFile::getInstance($model, 'pfile');
				if ($model->load(Yii::$app->request->post())) {
					$count = Yii::$app->request->post('Papers')['count'];
					if($image != '')
					{
							$name = time()."_".$image->name;
							$size = Yii::$app->params['folders']['size'];
							$main_folder = "papers";
							$image_name= $this->uploadFile($image,$name,$main_folder,$size);
							$model->pfile = $image_name;
													
					}
					if($model->save()){
						$body = "<h3>Dear " . Yii::$app->user->identity->profile->fname."</h3>";
						$body .= '<p>New Paper has been submitted successfully by You.<br>The paper Id is: <b>ires-'.$model->id.'</b></p>';
						
						//$body .= '<a target="_blank" href="'.Html::a(Html::encode(Url::to(['/papers/view', 'id' => $model->id], true))).'">'.Html::a(Html::encode(Url::to(['/papers/view', 'id' => $model->id], true)))."</a>";
						
						//$body .= Html::a('View Papers', ['view','id' => $model->id], ['class' => '']);
						$model->sendMail(Yii::$app->user->identity->email, 'New Paper submission', $body);
						$postdata = Yii::$app->request->post('Papers');
						for($i=0;$i<$count;$i++){
							if(isset($postdata['fname'.$i]) && $postdata['fname'.$i]!=""){
								$author = new Authors();
								$author->paper_id =  $model->id;
								$author->fname =  $postdata['fname'.$i];
								$author->lname =  $postdata['lname'.$i];
								$author->email =  $postdata['email'.$i];
								$author->country_id =  $postdata['country_id'.$i];
								$author->organization =  $postdata['organization'.$i];
								$author->webpage =  $postdata['webpage'.$i];
								$author->corresp =  $postdata['corresp'.$i];
								$author->save();
								if(Yii::$app->user->identity->email!= $author->email){
								$body = "<h3>Dear " . $author->fname."</h3>";
								$body .= '<p>New Paper in which you are one of the authors has been submitted successfully!.<br>The paper Id is: <b>ires-'.$model->id.'</b></p>';
								$model->sendMail($author->email, 'New Paper submission', $body);
								}
							}
						}				
					}
					return $this->redirect(['view', 'id' => $model->id]);
				} else {
					return $this->render('create', [
						'model' => $model,
					]);
				}
			} else {
				return $this->render('/configs/config-message', [
						'model' => $submissionStatus,
						'heading'=>'Special session paper submission',
					]);
			}
		} else {
			return $this->redirect(['site/login', 'tc'=>'sb']);
		}
    }
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
    /**
     * Updates an existing Papers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    
	public function actionUpdate($id)
    {
		if(!Yii::$app->user->isGuest){
			$this->layout = 'main-login';
			$model = $this->findModel($id);
			$authors = Authors::findAll(['paper_id'=>$id]);
			$filesd = $model->pfile;
			$model->user_id  = Yii::$app->user->identity->id;
			$image = UploadedFile::getInstance($model, 'pfile');
			if ($model->load(Yii::$app->request->post())) {
				$count = Yii::$app->request->post('Papers')['count'];
				if($image != '')
				{
						$name = time()."_".$image->name;
						$size = Yii::$app->params['folders']['size'];
						$main_folder = "papers";
						$image_name= $this->uploadFile($image,$name,$main_folder,$size);
						$model->pfile = $image_name;
												
				}else{
					$model->pfile = $filesd;
				}
				$model->save();
				$body .= "<h3>Dear " . Yii::$app->user->identity->username."</h3>";
				$body .= '<p>Paper has been updated successfully by You.<br>The paper Id is: <b>scesm-'.$model->id.'</b></p>';
				$body .= Html::a(Html::encode(Url::to(['/papers/view', 'id' => $model->id], true)));
				$model->sendMail(Yii::$app->user->identity->email, 'New Paper Submition', $body);
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('update', [
					'model' => $model,
					'authors' => $authors,
				]);
			}
		} else {
			return $this->redirect(['site/login', 'tc'=>'sb']);
		}
    }
    /**
     * Deletes an existing Papers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Papers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Papers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Papers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
