<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MemberOrderProduct */

$this->title = $model->id_order_product;
$this->params['breadcrumbs'][] = ['label' => 'Member Order Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-order-product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_order_product], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_order_product], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_order_product',
            'id_order',
            'id_product',
            'quantity',
        ],
    ]) ?>

</div>
