<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = $model->name_product; 
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>

<link href="<?= Url::to('@web/css/product.css') ?>" rel="stylesheet">


<div class="product-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="product-image" style="margin-bottom: 20px;"> 
        <?= Html::img("https://dp-novikova.xn--80ahdri7a.site/{$model->photo_product}", [
            'alt' => Html::encode($model->name_product),
            'class' => 'img-responsive',
            'style' => ' height: 100%; text-align:center;' ,
        ]) ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_product',
            'name_product',
            [
                'attribute' => 'price',
                'format' => ['decimal', 2], 
            ],
            [
                'attribute' => 'category_id',
                'value' => function($model) {
                    return $model->category ? $model->category->name_category : 'Не указана'; 
                },
            ],
        ],
        'options' => ['class' => 'detail-view'], 
    ]) ?>
</div>