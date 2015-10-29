<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Member;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\MemberPoint */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-point-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $member=Member::find()->all();
	$listData=ArrayHelper::map($member,'id_member','name');
	echo $form->field($model, 'id_member')->dropDownList($listData, ['prompt'=>'Select...']);
    ?>
    <?= $form->field($model, 'point')->textInput() ?>
    <?= $form->field($model, 'status')->dropDownList([1=>'Increase',2=>'Decrease'], ['prompt'=>'Select...']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
