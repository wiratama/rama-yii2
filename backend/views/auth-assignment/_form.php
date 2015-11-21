<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\AuthItem;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">
<div class="col-md-6">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $authitems=AuthItem::find()->all();
    $listAuth=ArrayHelper::map($authitems,'name','name');
    ?>
    <?= $form->field($model, 'item_name')->dropDownList($listAuth, ['prompt'=>'Select...']);?>

    <?php
    $users=User::find()->all();
    $listUser=ArrayHelper::map($users,'id','username');
    ?>
    <?= $form->field($model, 'user_id')->dropDownList($listUser, ['prompt'=>'Select...']);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
