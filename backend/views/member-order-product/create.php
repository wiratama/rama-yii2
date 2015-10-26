<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MemberOrderProduct */

$this->title = 'Create Member Order Product';
$this->params['breadcrumbs'][] = ['label' => 'Member Order Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-order-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
