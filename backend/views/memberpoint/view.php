<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MemberPoint */

$this->title = $model->id_member_point;
$this->params['breadcrumbs'][] = ['label' => 'Member Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-point-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_member_point], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_member_point], [
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
            'id_member_point',
            'idMember.name',
            'created_at',
            'updated_at',
            'point',
            'status',
        ],
    ]) ?>

</div>
