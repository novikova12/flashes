<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\FeedbackForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Обратная связь';
?>


<link href="<?= Url::to('@web/css/site.css') ?>" rel="stylesheet">
<link href="<?= Url::to('@web/css/site.index.css') ?>" rel="stylesheet">


<div class="feedback-form">
    <h2><?= Html::encode($this->title) ?></h2>
    <p class="feedback-intro">Пожалуйста, оставьте свой отзыв или жалобу:</p> 

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="mb-3">
        <label class="form-label">E-mail</label>
        <?= $form->field($model, 'email')->textInput(['type' => 'email', 'class' => 'form-control', 'placeholder'])->label(false) ?>
    </div>

    <div class="mb-3">
        <label class="form-label">Отзыв</label>
        <?= $form->field($model, 'message')->textarea(['rows' => 6, 'class' => 'form-control', 'placeholder'])->label(false) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn cta-button', 'name' => 'feedback-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>