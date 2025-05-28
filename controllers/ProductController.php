<?php

namespace app\controllers;

use app\models\Product;
use app\models\ProductSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
    public function beforeAction($action)
    {
        if ($action->id === 'delete') {
            Yii::$app->request->enableCsrfValidation = false; 
        }
    
        return parent::beforeAction($action);
    }

    
    public function upload()
    {
        if ($this->validate()) {
            $path = 'assets/images/' . Yii::$app->getSecurity()->generateRandomString(10) . '.' . $this->photo_product->extension;
            $this->photo_product->saveAs($path);
            return $path;
        } else {
            return false;
        }
    }

    /**
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCatalog()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('catalog', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param int $id_product Id Product
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
/**
 * Displays a single Product model.
 * @param int $id_product Id Product
 * @return string
 * @throws NotFoundHttpException if the model cannot be found
 */
public function actionView($id_product)
{
    $model = $this->findModel($id_product); 
    return $this->render('view', [
        'model' => $model,
    ]);
}

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();
    
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->photo_product = UploadedFile::getInstance($model, 'photo_product'); 
    
            if ($model->validate()) { 
                if ($model->save()) { 
                    
                    if ($model->photo_product) {
                        $path = $model->upload(); 
                        if ($path) {
                            $model->photo_product = $path; 
                            $model->save(false); 
                        }
                    }
    
                    Yii::$app->session->setFlash('success', 'Услуга успешно создана.');
                    return $this->redirect(['index', 'id_product' => $model->id_product]); 
                }
            }
        }
    
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_product Id Product
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_product)
    {
        $model = $this->findModel($id_product); 
    
        $photo = $model->photo_product; 
    
        if ($model->load(Yii::$app->request->post())) {
            $model->photo_product = UploadedFile::getInstance($model, 'photo_product');
    
            
            if ($model->photo_product) {
                $path = $model->upload(); 
                if ($path) {
                    $model->photo_product = $path; 
                }
            } else {
                $model->photo_product = $photo; 
            }
    
            if ($model->save(false)) { 
                Yii::$app->session->setFlash('success', 'Услуга успешно обновлена.');
                return $this->redirect(['view', 'id_product' => $model->id_product]); 
            }
        }
    
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_product Id Product
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_product)
    {
        $this->findModel($id_product)->delete();
        Yii::$app->session->setFlash('success', 'Услуга успешно удалена.'); 
        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_product Id Product
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
  protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
    }
}