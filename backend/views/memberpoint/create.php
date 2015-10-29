<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MemberPoint */

$this->title = 'Create Member Point';
$this->params['breadcrumbs'][] = ['label' => 'Member Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-point-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
