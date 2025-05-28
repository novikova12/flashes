<?php
/* @var $this yii\web\View */
/* @var $product app\models\Product */

use yii\helpers\Html;

$this->title = 'Удаление товара';
?>
<div class="product-delete">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Товар успешно удалён.</p>

    <?= Html::a('Вернуться к списку товаров', ['admin/products'], ['class' => 'btn btn-primary']) ?>
</div>