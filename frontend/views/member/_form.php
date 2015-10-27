<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Country;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Member */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
$form = ActiveForm::begin([
    'options' => [
        'class' => 'form-horizontal'
    ]
]); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'gender')->radioList(array('Male'=>'Male','Female'=>'Female')); ?>
<?= $form->field($model, 'dob')->widget(
    DatePicker::className(), [
        'inline' => false, 
        // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
]);?>
<?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

<?php
$countries=Country::find()->all();
$listData=ArrayHelper::map($countries,'country_id','name');
echo $form->field($model, 'country')->dropDownList($listData, ['prompt'=>'Select...']);
?>
<?= $form->field($model, 'city')->dropDownList([], ['prompt'=>'Select...']) ?>
<?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
<?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?>
<?= \himiklab\yii2\recaptcha\ReCaptcha::widget([
    'name' => 'reCaptcha',
    'siteKey' => '6Ld-mg8TAAAAAJPK3iJl1LYo8-Z6l7WSo82cTQPU',
    'widgetOptions' => ['class' => 'form-group']
]) ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>

<?php
use yii\web\View;
$this->registerJs("
$('#member-country').on('change', function() {    
    var country = $('#member-country').val();
    $.ajax({
        url: '".Yii::$app->urlManager->createAbsoluteUrl('member/getcity')."',
        type: 'post',
        data: 'country=' + country,
        dataType: 'json',
        success: function(json) {
            html = '<option>Select...</option>';
            if (json && json!= '') {
                for (i = 0; i < json.length; i++) {
                    html += '<option value=' + json[i]['zone_id'] + '>' + json[i]['name'] + '</option>';
                }
            }
            $('select#member-city').html(html);
        },
    });
});", View::POS_END);
?>