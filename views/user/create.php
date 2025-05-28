<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $model */
use yii\helpers\Url;

$this->title = 'Регистрация';
?>

<div class="user-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
