<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Вход';
?>

<link href="<?= Url::to('@web/css/site.css') ?>" rel="stylesheet">
<link href="<?= Url::to('@web/css/site.index.css') ?>" rel="stylesheet">


<div class="user-form">
    <h2><?= Html::encode($this->title) ?></h2>
    <p class="text-left">Пожалуйста, заполните поля, чтобы авторизоваться:</p>

    <?php $form = ActiveForm::begin(); ?>

    <div class="mb-3">
        <?= $form->field($model, 'login')->textInput(['autofocus' => true, 'class' => 'form-control'])->label('Логин') ?>
    </div>

    <div class="mb-3">
        <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control'])->label('Пароль') ?>
    </div>

    <div class="mb-3 form-check">
        <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'form-check-input'])->label('Запомнить меня', ['class' => 'form-check-label']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Войти', ['class' => 'btn cta-button', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>