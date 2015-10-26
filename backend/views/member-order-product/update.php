<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MemberOrderProduct */

$this->title = 'Update Member Order Product: ' . ' ' . $model->id_order_product;
$this->params['breadcrumbs'][] = ['label' => 'Member Order Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_order_product, 'url' => ['view', 'id' => $model->id_order_product]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="member-order-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
