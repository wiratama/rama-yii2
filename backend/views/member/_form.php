<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Country;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;
use kartik\password\PasswordInput;
use kartik\file\FileInput;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $model backend\models\Member */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-form">
<div class="col-md-6">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'gender')->radioList(['Male'=>'Male','Female'=>'Female']); ?>
    <?= $form->field($model, 'dob')->widget(
    DatePicker::className(), [
        'inline' => false, 
        // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);?>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?php echo $form->field($model, 'file_image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview'=>(!empty($model->avatar) ? Html::img(Yii::$app->request->hostInfo.Yii::$app->request->baseUrl."/..".$model->avatar,['width'=>'250px']) : false),
            'showUpload' => false,
        ]
    ]); ?>
    <?php
    $countries=Country::find()->all();
    $listData=ArrayHelper::map($countries,'country_id','name');
    ?>
    <?= $form->field($model, 'country')->dropDownList($listData, ['prompt'=>'Select...']);?>

    <?= $form->field($model, 'city')->dropDownList([], ['prompt'=>'Select...']); ?>
    <?= $form->field($model, 'password')->widget(PasswordInput::classname(), [
        'pluginOptions' => [
            'showMeter' => true,
            'toggleMask' => true
        ]
    ]); ?>
    <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->dropDownList([0=>'Blocked',1=>'Pending',2=>'Active'], ['prompt'=>'Select...']); ?>
    <?php
    $category=Category::find()->all();
    $listData=ArrayHelper::map($category,'id_category','category');
    ?>
    <?= $form->field($model, 'id_category')->radioList($listData);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
</div>


<?php
$null='';
use yii\web\View;
$this->registerJs("
$(document).ready(function() {
    var country = $('#member-country').val();
    if (country!='') {
       $.ajax({
        url: '".Yii::$app->urlManager->createAbsoluteUrl('member/getcity')."',
        type: 'post',
        data: 'country=' + country,
        dataType: 'json',
        success: function(json) {
            html = '<option value=".$null.">Select...</option>';
            if (json && json!= '') {
                for (i = 0; i < json.length; i++) {
                    html += '<option value=' + json[i]['zone_id'];
                    if (json[i]['zone_id'] == '".$model->city."') {
                        html += ' selected=selected';
                    }
                    html += '>' + json[i]['name'] + '</option>';
                }
            }
            $('select#member-city').html(html);
        },
    }); 
    }
});
$('#member-country').on('change', function() {    
    var country = $('#member-country').val();
    $.ajax({
        url: '".Yii::$app->urlManager->createAbsoluteUrl('member/getcity')."',
        type: 'post',
        data: 'country=' + country,
        dataType: 'json',
        success: function(json) {
            html = '<option value=".$null.">Select...</option>';
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