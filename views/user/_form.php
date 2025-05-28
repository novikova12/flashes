<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */

?>

<link href="<?= Url::to('@web/css/site.css') ?>" rel="stylesheet">
<link href="<?= Url::to('@web/css/user.css') ?>" rel="stylesheet">
<div class="user-form">
    <h2>Регистрация</h2>  

    <?php $form = ActiveForm::begin(); ?>

    <div class="mb-3">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control'])->label('Имя') ?>
    </div>

    <div class="mb-3">
        <?= $form->field($model, 'surname')->textInput(['maxlength' => true, 'class' => 'form-control'])->label('Фамилия') ?>
    </div>

    <div class="mb-3">
        <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true, 'class' => 'form-control'])->label('Отчество') ?>
    </div>

    <div class="mb-3">
        <?= $form->field($model, 'login')->textInput(['maxlength' => true, 'class' => 'form-control'])->label('Логин') ?>
    </div>

    <div class="mb-3">
        <?= $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'class' => 'form-control'])->label('Email') ?>
    </div>

    <div class="mb-3">
        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'class' => 'form-control'])->label('Пароль') ?>
    </div>

    <div class="mb-3">
        <?= $form->field($model, 'confirm_password')->passwordInput(['class' => 'form-control'])->label('Подтверждение пароля') ?>
    </div>

    <div class="mb-3 form-check">
    <?= $form->field($model, 'agree')->checkbox() ?> 
    </div>

    <div class="form-group text-center">
    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn reg-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>