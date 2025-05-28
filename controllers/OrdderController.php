<?php

namespace app\controllers;

use app\models\Ordder;
use app\models\OrdderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Admin;
use Yii;
use yii\web\ForbiddenHttpException;
/**
 * OrdderController implements the CRUD actions for Ordder model.
 */
class OrdderController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Ordder models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Admin::isAdmin(Yii::$app->user->id)) {
            throw new ForbiddenHttpException('У вас нет прав доступа к этой странице.');
        }
        $searchModel = new OrdderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function canEdit()
{
    return $this->user_id == Yii::$app->user->id || Admin::isAdmin(Yii::$app->user->id);
}

public function beforeAction($action)
{
    if (Yii::$app->user->isGuest) {
        $this->redirect(['site/login']);
        return false;
    } else if (Yii::$app->user->id == 1) { 
        return true;
    } else
        return true;
}

    /**
     * Displays a single Ordder model.
     * @param int $id_order Id Order
     * @return string
     * @throws NotFoundHttpException 
     */
    public function actionView($id_order)
    {
        $model = Ordder::findOne($id_order);
        
        if ($model === null) {
            throw new NotFoundHttpException('Запись не найдена.');
        }
        
      
        if (Yii::$app->user->id == 1) {
            return $this->render('view', [
                'model' => $model,
            ]);
        } else {
          
            if ($model->canEdit()) {
                return $this->render('view', [
                    'model' => $model,
                ]);
            } else {
                throw new ForbiddenHttpException('У вас нет прав для просмотра этой записи.');
            }
        }
    }

    /**
     * Creates a new Ordder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $order = new Ordder(); 
    
        if (!Yii::$app->user->isGuest) { 
          
            $order->load(Yii::$app->request->post());
            $order->created_at = date('Y-m-d H:i:s'); 
            $order->status = 'Новый'; 
            $order->user_id = Yii::$app->user->id; 
    
            if ($order->save()) {
                return $this->redirect(['myorder']);
            
            } else {
                Yii::error($order->getErrors()); 
                Yii::$app->session->setFlash('error', 'Ошибка при сохранении записи.'); 
            }
        } else {
            Yii::$app->session->setFlash('warning', 'Пожалуйста, войдите в систему для создания записи.'); 
            return $this->redirect(['site/login']); 
        }
    
        return $this->render('create', [
            'model' => $order, 
        ]);
    }
    public function isAdmin()
    {
      
        $userId = Yii::$app->user->id;
    
        return Admin::find()->where(['id_admin' => $userId])->exists();
    }


       
        protected function validateAppointmentTime($appointmentTime)
        {
            $dt = new \DateTime($appointmentTime);
            $weekDay = $dt->format('N');
            $time = $dt->format('H:i');
    
           
            if ($weekDay < 1 || $weekDay > 5) {
                return false; 
            }
    
         
            if ($time < '09:00' || $time > '18:00') {
                return false; 
            }
    
           
            if (Ordder::find()->where(['appointment_datetime' => $appointmentTime])->exists()) {
                return false; 
            }
    
            return true; 
        }
        public function actionConfirm($id_order)
        {
          
            $model = Ordder::findOne($id_order);
        
            if ($model === null) {
                throw new NotFoundHttpException('Заказ не найден.');
            }
        
           
            if (!$this->isAdmin()) {
                throw new ForbiddenHttpException('У вас нет прав для подтверждения этой записи.');
            }
        
            
            if ($model->status === 'Подтвержден') {
                Yii::$app->session->setFlash('error', 'Запись уже подтверждена.');
                return $this->redirect(['index']);
            }
        
         
            $model->status = 'Подтвержден'; 
        
           
            if ($model->save(false)) { 
                Yii::$app->session->setFlash('success', 'Запись успешно подтверждена.');
            } else {
                Yii::$app->session->setFlash('error', 'Не удалось подтвердить запись. ' . json_encode($model->getErrors()));
            }
        
            return $this->redirect(['index']); 
        }
        
   
    public function actionBook($id_product = null)
{
    $model = new Ordder();

   
    $availableSlots = $model->getAvailableTimeSlots();

    if ($model->load(Yii::$app->request->post())) {
        $appointmentDate = Yii::$app->request->post('Ordder')['appointment_datetime'];
        $model->appointment_datetime = $appointmentDate;
        $model->created_at = date('Y-m-d H:i:s');
        $model->status = 'Новый';
        $model->user_id = Yii::$app->user->id;
        $model->product_id = $id_product;

      
        if ($this->validateAppointmentTime($appointmentDate)) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Вы успешно записались!');
                return $this->redirect(['ordder/myorder']);
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка сохранения записи.');
                Yii::error($model->getErrors());
            }
        } else {
            Yii::$app->session->setFlash('error', 'Выберите корректное время для записи.');
        }
    }

    return $this->render('book', [
        'model' => $model,
        'availableSlots' => $availableSlots, 
    'id_product' => $id_product, 
    ]);
}


    /**
     * Updates an existing Ordder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_order Id Order
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_order)
    {
        $model = $this->findModel($id_order);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_order' => $model->id_order]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }



public function actionMyorder()
{
    $userId = Yii::$app->user->id;
    $orders = Ordder::find()
        ->where(['user_id' => $userId])
        ->with('product') 
        ->all();

   
    foreach ($orders as $order) {
        $order->checkAndUpdateStatus();
    }

    return $this->render('myorder', [
        'orders' => $orders,
    ]);
}
    /**
     * Deletes an existing Ordder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_order Id Order
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_order)
    {
        $this->findModel($id_order)->delete();

        return $this->redirect(['index']);
    }
   
    public function actionCancel($id_order)
    {
        $model = Ordder::findOne($id_order);
        
        if ($model === null) {
            throw new NotFoundHttpException('Запись не найдена.');
        }
    
      
        if (!$model->canEdit()) {
            throw new ForbiddenHttpException('У вас нет прав для отмены этой записи.');
        }
    
       
        if ($model->cancelOrder()) {
            Yii::$app->session->setFlash('success', 'Запись успешно отменена.');
            
           
            if (Yii::$app->user->id == 1) { 
                return $this->redirect(['index']);
            }
        } else {
           
            Yii::$app->session->setFlash('error', 'Не удалось отменить запись. ' . json_encode($model->getErrors()));
        }
        
     
        return $this->redirect(['myorder']);
    }

    

    /**
     * Finds the Ordder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_order Id Order
     * @return Ordder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ordder::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Запись не найдена.');
    }
}
