<?php

/** @var yii\web\View $this */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Flashes';
?>

<link href="<?= Url::to('@web/css/site.css') ?>" rel="stylesheet">
<link href="<?= Url::to('@web/css/site.index.css') ?>" rel="stylesheet">


<div id="banner" class="banner">
    <div class="banner-image"></div>
    <div class="banner-caption">
        <div class="container">
            <div class="row">
                <div class="caption-data" data-animation-effect="fadeIn">
                    <h1>Время для вас!</h1> 
                    <h3 class="padding-top40">Преобразите себя в нашем салоне красоты,<br/> где внимание уделяется каждой детали!</h3> 
                    <h4 class="padding-top10">От модных причесок до стильного дизайна ногтей</h4> 
                    <div class="padding-top60 contact-form">
                    <?= Html::a('Выбрать услугу', ['/category/catalog'], ['class' => 'btn cta-button']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>