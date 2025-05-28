<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\FeedbackForm;

class FeedbackController extends Controller
{
    public function actionIndex()
    {
        $model = new FeedbackForm();

       
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
           
   
            Yii::$app->session->setFlash('success', 'Ваш отзыв был успешно отправлен!');
            return $this->refresh(); 
        }

        
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}