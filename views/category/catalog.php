<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Category[] $categories */

$this->title = 'Услуги';
$this->params['breadcrumbs'][] = $this->title;
?>
<link href="<?= Url::to('@web/css/category.css') ?>" rel="stylesheet">


<div class="category-index">
    <h1 class="category-title"><?= Html::encode($this->title) ?></h1>
  
    <div class="category-container">
        <?php foreach ($categories as $category): ?>
            <div class='col-md-4 mb-4'> 
                <div class='category-card'>
                    <?php if (!empty($category->photo_category)): ?>
                        <img src="<?= Url::to('@web/assets/images/' . $category->photo_category) ?>" class="category-image" alt="<?= Html::encode($category->name_category) ?>">
                    <?php endif; ?>
                    <h5 class='card-title'><?= Html::encode($category->name_category) ?></h5>
                    <a href='<?= Url::to(['product/catalog', 'ProductSearch[category_id]' => $category->id_category]) ?>' class='btn btn-danger'>Перейти к услугам</a>
                </div>
            </div> 
        <?php endforeach; ?>
    </div>
</div>