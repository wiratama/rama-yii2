<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MemberCategory */

$this->title = 'Update Member Category: ' . ' ' . $model->id_category;
$this->params['breadcrumbs'][] = ['label' => 'Member Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_category, 'url' => ['view', 'id' => $model->id_category]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="member-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
