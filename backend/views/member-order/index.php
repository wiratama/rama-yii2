<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MemberOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Member Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Member Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_order',
            // 'id_member',
            [
                'attribute'=>'id_member',
                'value'=>'idMember.name',
            ],
            'coupon_code',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
