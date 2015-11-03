<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MemberOrder */

$this->title = $model->id_order;
$this->params['breadcrumbs'][] = ['label' => 'Member Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_order], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_order], [
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
            'id_order',
            'idMember.name',
            'coupon_code',
            'created_at',
            'updated_at',
        ],
    ]) ?>
    <hr>
    Order Detail
    <table class="table table-striped table-bordered detail-view">
        <tbody>
            <tr>
                <th>Product</th>
                <th>Points</th>
                <th>Quantity</th>
            </tr>
            <?php foreach ($orders as $key => $order) { ?>
            <tr>
                <th><?=$order['name'];?></th>
                <th><?=$order['point'];?></th>
                <th><?=$order['quantity'];?></th>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
