<?php

namespace backend\controllers;

use Yii;
use common\models\SpecialSession;
use common\models\SpecialSessionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\traits\FileUploadTrait;
use yii\imagine\Image;
use kartik\file\FileInput;
use yii\web\UploadedFile;

/**
 * SpecialSessionController implements the CRUD actions for SpecialSession model.
 */
class SpecialSessionController extends BackendController
{
    /**
     * @inheritdoc
     */
    use FileUploadTrait;

    /**
     * Lists all SpecialSession models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpecialSessionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SpecialSession model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	public function actionActivateAccount($id)
    {
        return $this->render('activate-account', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SpecialSession model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SpecialSession();

        $image = UploadedFile::getInstance($model, 'file');
        if ($model->load(Yii::$app->request->post())) {
			if($image != '')
			{
					
					$name = $image->name;
					$size = Yii::$app->params['folders']['size'];
					$main_folder = "downloads";
					$image_name= $this->uploadFile($image,$name,$main_folder,$size);
					$model->file = $image_name;
											
			}
			$model->save();
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Session has been created successfully!'));
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SpecialSession model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$image_S = $model->file;
		$image = UploadedFile::getInstance($model, 'file');
        if ($model->load(Yii::$app->request->post())) {
			if($image != '')
			{
					
					$name = $image->name;
					$size = Yii::$app->params['folders']['size'];
					$main_folder = "downloads";
					$image_name= $this->uploadFile($image,$name,$main_folder,$size);
					$model->file = $image_name;
											
			}else{
				$model->file = $image_S;
			}
			$model->save();
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Session has been Updated successfully!'));
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
	public function actionActivateChair($id)
    {
        $model = $this->findModel($id);
		$model->status = 1;
		$model->save();
		$user = 
		Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Session has been Updated successfully!'));
		return $this->redirect(['index']);        
    }

    /**
     * Deletes an existing SpecialSession model.
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
     * Finds the SpecialSession model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SpecialSession the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SpecialSession::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
