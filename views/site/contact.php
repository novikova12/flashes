<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Контакты';

?>


<link href="<?= Url::to('@web/css/site.css') ?>" rel="stylesheet">
<link href="<?= Url::to('@web/css/site.index.css') ?>" rel="stylesheet">



<div class="contact-info">
    <h2><?= Html::encode($this->title) ?></h2>
    <p>Адрес: ул. Серпуховская, 5, Санкт-Петербург</p>
    <p>Телефон: +7 (999) 123-45-67</p>
    <p>Электронная почта: flashes@mail.ru</p>

   
    <img src="<?= Url::to('@web/assets/images/map.png') ?>" id="map" alt="Карта" />

</div>