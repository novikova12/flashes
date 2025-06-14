<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Ordder $model */

$this->title = 'Update Ordder: ' . $model->id_order;
$this->params['breadcrumbs'][] = ['label' => 'Ordders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_order, 'url' => ['view', 'id_order' => $model->id_order]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ordder-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
