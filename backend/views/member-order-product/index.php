<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MemberOrderProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Member Order Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-order-product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Member Order Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_order_product',
            'id_order',
            'id_product',
            'quantity',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
