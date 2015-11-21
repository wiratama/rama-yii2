<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\AuthItem;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItemChild */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-child-form">
<div class="col-md-6">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $authitems=AuthItem::find()->all();
    $listAuth=ArrayHelper::map($authitems,'name','name');
    ?>
    <?= $form->field($model, 'parent')->dropDownList($listAuth, ['prompt'=>'Select...']);?>
    <?= $form->field($model, 'child')->dropDownList($listAuth, ['prompt'=>'Select...']);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
