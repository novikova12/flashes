<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Category $model */

$this->title = $model->name_category;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<link href="<?= Url::to('@web/css/category.css') ?>" rel="stylesheet">

<div class="category-view">
    <h1 class="category-title"><?= Html::encode($this->title) ?></h1>

    <div>
        <?php if (!empty($model->photo_category)): ?>
            <img src="<?= Url::to('@web/assets/images/' . $model->photo_category) ?>" alt="Фотография категории" class="category-image">
        <?php else: ?>
            <p>Фотография категории не доступна.</p>
        <?php endif; ?>
    </div>

    <div>
        <strong>ID Категории:</strong> <?= Html::encode($model->id_category) ?><br>
    </div>

    <div class="button-container">
        <?= Html::a('Редактировать', ['update', 'id_category' => $model->id_category], ['class' => 'btn btn-danger']) ?>
        <?= Html::a('Удалить', ['delete', 'id_category' => $model->id_category], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить эту категорию?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
</div>