<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?php
    $category=Category::find()->all();
    $listData=ArrayHelper::map($category,'id_category','category');
    ?>
    <?= $form->field($model2, 'id_category')->checkboxList($listData, ['prompt'=>'Select...']);?>
    <?= $form->field($model, 'price')->textInput() ?>
    <?= $form->field($model, 'point')->textInput() ?>
    <?php echo $form->field($model, 'file_image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview'=>(!empty($model->image) ? Html::img(Yii::$app->request->hostInfo.Yii::$app->request->baseUrl."/..".$model->image,['width'=>'250px']) : false),
            'showUpload' => false,
        ]
    ]); ?>
    <?php //echo $form->field($model, 'file_image')->fileInput() ?>
    <?= $form->field($model, 'status')->dropDownList([1=>'Promo',2=>'Regular',3=>'Disable'], ['prompt'=>'Select...']);?>
    <?= $form->field($model, 'start_date')->widget(
    DatePicker::className(), [
        'inline' => false, 
        // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);?>
    <?= $form->field($model, 'end_date')->widget(
    DatePicker::className(), [
        'inline' => false, 
        // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
