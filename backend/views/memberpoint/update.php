<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MemberPoint */

$this->title = 'Update Member Point: ' . ' ' . $model->id_member_point;
$this->params['breadcrumbs'][] = ['label' => 'Member Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_member_point, 'url' => ['view', 'id' => $model->id_member_point]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="member-point-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
