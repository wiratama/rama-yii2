<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MemberOrder */

$this->title = 'Update Member Order: ' . ' ' . $model->id_order;
$this->params['breadcrumbs'][] = ['label' => 'Member Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_order, 'url' => ['view', 'id' => $model->id_order]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="member-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
