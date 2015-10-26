<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MemberOrder */

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
            'id_member',
            'total',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
