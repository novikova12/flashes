<?php

use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Услуги';
$this->params['breadcrumbs'][] = $this->title;
?>
<link href="<?= Url::to('@web/css/site.css') ?>" rel="stylesheet">
<link href="<?= Url::to('@web/css/product.catalog.css') ?>" rel="stylesheet">
<div class="product-index">
    <h1 class="product-title"><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->can('createProduct')): ?> 
        <p class="text-right">
            <?= Html::a('Создать продукт', ['create'], ['class' => 'btn btn-danger']) ?>
        </p>
    <?php endif; ?>

    <div class="product-container">
        <?php foreach ($dataProvider->models as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="product-card">
                    <?php if (!empty($product->photo_product)): ?>
                        <img src="<?= Url::to('@web/' . $product->photo_product) ?>" class="product-image" alt="<?= Html::encode($product->name_product) ?>">
                    <?php endif; ?>
                    <h5 class="card-title"><?= Html::encode($product->name_product) ?></h5>
                    <p>Стоимость: <?= Html::encode($product->price) ?> Руб.</p>
                    <a href="<?= Url::to(['ordder/book', 'id_product' => $product->id_product]) ?>" class="btn btn-danger">Записаться</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>