<?php

use yii\helpers\Html;
use yii\helpers\Url;
/** @var yii\web\View $this */
/** @var app\models\Admin $model */

$this->title = 'Обновить администратора: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Администраторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id_admin' => $model->id_admin]];
$this->params['breadcrumbs'][] = 'Обновить';
?>

<link rel="stylesheet" href="<?= Url::to('@web/css/admin.css') ?>">

<div class="admin-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>