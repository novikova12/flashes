<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Category $model */
$this->title = 'Обновить категорию: ' . $model->name_category;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_category, 'url' => ['view', 'id_category' => $model->id_category]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<link href="<?= Url::to('@web/css/category.css') ?>" rel="stylesheet">


<div class="category-update">

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