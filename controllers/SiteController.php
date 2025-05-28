<?php

namespace app\controllers;

use Yii;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\CategorySearch;
use app\models\ProductSearch;
use app\models\FeedbackForm;
use app\models\Category;
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $model = new LoginForm();
    
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->identity->isAdmin()) { 
                return $this->redirect(['admin/index']); 
            } else {
                return $this->goBack(); 
            }
        }
    
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
/**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
    $searchModel = new ProductSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);
    
    return $this->render('about', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
    ]);
    }
      /**
     * Displays feedback page and handles feedback form submission.
     *
     * @return Response|string
     */
    public function actionFeedback()
    {
        $model = new FeedbackForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->session->setFlash('feedbackSubmitted', 'Ваш отзыв был успешно отправлен!');

            return $this->refresh(); 
        }

        return $this->render('feedback', [
            'model' => $model,
        ]);
    }
    public function actionCategory()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
        $categories = Category::find()->all();
    
        return $this->render('category', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories, 
        ]);
    }

    public function actionOrdder()
    {
        return $this->redirect(['ordder/index']); 
    }
    public function actionMyOrdder()
    {
        return $this->redirect(['ordder/myorder']); 
    }
}