<?php

/** @var yii\web\View $this */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'О нас';
?>

<link href="<?= Url::to('@web/css/site.index.css') ?>" rel="stylesheet">

<div id="about">
    <div class="about-section">
        <div class="text-center">
            <h1><?= Html::encode($this->title) ?></h1>
            <h3>Добро пожаловать в наш салон красоты!</h3>
            <p>Мы предлагаем широкий спектр услуг для вашей красоты и ухода. Каждая процедура — это шаг к вашему идеальному образу.</p>
        </div>
        
        <div class="list-and-image-container"> 
            <div class="list-container">
                <img class="img-responsive" src="<?= Url::to('@web/assets/images/салон.jpg') ?>" alt="Наш Салон"> 
                <ul class="listarrow">
                    <li>Стрижки</li>
                    <li>Маникюр</li>
                    <li>Окрашивание волос</li>
                    <li>Прически</li>
                    <li>Уход за телом</li>
                    <li>Уход за лицом</li>
                    <li>Макияж</li>
                    <li>Брови</li>
                    <li>Ресницы</li>
                </ul>
            </div>
        </div>
    

    <div class="text-center advantages">
        <h3>Нас выбирают, потому что у нас:</h3>
        <div class="advantages-list">
            <div class="advantage-item">
                <span class="advantage-number">1</span>
                <p class="advantage-description">Опытные и квалифицированные специалисты, которые всегда находятся в курсе новых тенденций и технологий в области красоты. Мы регулярно обновляем свои навыки, чтобы гарантировать лучший сервис.</p>
            </div>
            <div class="advantage-item">
                <span class="advantage-number">2</span>
                <p class="advantage-description">Профессиональный подход к каждой процедуре, который гарантирует наилучший результат и полное удовлетворение клиентов. Мы стараемся превзойти ваши ожидания!</p>
            </div>
            <div class="advantage-item">
                <span class="advantage-number">3</span>
                <p class="advantage-description">В арсенале не только парикмахерские услуги, но и широкий спектр косметологических процедур, включая аппаратные технологии, массажи различных видов и расслабляющие SPA-процедуры.</p>
            </div>
            <div class="advantage-item">
                <span class="advantage-number">4</span>
                <p class="advantage-description">Уникальные и индивидуальные программы, которые позволяют клиентам выбрать наиболее подходящую для себя процедуру и получить максимум пользы. Мы заботимся о ваших потребностях и желаниях!</p>
            </div>
        </div>
    </div>
    </div>
</div>