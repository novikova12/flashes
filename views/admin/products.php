<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
/** @var yii\web\View $this */
/** @var app\models\AdminSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

// Отображение сообщений об успехе или ошибках
if (Yii::$app->session->hasFlash('success')) {
    echo '<div class="alert alert-success">' . Yii::$app->session->getFlash('success') . '</div>';
}
if (Yii::$app->session->hasFlash('error')) {
    echo '<div class="alert alert-danger">' . Yii::$app->session->getFlash('error') . '</div>';
}
?>

<style>
    body {
        margin: 0;
        background-image: url('<?= Url::to('@web/assets/images/dark.jpg') ?>');
        background-size: cover;
        background-position: center;
        color: white; /* Цвет текста на странице */
        font-family: Arial, sans-serif; /* Шрифт для всего документа */
    }

    h1 {
        text-align: center; /* Центрируем заголовок */
        font-size: 3em; /* Размер заголовка */
        margin: 30px 0; /* Отступ сверху и снизу */
    }

    .product-table {
        margin: 30px auto; /* Центрирование таблицы */
        max-width: 800px; /* Ограничение ширины таблицы */
        background-color: rgba(255, 255, 255, 0.1); /* Полупрозрачный фон для таблицы */
        border-radius: 10px; /* Закругленные углы для таблицы */
        overflow: hidden; /* Чтобы закругленные углы работали */
        padding: 20px; /* Отступ внутри таблицы */
    }

    .product-row {
        display: flex; /* Flex-контейнер для строк */
        justify-content: space-between; /* Распределение компонентов по строке */
        padding: 15px; /* Отступы для строк */
        border-bottom: 1px solid rgba(255, 255, 255, 0.2); /* Разделительная линия между строками */
        transition: background-color 0.3s; /* Плавный переход цвета фона */
    }

    .product-row:hover {
        background-color: rgba(255, 255, 255, 0.05); /* Изменение цвета фона при наведении */
    }

    .product-row:last-child {
        border-bottom: none; /* Убираем границу для последней строки */
    }

    .product-header {
        font-weight: bold; /* Жирный шрифт для заголовков */
        color: rgb(160, 214, 228); /* Цвет заголовков */
        flex: 1; /* Заголовки занимают равное пространство */
        text-align: center; /* Центрируем текст заголовков */
    }

    .product-item {
        flex: 1; /* Элементы занимают равное пространство */
        color: white; /* Цвет текста для элементов */
        text-align: center; /* Центрируем текст */
    }

    .button-container {
        display: flex; /* Flex-контейнер для кнопок */
        justify-content: flex-start; /* Левое выравнивание кнопок */
        align-items: center; /* Центрирование по вертикали */
    }

    .btn {
        display: inline-block; /* Корректное отображение кнопок */
        padding: 10px 20px; /* Отступы для кнопок */
        border-radius: 5px; /* Закругление углов для кнопок */
        color: white; /* Цвет текста на кнопках */
        text-decoration: none; /* Убираем подчеркивание */
        margin-right: 10px; /* Отступ между кнопками */
        transition: background-color 0.3s; /* Плавный переход цвета фона для кнопок */
    }

    .btn-success {
        background-color: rgb(160, 114, 125); ; /* Цвет кнопки добавления */
    }

    .btn-success:hover {
        background-color: rgb(134, 95, 105); /* Цвет при наведении */
        transform: scale(1.05); /* Увеличение контейнера при наведении */
    }

    .btn-danger {
        background-color: rgb(160, 114, 125); ; /* Цвет для кнопки удаления */
    }

    .btn-danger:hover {
        background-color: rgb(134, 95, 105); /* Цвет при наведении на кнопку удаления */
        transform: scale(1.05); /* Увеличение контейнера при наведении */
    }

    .btn-primary {
        background-color: rgb(160, 114, 125); ; /* Цвет для кнопки редактирования */
    }

    .btn-primary:hover {
        background-color: rgb(134, 95, 105); /* Цвет при наведении на кнопку редактирования */
        transform: scale(1.05); /* Увеличение контейнера при наведении */
    }
    .pagination-container {
        display: flex;
        justify-content: center; /* Центрирование пагинации на странице */
        margin: 20px 0; /* Отступы вокруг пагинации */
    }

    .pagination {
        padding: 0; /* Убираем внутренние отступы */
        list-style: none; /* Убираем стандартные маркеры у списка */
        display: flex; /* Дисплей Flex для горизонтального расположения элементов */
    }

    .page-item {
        margin: 0 5px; /* Установка отступов между элементами пагинации */
    }

    .page-link {
        display: inline-block; /* Каждый элемент должен занимать только нужное место */
        padding: 10px 15px; /* Внутренние отступы */
        color: white; /* Цвет текста */
        background-color: rgb(255, 255, 255); /* Цвет фона для страниц */
        border: 1px solid transparent; /* Убираем рамку по умолчанию */
        border-radius: 5px; /* Закругление углов */
        text-decoration: none; /* Убираем подчеркивание текста */
        transition: background-color 0.3s; /* Плавный переход для фона */
    }

    .page-link:hover {
        background-color: rgb(56, 142, 60); /* Цвет фона при наведении */
    }

    .page-item.active .page-link {
        background-color: rgb(160, 114, 125); /* Цвет фона для активной страницы */
        color: white; /* Цвет текста для активной страницы */
    }

    .page-link.disabled {
        background-color: rgba(160, 114, 125, 0.5); /* Цвет для отключенной ссылки */
        color: white; /* Цвет для отключенной ссылки */
        pointer-events: none; /* Отключаем события мыши */
    } 

</style>

<h1>Список услуг</h1>
<div class="text-center"> <!-- Добавляем класс для центрирования -->
    <?= Html::a('Добавить услугу', ['admin/create-product'], ['class' => 'btn btn-success']) ?>
</div>
<div class="product-table">
    <div class="product-row product-header">
        <div class="product-item">ID</div>
        <div class="product-item">Название</div>
        <div class="product-item">Действия</div>
    </div>
    <div class="product-rows">
        <?php foreach ($dataProvider->models as $product): // Используем данные из ActiveDataProvider ?>
            <div class="product-row">
                <div class="product-item"><?= Html::encode($product->id_product) ?></div>
                <div class="product-item"><?= Html::encode($product->name_product) ?></div>
                <div class="product-item">
                    <div class="button-container">
                        <?= Html::a('Редактировать', ['update-product', 'id_product' => $product->id_product], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Удалить', ['delete-product', 'id_product' => $product->id_product], [
                            'class' => 'btn btn-danger',
                            'data-method' => 'post',
                            'data-confirm' => 'Вы уверены, что хотите удалить эту услугу?',
                        ]) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <nav aria-label="Page navigation">
        <div class="pagination-container">
            <?= \yii\widgets\LinkPager::widget([
                'pagination' => $dataProvider->pagination, // Передаем пагинацию
                'options' => ['class' => 'pagination'],
                'linkContainerOptions' => ['class' => 'page-item'],
                'linkOptions' => ['class' => 'page-link'],
                'prevPageLabel' => '«',
                'nextPageLabel' => '»',
                'disabledListItemSubTagOptions' => ['class' => 'page-link disabled'],
                'activePageCssClass' => 'active',
            ]); ?>
        </div>
    </nav>
</div>

