<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<link href="<?= Url::to('@web/css/category.css') ?>" rel="stylesheet">


<div class="category-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p style="text-align: center; margin: 20px 0;">
        <?= Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-danger']) ?>
    </p>

    <div class="order-table">
        <div class="order-row order-header">
            <div class="order-item">ID Категории</div>
            <div class="order-item">Название Категории</div>
            <div class="order-item action-column">Действия</div>
        </div>

        <div class="order-rows">
            <?php if (!empty($dataProvider->models)): ?>
                <?php foreach ($dataProvider->models as $category): ?>
                    <div class="order-row">
                        <div class="order-item" data-label="ID Категории"><?= Html::encode($category->id_category) ?></div>
                        <div class="order-item" data-label="Название Категории"><?= Html::encode($category->name_category) ?></div>
                        <div class="order-item action-column" data-label="Действия"> 
                            <div class="button-container">
                               
                                <?= Html::a('Редактировать', ['update', 'id_category' => $category->id_category], ['class' => 'btn btn-danger']) ?>
                                <?= Html::a('Удалить', ['delete', 'id_category' => $category->id_category], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => 'Вы уверены, что хотите удалить эту категорию?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="order-row">
                    <div class="order-item no-orders-message" colspan="3">У вас нет категорий</div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <nav aria-label="Page navigation">
        <div class="pagination-container">
            <?= LinkPager::widget([
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
</div>