<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Country;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;
use kartik\password\PasswordInput;
?>
<?php //echo Yii::$app->request->hostInfo.Yii::$app->homeUrl;?>
<div class="member-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'form-horizontal'
        ],
    ]); ?>

    <?php $field = $form->field($model, 'name'); echo $field->begin(); ?>
        <?= Html::activeLabel($model, 'name',['class'=>'col-sm-2 control-label']); ?>
        <div class="col-sm-10">
            <?= Html::activeTextInput($model, 'name',['class'=>'form-control','maxlength' => true]); ?>
            <?= Html::error($model, 'name',['class'=>'help-block']); ?>
        </div>
    <?= $field->end() ?>

    <?php $field = $form->field($model, 'email'); echo $field->begin(); ?>
        <?= Html::activeLabel($model, 'email',['class'=>'col-sm-2 control-label']); ?>
        <div class="col-sm-10">
            <?= Html::activeTextInput($model, 'email',['class'=>'form-control','maxlength' => true]); ?>
            <?= Html::error($model, 'email',['class'=>'help-block']); ?>
        </div>
    <?= $field->end() ?>

    <?php $field = $form->field($model, 'phone'); echo $field->begin(); ?>
        <?= Html::activeLabel($model, 'phone',['class'=>'col-sm-2 control-label']); ?>
        <div class="col-sm-10">
            <?= Html::activeTextInput($model, 'phone',['class'=>'form-control','maxlength' => true]); ?>
            <?= Html::error($model, 'phone',['class'=>'help-block']); ?>
        </div>
    <?= $field->end() ?>

    <?php $field = $form->field($model, 'gender'); echo $field->begin(); ?>
        <?= Html::activeLabel($model, 'gender',['class'=>'col-sm-2 control-label']); ?>
        <div class="col-sm-10">
            <?= Html::activeRadioList($model, 'gender',['Male'=>'Male','Female'=>'Female']); ?>
            <?= Html::error($model, 'gender',['class'=>'help-block']); ?>
        </div>
    <?= $field->end() ?>

    <?php $field = $form->field($model, 'dob'); echo $field->begin(); ?>
        <?= Html::activeLabel($model, 'dob',['class'=>'col-sm-2 control-label']); ?>
        <div class="col-sm-10">
            <?= DatePicker::widget([
                'model' => $model,
                'attribute' => 'dob',
                'template' => '{addon}{input}',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);?>
            <?= Html::error($model, 'dob',['class'=>'help-block']); ?>
        </div>
    <?= $field->end() ?>

    <?php $field = $form->field($model, 'address'); echo $field->begin(); ?>
        <?= Html::activeLabel($model, 'address',['class'=>'col-sm-2 control-label']); ?>
        <div class="col-sm-10">
            <?= Html::activeTextarea($model, 'address',['rows' => 6,'class'=>'form-control']); ?>
            <?= Html::error($model, 'address',['class'=>'help-block']); ?>
        </div>
    <?= $field->end() ?>

    <?php $field = $form->field($model, 'country'); echo $field->begin(); ?>
        <?= Html::activeLabel($model, 'country',['class'=>'col-sm-2 control-label']); ?>
        <div class="col-sm-10">
            <?php
            $countries=Country::find()->all();
            $listData=ArrayHelper::map($countries,'country_id','name');
            echo Html::activeDropDownList($model, 'country',$listData,['prompt'=>'Select...','class'=>'form-control']);
            ?>
            <?= Html::error($model, 'country',['class'=>'help-block']); ?>
        </div>
    <?= $field->end() ?>

    <?php $field = $form->field($model, 'city'); echo $field->begin(); ?>
        <?= Html::activeLabel($model, 'city',['class'=>'col-sm-2 control-label']); ?>
        <div class="col-sm-10">
            <?= Html::activeDropDownList($model, 'city',[],['prompt'=>'Select...','class'=>'form-control']); ?>
            <?= Html::error($model, 'city',['class'=>'help-block']); ?>
        </div>
    <?= $field->end() ?>

    <?php $field = $form->field($model, 'password'); echo $field->begin(); ?>
        <?= Html::activeLabel($model, 'password',['class'=>'col-sm-2 control-label']); ?>
        <div class="col-sm-10">
            <?php echo PasswordInput::widget(['model' => $model, 'attribute' => 'password'],['class'=>'form-control','maxlength' => true]);?>
            <?= Html::error($model, 'password',['class'=>'help-block']); ?>
        </div>
    <?= $field->end() ?>

    <?php $field = $form->field($model, 'password_repeat'); echo $field->begin(); ?>
        <?= Html::activeLabel($model, 'password_repeat',['class'=>'col-sm-2 control-label']); ?>
        <div class="col-sm-10">
            <?= Html::activePasswordInput($model, 'password_repeat',['class'=>'form-control','maxlength' => true]); ?>
            <?= Html::error($model, 'password_repeat',['class'=>'help-block']); ?>
        </div>
    <?= $field->end() ?>

    <?php $field = $form->field($model, 'reCaptcha'); echo $field->begin(); ?>
        <label class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
            <?= \himiklab\yii2\recaptcha\ReCaptcha::widget([
                'name' => 'reCaptcha',
                'siteKey' => '6Ld-mg8TAAAAAJPK3iJl1LYo8-Z6l7WSo82cTQPU',
                'widgetOptions' => ['class' => 'form-group col-sm-10']
            ]) ?>
        </div>
    <?= $field->end() ?>

    <div class="form-group">
        <label class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
            <?= Html::submitButton($model->isNewRecord ? 'Save Profile' : 'Update Profile', ['class' => 'btn btn-pink']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
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
                    html += '<option value=' + json[i]['zone_id'] + '>' + json[i]['name'] + '</option>';
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