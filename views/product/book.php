<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Записаться на услугу';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="ordder-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'appointment_datetime')->textInput(['type' => 'datetime-local'])->label('Дата и время записи') ?>

    <div class="form-group">
        <?= Html::submitButton('Записаться', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>