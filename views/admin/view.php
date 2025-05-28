<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = 'Просмотр записи';
$this->params['breadcrumbs'][] = ['label' => 'Записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>
<link href="<?= Url::to('@web/css/site.css') ?>" rel="stylesheet">
<style>
    body {
        margin: 0;
        background-image: url('<?= Url::to('@web/assets/images/dark.jpg') ?>');
        background-size: cover;
        background-position: center;
        color: white; 
    }

    .ordder-view {
        max-width: 600px; 
        margin: 30px auto; 
        padding: 30px; 
        background-color: rgba(255, 255, 255, 0.1); 
        border-radius: 10px; 
    }

    h1 {
        text-align: center; 
        font-size: 2.5em; 
        margin-bottom: 20px; 
    }

    .detail-view {
        color: white; 
        font-size: 1.2em; 
    }

    .btn {
        display: flex; 
        justify-content: center; 
        align-items: center; 
        background-color: rgb(160, 114, 125); 
        color: white; 
        padding: 12px 25px; 
        border-radius: 10px; 
        text-decoration: none; 
        transition: background-color 0.3s; 
        margin: 20px 0; 
        width: 140px; 
        font-size: 16px; 
        text-align: center; 
    }

    .btn:hover {
        background-color: rgb(134, 95, 105); 
        color:white;
    }
</style>

<div class="ordder-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_order', 
            'status',
            'appointment_datetime:datetime',

        ],
        'options' => ['class' => 'detail-view'], 
    ]) ?>

    <div style="text-align: center;"> 
        <a href="<?= Url::to(['admin/orders']) ?>" class="btn">Назад</a> 
    </div>
</div>