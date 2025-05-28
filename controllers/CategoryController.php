<?php

namespace app\controllers;

use Yii;
use app\models\CategorySearch;
use app\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class CategoryController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
    
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id_category)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_category),
        ]);
    }

    public function actionCreate()
    {
        $model = new Category();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->photo_category = UploadedFile::getInstance($model, 'photo_category');

            if ($model->validate()) {
                if ($model->photo_category) {
                    $path = $model->upload();
                    if ($path) {
                        $model->photo_category = $path;
                    }
                }

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Категория успешно создана.');
                    return $this->redirect(['view', 'id_category' => $model->id_category]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id_category)
    {
        $model = $this->findModel($id_category);

        if ($model->load(Yii::$app->request->post())) {
            $imageFile = UploadedFile::getInstance($model, 'photo_category');
            
            if ($imageFile) {
                $fileName = uniqid() . '.' . $imageFile->extension;
                $imageFile->saveAs(Yii::getAlias('@webroot/assets/images/' . $fileName));
                $model->photo_category = $fileName;
            } else {
                $model->photo_category = Category::findOne($id_category)->photo_category;
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id_category' => $model->id_category]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id_category)
    {
        $this->findModel($id_category)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id_category)
    {
        if (($model = Category::findOne($id_category)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая модель не найдена.');
    }

    public function actionCatalog()
    {
        $categories = Category::find()->all();

        return $this->render('catalog', [
            'categories' => $categories,
        ]);
    }

    public function beforeAction($action)
    {
        if ($action->id === 'delete') {
            Yii::$app->request->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }
}