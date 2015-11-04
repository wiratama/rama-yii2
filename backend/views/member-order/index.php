<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

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
        <?php //echo Html::a('Create Member Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php 
    $exportGridColumns = [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute'=>'id_member',
            'value'=>'idMember.name',
        ],
        'coupon_code',
        [
            'attribute'=>'product',
            'value'=>'orderProducts.idProduct.name',
        ],
        'created_at',
        'updated_at',

        ['class' => 'yii\grid\ActionColumn'],
    ];
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $exportGridColumns
    ]);

    echo GridView::widget([
        'dataProvider'=> $dataProvider,
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
            [
                'attribute'=>'product',
                'value'=>'orderProducts.idProduct.name',
            ],
            'created_at',
            'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'pjax'=>true,
        'responsive'=>true,
        'hover'=>true
    ]);
    ?>

</div>
