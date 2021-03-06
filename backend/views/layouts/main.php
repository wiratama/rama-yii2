<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Grand Istana Rama',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top navbar-rama',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => 'Privillage', 
            'items' => [
                ['label' => 'User', 'url' => ['/user/index']],
                ['label' => 'Role', 'url' => ['/auth-item/index']],
                ['label' => 'Role Child', 'url' => ['/auth-item-child/index']],
                ['label' => 'Role Assignment', 'url' => ['/auth-assignment/index']],
            ]
        ];
        $menuItems[] = ['label' => 'Customers', 
            'items' => [
                ['label' => 'Member', 'url' => ['/member/index']],
                ['label' => 'Member Point', 'url' => ['/memberpoint/index']],
            ]
        ];
        $menuItems[] = ['label' => 'Sales', 
            'items' => [
                ['label' => 'Product', 'url' => ['/product/index']],
                ['label' => 'Order', 'url' => ['/member-order/index']],
            ]
        ];
        $menuItems[] = ['label' => 'Settings', 
            'items' => [
                ['label' => 'Category', 'url' => ['/category/index']],
            ]
        ];
        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
