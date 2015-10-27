<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Member */

$this->title = 'Sign Up';
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-create">

    <h3 class="text-center"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>