<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\models\User;
use app\models\Product;
$this->title = 'Запись';
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$user = User::findOne($model->user_id);

\yii\web\YiiAsset::register($this);
?>
<link href="<?= Url::to('@web/css/site.css') ?>" rel="stylesheet">
<link href="<?= Url::to('@web/css/ordder.view.css') ?>" rel="stylesheet">

<div class="ordder-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
    'model' => $model, 
    'attributes' => [
        'status',
        'appointment_datetime:datetime',
        [
            'label' => 'Имя',
            'value' => $user ? $user->name : 'Нет данных',
            'labelOptions' => ['style' => 'padding-right: 10px;'],
        ],
        [
            'label' => 'Фамилия',
            'value' => $user ? $user->surname : 'Нет данных',
            'labelOptions' => ['style' => 'padding-right: 10px;'],
        ],
        [
            'label' => 'Логин',
            'value' => $user ? $user->login : 'Нет данных',
            'labelOptions' => ['style' => 'padding-right: 10px;'],
        ],
        [
            'label' => 'Название услуги',
            'value' => function ($model) {
                $product = $model->product; 
                return $product ? $product->name_product : 'Услуга не найдена';
            },
            'labelOptions' => ['style' => 'padding-right: 10px;'],
        ],
        [
            'label' => 'Цена услуги', 
            'value' => function ($model) {
                $product = $model->product; 
                return $product ? Yii::$app->formatter->asDecimal($product->price, 2) : 'Не указана'; 
            },
            'labelOptions' => ['style' => 'padding-right: 10px;'],
        ],
    ],
    'options' => ['class' => 'detail-view'],
]) ?>

    <div style="text-align: left;">
        <a href="javascript:void(0);" class="btn" id="backButton">Назад</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var backButton = document.getElementById('backButton');

        backButton.addEventListener('click', function() {
            var isAdmin = <?= Yii::$app->user->id == 1 ? 'true' : 'false'; ?>;
            if (isAdmin) {
                window.location.href = '<?= Url::to(['ordder/index']) ?>';
            } else {
                window.location.href = '<?= Url::to(['ordder/myorder']) ?>';
            }
        });
    });
</script>