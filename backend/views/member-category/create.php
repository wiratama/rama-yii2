<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MemberCategory */

$this->title = 'Create Member Category';
$this->params['breadcrumbs'][] = ['label' => 'Member Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
