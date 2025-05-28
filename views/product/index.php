<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
/** @var yii\web\View $this */
/** @var app\models\AdminSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


?>
<link href="<?= Url::to('@web/css/site.css') ?>" rel="stylesheet">
<link href="<?= Url::to('@web/css/product.css') ?>" rel="stylesheet">

<h1>Список услуг</h1>
<div class="text-center"> 
    <?= Html::a('Добавить услугу', ['create'], ['class' => 'btn btn-success']) ?>
</div>
<div class="product-table">
    <div class="product-row product-header">
        <div class="product-item">ID</div>
        <div class="product-item">Название</div>
        <div class="product-item">Действия</div>
    </div>
    <div class="product-rows">
        <?php foreach ($dataProvider->models as $product):  ?>
            <div class="product-row">
               
                <div class="product-item" data-label="ID:"><?= Html::encode($product->id_product) ?></div>
                
                <div class="product-item" data-label="Название:"><?= Html::encode($product->name_product) ?></div>
            
                <div class="product-item">
                    <div class="button-container">
                        <?= Html::a('Редактировать', ['update', 'id_product' => $product->id_product], ['class' => 'btn btn-edit']) ?>
                        <?= Html::a('Удалить', ['delete', 'id_product' => $product->id_product], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'method' => 'post',
                                'confirm' => 'Вы уверены, что хотите удалить эту услугу?',
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


</div>

<nav aria-label="Page navigation">
        <div class="pagination-container">
            <?= \yii\widgets\LinkPager::widget([
                'pagination' => $dataProvider->pagination, 
                'options' => ['class' => 'pagination'],
                'linkContainerOptions' => ['class' => 'page-item'],
                'linkOptions' => ['class' => 'page-link'],
                'prevPageLabel' => '«',
                'nextPageLabel' => '»',
                'disabledListItemSubTagOptions' => ['class' => 'page-link disabled'],
                'activePageCssClass' => 'active',
            ]); ?>
        </div>
    </nav>