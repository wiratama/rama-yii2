<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MemberOrder */

$this->title = 'Create Member Order';
$this->params['breadcrumbs'][] = ['label' => 'Member Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
