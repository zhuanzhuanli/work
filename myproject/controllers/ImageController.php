<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use app\models\UploadForm;

class ImageController extends Controller
{
	

	public function actionUpload ()
	{
		$model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstances($model, 'file');
			$res = $model->upload();
  
        }

        return $this->render('upload', ['model' => $model,'data' =>$res]);
	}


  
}
