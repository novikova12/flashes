<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Category $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Добавить категорию';
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<link href="<?= Url::to('@web/css/category.css') ?>" rel="stylesheet">

<style>
    body {
        margin: 0; 
        height: 100vh; 
        background-image: url('<?= Url::to('@web/assets/images/dark.jpg') ?>'); 
        background-size: cover; 
        background-position: center; 
        color: white; 
    }

    .category-create {
        text-align: center;
        padding: 20px; 
        background-color: rgba(255, 255, 255, 0.1); 
        border-radius: 10px; 
        margin: 120px auto; 
        max-width: 600px; 
    }

    h1 {
        font-size: 3em; 
        color: white; 
        margin-bottom: 20px; 
    }

    .btn {
        border-radius: 10px; 
        transition: background-color 0.3s; 
    }

    .btn-success {
        background-color: rgb(160, 114, 125); 
        color: white; /* Цвет текста кнопки */
    }

    .btn-success:hover {
        background-color: rgb(134, 95, 105); 
    }

    
    select {
        color: black; 
        background-color: white; 
        padding: 10px; 
        border-radius: 5px;
        border: 1px solid #ccc; 
        width: 100%; 
        appearance: none; 
    }

    
    select option {
        color: black; 
        background-color: white; 
    }

    select:focus {
        border-color: rgb(160, 114, 125); 
        outline: none; 
    }
</style>

<div class="category-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="category-form">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'name_category')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'photo_category')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>