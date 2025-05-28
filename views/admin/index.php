<?php 
/* @var $this yii\web\View */ 
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Панель администратора'; 
?>

<link href="<?= Url::to('@web/css/admin.css') ?>" rel="stylesheet">

<div class="admin-background">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="admin-links">
        <p>
            <?= Html::a('Управление услугами', ['/product/index'], ['class' => 'btn-primary']) ?>
        </p>
        <p>
            <?= Html::a('Управление записями', ['/ordder/index'], ['class' => 'btn-primary']) ?>
        </p>
        <p>
            <?= Html::a('Управление категориями', ['/category/index'], ['class' => 'btn-primary']) ?>
        </p>
    </div>
</div>