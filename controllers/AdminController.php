<?php

namespace app\controllers;

use app\models\Admin;
use yii\web\UploadedFile;
use app\models\Product;
use app\models\Ordder;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\OrdderSearch;
use Yii;
use yii\web\ForbiddenHttpException;

class AdminController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'cancel' => ['POST'],
                    ],
                ],  
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id_order)
    {
        $model = Ordder::findOne($id_order);
        
        if ($model === null) {
            throw new NotFoundHttpException('Запись не найдена.');
        }
    
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionUpdateProduct($id_product)
    {
        $model = Product::findOne($id_product);
    
        if ($model === null) {
            throw new NotFoundHttpException('Продукт не найден.');
        }

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $photoFile = UploadedFile::getInstance($model, 'photo_product');

            if ($photoFile) {
                $model->photo_product = $photoFile;
                $photoFileName = 'product_' . $model->id_product . '.' . $photoFile->extension;
                $photoFilePath = 'path/to/save/images/' . $photoFileName;

                if ($photoFile->saveAs($photoFilePath)) {
                    $model->photo_product_name = $photoFileName; 
                }
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Продукт успешно обновлен.');
                return $this->redirect(['products']);
            }
        }

        return $this->render('update-product', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Admin();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_admin' => $model->id_admin]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id_admin)
    {
        $model = $this->findModel($id_admin);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_admin' => $model->id_admin]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function findModel($id_product)
    {
        if (($model = Product::findOne(['id_product' => $id_product])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая модель не найдена.');
        }
    }

    public function actionProducts()
    {
        return $this->render('products', [
            'dataProvider' => new \yii\data\ActiveDataProvider([
                'query' => Product::find(),
                'pagination' => [
                    'pageSize' => 7,
                ],
            ]),
        ]);
    }

    public function actionOrders()
    {
        $searchModel = new OrdderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('orders', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionConfirm($id_order)
    {
        Yii::$app->request->enableCsrfValidation = false;
        $model = Ordder::findOne($id_order);
        
        if ($model === null) {
            throw new NotFoundHttpException('Запрашиваемая модель не найдена.');
        }

        if (Yii::$app->request->isPost) {
            if ($model->status === 'Новый') {
                $model->status = 'Подтвержден';
                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', 'Запись успешно подтверждена');
                } else {
                    Yii::$app->session->setFlash('error', 'Не удалось подтвердить запись. Попробуйте еще раз.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Этот запись уже подтверждена или не может быть подтверждена');
            }

            return $this->redirect(['index']);
        }

        return $this->redirect(['index']);
    }

    public function actionDeleteOrder($id_order)
    {
        $currentUser = Admin::findOne(Yii::$app->user->id);

        if ($currentUser === null || $currentUser->id_admin != 1) {
            throw new ForbiddenHttpException('У вас нет прав для удаления записей.');
        }

        $model = Ordder::findOne($id_order);

        if ($model === null) {
            throw new NotFoundHttpException('Запись не найдена.');
        }

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'запись удалена.');
        } else {
            Yii::$app->session->setFlash('error', 'Не удалось удалить запись.');
        }

        return $this->redirect(['index']);
    }
}