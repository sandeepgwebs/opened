<?php

namespace backend\controllers;

use Yii;
use common\models\Gallery;
use common\models\GallerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\imagine\Image;
use kartik\file\FileInput;
use yii\web\UploadedFile;
use common\traits\ImageUploadTrait;
/**
 * GalleryController implements the CRUD actions for Gallery model.
 */
class GalleryController extends BackendController
{
    /**
     * @inheritdoc
     */
	use ImageUploadTrait;
    

    /**
     * Lists all Gallery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gallery model.
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
     * Creates a new Gallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gallery();
		$image = UploadedFile::getInstance($model, 'image');
        if ($model->load(Yii::$app->request->post())) {
			if($image != '')
			{
					$newname =$image->name;
					$name = str_replace(' ','-',strtolower($newname));
					$size = Yii::$app->params['folders']['size'];
					$main_folder = "gallery";
					$image_name= $this->uploadImage($image,$name,$main_folder,$size);
					$model->image = $image_name;
											
			}
			
			$model->save();
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Image has been added successfully!'));
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Gallery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$image_path = $model->image;
		$image = UploadedFile::getInstance($model, 'image');
        if ($model->load(Yii::$app->request->post())) {
            if($image != '')
			{
					$newname =$image->name;
					$name = str_replace(' ','-',strtolower($newname));
					$size = Yii::$app->params['folders']['size'];
					$main_folder = "gallery";
					$image_name= $this->uploadImage($image,$name,$main_folder,$size);
					$model->image = $image_name;
											
			}else
			{
				$model->image = $image_path;
			}
			$model->save();
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Image has been updated successfully!'));
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Gallery model.
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
     * Finds the Gallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gallery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
