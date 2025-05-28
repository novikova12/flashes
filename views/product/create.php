<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Product $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Создать услугу'; 
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<link href="<?= Url::to('@web/css/product.css') ?>" rel="stylesheet">


<div class="product-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="product-form">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'name_product')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'price')->textInput() ?>
        <?= $form->field($model, 'photo_product')->fileInput() ?> 
        <?= $form->field($model, 'category_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(\app\models\Category::find()->all(), 'id_category', 'name_category'), 
            ['prompt' => 'Выберите категорию']
        ) ?>

        <div class="form-group">
            <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>