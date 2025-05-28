<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager; 

$this->title = 'Записи';
?>

<link href="<?= Url::to('@web/css/ordder.css') ?>" rel="stylesheet">

<div class="ordder-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="order-table">
        <div class="order-row order-header">
            <div class="order-item">ID Записи</div>
            <div class="order-item">Статус</div>
            <div class="order-item">Дата создания</div>
            <div class="order-item action-column">Действия</div>
        </div>

        <div class="order-rows">
            <?php if (!empty($dataProvider->models)): ?>
                <?php foreach ($dataProvider->models as $order): ?>
                    <div class="order-row">
                       
                        <div class="order-item" data-label="ID Записи"><?= Html::encode($order->id_order) ?></div>
                        <div class="order-item" data-label="Статус"><?= Html::encode($order->status) ?></div>
                        <div class="order-item" data-label="Дата создания"><?= Html::encode($order->created_at) ?></div>
                        <div class="order-item action-column" data-label="Действия"> 
                            <div class="button-container">
                                <?= Html::a('Просмотреть', ['view', 'id_order' => $order->id_order], ['class' => 'btn btn-danger']) ?>
                                <?php if ($order->status === 'Новый'): ?>
                                    <?= Html::a('Подтвердить', ['confirm', 'id_order' => $order->id_order], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => 'Вы уверены, что хотите подтвердить эту запись?',
                                        'method' => 'post', 
                                    ],
                                ]) ?>
                         
                                <?php endif; ?>
                                <?php if ($order->status !== 'Отменен'): ?>
                                    <?= Html::a('Отменить', ['cancel', 'id_order' => $order->id_order], [
                                        'class' => 'btn btn-danger',
                                        'data' => [
                                            'confirm' => 'Вы уверены, что хотите отменить эту запись?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="order-row">
                    
                    <div class="order-item no-orders-message" colspan="4">У вас нет записей</div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Пагинация -->
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