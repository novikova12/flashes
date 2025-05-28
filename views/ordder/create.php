<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ordder */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Создать запись';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="ordder-create">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'appointment_datetime')->textInput() ?>
    <?= $form->field($model, 'status')->textInput() ?>
    <?= $form->field($model, 'user_id')->hiddenInput()->label(false) ?> 

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>