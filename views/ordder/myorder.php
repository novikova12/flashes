<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $orders app\models\Ordder[] */

$this->title = 'Записи';
?>

<link href="<?= Url::to('@web/css/site.css') ?>" rel="stylesheet">
<link href="<?= Url::to('@web/css/ordder.myorder.css') ?>" rel="stylesheet">

<h1><?= Html::encode($this->title) ?></h1>

<div class="order-table">
    <div class="order-row order-header">
        <div class="order-item">Услуга</div> 
        <div class="order-item">Время посещения</div>
        <div class="order-item">Статус</div>
        <div class="order-item">Действия</div>
    </div>
    <div class="order-rows">
        <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $order): ?>
                <div class="order-row">
                    <div class="order-item">
                        <?php
                            if ($order->product !== null) {
                                echo Html::encode($order->product->name_product); 
                            } else {
                                echo 'Услуга не найдена'; 
                            }
                        ?>
                    </div> 
                    <div class="order-item"><?= Html::encode($order->appointment_datetime) ?></div>
                    <div class="order-item"><?= Html::encode($order->status) ?></div>
                    <div class="order-item">
                        <div class="button-container">
                            <?= Html::a('Просмотреть', ['view', 'id_order' => $order->id_order], ['class' => 'btn btn-danger']) ?>
                            <?php if ($order->status !== 'Отменен' && $order->status !== 'Выполнен'): ?>
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