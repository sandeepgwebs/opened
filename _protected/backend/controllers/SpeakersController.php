<?php

namespace backend\controllers;

use Yii;
use common\models\Speakers;
use common\models\SpeakersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\imagine\Image;
use kartik\file\FileInput;
use yii\web\UploadedFile;

use common\traits\ImageUploadTrait;
/**
 * SpeakersController implements the CRUD actions for Speakers model.
 */
class SpeakersController extends BackendController
{
    /**
     * @inheritdoc
     */
	use ImageUploadTrait;
    

    /**
     * Lists all Speakers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpeakersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Speakers model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Speakers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Speakers();
		$image = UploadedFile::getInstance($model, 'avatar');
        if ($model->load(Yii::$app->request->post())) {
			if($image != '')
			{
					$name = time();
					$size = Yii::$app->params['folders']['size'];
					$main_folder = "speakers";
					$image_name= $this->uploadImage($image,$name,$main_folder,$size);
					$model->avatar = $image_name;
			}
			 $model->save();
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Speaker has been created successfully!'));
			 return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Speakers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$imgname = $model->avatar;
		$image = UploadedFile::getInstance($model, 'avatar');
        if ($model->load(Yii::$app->request->post())) {
			if($image != '')
			{
				if($imgname){
					$name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $imgname);
				}else{
					$name = time();
				}
				$size = Yii::$app->params['folders']['size'];
				$main_folder = "speakers";

				$image_name= $this->uploadImage($image,$name,$main_folder,$size);
				$model->avatar = $image_name;
			}else{
				$model->avatar = $imgname;
			}
			$model->save();
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Speaker has been updated successfully!'));
			 return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Speakers model.
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
     * Finds the Speakers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Speakers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Speakers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
