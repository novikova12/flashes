<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;


AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
$controllerId = Yii::$app->controller ? Yii::$app->controller->id : '';
$actionId = Yii::$app->controller && Yii::$app->controller->action ? Yii::$app->controller->action->id : '';

$bodyClass = $actionId;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Html::encode($this->title) ?></title>
    <link href="<?= Url::to('@web/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= Url::to('@web/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?= Url::to('@web/css/styles.css') ?>" rel="stylesheet">
    <link href="<?= Url::to('@web/css/main1.css') ?>" rel="stylesheet">
    <script src="<?= Url::to('@web/js/custom.js') ?>" defer></script>


</head>

<body class="<?= Html::encode($bodyClass) ?>">
    <header id="header">
        <nav id="main-nav" class="navbar navbar-default navbar-fixed-top" role="banner">

        <div class="container">
            <div class="navbar-header">
                <?= Html::a(Html::img(Url::to('@web/assets/images/logo.jpg'), ['width' => '77', 'height' => '77']), ['/site/index']) ?>
                <button class="hamburger hamburger--spin" type="button" aria-label="Меню" aria-controls="navigation">
  <span class="hamburger-box">
    <span class="hamburger-inner"></span>
  </span>
</button>
            </div>

           
            <div id="mobile-menu" class="main-nav-links">
                <ul class="nav navbar-nav navbar-right">
                    <?php if (Yii::$app->user->isGuest): ?>
                       
                        <li class="scroll <?= Yii::$app->controller->action->id === 'index' ? 'active' : '' ?>">
                            <?= Html::a('Главная', ['/site/index']) ?>
                        </li>
                        <li class="scroll <?= Yii::$app->controller->action->id === 'catalog' ? 'active' : '' ?>">
                            <?= Html::a('Услуги', ['/category/catalog']) ?>
                        </li>
                        <li class="scroll <?= Yii::$app->controller->action->id === 'about' ? 'active' : '' ?>">
                            <?= Html::a('О нас', ['/site/about']) ?>
                        </li>
                        <li class="scroll <?= Yii::$app->controller->action->id === 'feedback' ? 'active' : '' ?>">
                            <?= Html::a('Обратная связь', ['/site/feedback']) ?>
                        </li>
                        <li class="scroll <?= Yii::$app->controller->action->id === 'contact' ? 'active' : '' ?>">
                            <?= Html::a('Контакты', ['/site/contact']) ?>
                        </li>
                        <li class="scroll <?= Yii::$app->controller->action->id === 'login' ? 'active' : '' ?>">
                            <?= Html::a('Вход', ['/site/login']) ?>
                        </li>
                        <li class="scroll <?= Yii::$app->controller->action->id === 'create' ? 'active' : '' ?>">
                            <?= Html::a('Регистрация', ['/user/create']) ?>
                        </li>
                    <?php else: ?>
                      
                        <?php if (Yii::$app->user->identity->isAdmin()): ?>
                            <li class="scroll <?= Yii::$app->controller->action->id === 'admin' ? 'active' : '' ?>">
                                <?= Html::a('Панель администратора', ['/admin/index']) ?>
                            </li>
                        <?php else: ?>
                            
                            <li class="scroll <?= Yii::$app->controller->action->id === 'index' ? 'active' : '' ?>">
                                <?= Html::a('Главная', ['/site/index']) ?>
                            </li>
                            <li class="scroll <?= Yii::$app->controller->action->id === 'catalog' ? 'active' : '' ?>">
                                <?= Html::a('Услуги', ['/category/catalog']) ?>
                            </li>
                            <li class="scroll <?= Yii::$app->controller->action->id === 'myorder' ? 'active' : '' ?>">
                                <?= Html::a('Записи', ['/ordder/myorder']) ?>
                            </li>

                            <li class="scroll <?= Yii::$app->controller->action->id === 'feedback' ? 'active' : '' ?>">
                                <?= Html::a('Обратная связь', ['/site/feedback']) ?>
                            </li>
                            <li class="scroll <?= Yii::$app->controller->action->id === 'contact' ? 'active' : '' ?>">
                                <?= Html::a('Контакты', ['/site/contact']) ?>
                            </li>
                        <?php endif; ?>

                       
                        <li class="scroll">
                            <span style="color: black;">Вы вошли как: <?= Html::encode(Yii::$app->user->identity->login) ?></span>
                        </li>

                        <li class="scroll">
                            <form action="<?= Url::to(['/site/logout']) ?>" method="post" style="display: inline;">
                                <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
                                <button type="submit" class="logout-button nav-link">Выйти</button>
                            </form>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        </nav>
    </header>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
        <?php
$flashes = Yii::$app->session->getAllFlashes();
foreach ($flashes as $type => $message):
    switch ($type) {
        case 'success':
            $class = 'alert alert-success';
            break;
        case 'error':
            $class = 'alert alert-danger';
            break;
        case 'info':
            $class = 'alert alert-info';
            break;
        case 'warning':
            $class = 'alert alert-warning';
            break;
        default:
            $class = 'alert alert-secondary';
    }
?>
<div class="<?= $class ?> alert-dismissible fade show" role="alert" style="margin-top:20px;">
    <?= htmlspecialchars($message) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endforeach; ?>
            <?= $content ?>
        </div>
    </main>

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 text-center">
                    <p>Салон красоты Flashes</p>
                    <p>Адрес: ул. Серпуховская, 5, Санкт-Петербург</p>
                </div>
                <div class="col-sm-6 text-center">
                    <p>Телефон: +7 (999) 123-45-67</p>
                    <p>Мы работаем: Пн-Пт с 9:00 до 21:00</p>
                </div>
            </div>
        </div>
    </footer>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>