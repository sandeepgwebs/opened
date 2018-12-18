<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use common\models\Papers;
use common\models\PapersSearch;
use common\models\Papers1Search;
use common\models\Authors;
use common\models\AuthorsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PapersController implements the CRUD actions for Papers model.
 */
class SessionPapersController extends Controller
{
    /**
     * @inheritdoc
     */
    

    /**
     * Lists all Papers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Papers1Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	public function actionSubmissionDownload($id)
    {
        
			$paperModel = $this->findModel($id);
            $file = Yii::$app->params['uploadurl'].'/uploads/papers/'.$paperModel->pfile;
						
			if (file_exists($file)) {
				
			   return Yii::$app->response->sendFile($file);

			} 

      
        
    }
	
	
	public function actionSubmissionDownload1($id)
	{
		$paperModel = $this->findModel($id);
		$filename  = $paperModel->pfile;
		$storagePath = Yii::$app->params['websiteurl'].'uploads/papers/';
		
		// check filename for allowed chars (do not allow ../ to avoid security issue: downloading arbitrary files)
		
		return Yii::$app->response->sendFile("$storagePath/$filename", $filename)->send();
	}
	
    public function actionView($id)
    {
		$searchModel = new AuthorsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);
        return $this->render('view', [
            'model' => $this->findModel($id),
			'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Papers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Papers();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	public function actionCreateAuthor($paper_id=0)
    {
		$model = new Authors();
		if(!Yii::$app->user->isGuest){
			$this->layout = 'main-login';
			if ($model->load(Yii::$app->request->post())) {
				$model->paper_id =  $paper_id;
				$model->save();
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
        $model = $this->findModel($id);
		$author = Authors::findOne(['paper_id'=>$model->id]);
		$model->email0 = $author->email;
		$model->organization0 = "abc";
		$model->country_id0 = 1;
		$model->fname0 = $author->email;
		$model->status = 0;
		if($model->save()){
			return $this->redirect(['index']);
		} else {
			print_r($model->getErrors());
			die;
		}
       
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
