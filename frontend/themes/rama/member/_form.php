<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Country;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;
use kartik\password\PasswordInput;
use kartik\file\FileInput;
use frontend\models\Category;
?>
<?php //echo Yii::$app->request->hostInfo.Yii::$app->homeUrl;?>
<div class="member-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'form-horizontal',
            'enctype' => 'multipart/form-data',
        ],
    ]); ?>

    <?php $field = $form->field($model, 'file_image'); echo $field->begin(); ?>
        <?= Html::activeLabel($model, 'file_image',['class'=>'col-sm-2 control-label']); ?>
        <div class="col-sm-10">
            <?= FileInput::widget([
                'model' => $model,
                'attribute' => 'file_image',
                'options' => [
                    'multiple' => false,
                    'accept' => 'image/*',
                ],
                'pluginOptions' => [
                    'initialPreview'=>(!empty($model->avatar) ? Html::img(Yii::$app->request->hostInfo.Yii::$app->request->baseUrl.$model->avatar,['width'=>'250px']) : false),
                    'showUpload' => false,
                ]
            ]); ?>
            <?= Html::error($model, 'file_image',['class'=>'help-block']); ?>
        </div>
    <?= $field->end() ?>

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
            <?php /*echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'dob',
                'template' => '{addon}{input}',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);*/?>
			<?php
			$fdate=['01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31'];
			$fmonth=['01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December'];
			$fyear=[1960=>1960,1961=>1961,1962=>1962,19263=>1963,1964=>1964,1965=>1965,1966=>1966,1967=>1967,1968=>1968,1969=>1969,1970=>1970,1971=>1971,1972=>1972,1973=>1973,1974=>1974,1975=>1975,1976=>1976,1977=>1977,1978=>1978,1979=>1979,1980=>1980,1981=>1981,1982=>1982,1983=>1983,1984=>1984,1985=>1985,1986=>1986,1987=>1987,1988=>1988,1989=>1989,1990=>1990,1991=>1991,1992=>1992,1993=>1993,1994=>1995,1995=>1995];
			?>
	        <div class="row">
		        <div class="col-sm-4">
		            <?= Html::activeDropDownList($model, 'dob[2]',$fdate,['class'=>'form-control','prompt'=>'Select...']); ?>
		        </div>
		        <div class="col-sm-4">
		            <?= Html::activeDropDownList($model, 'dob[1]',$fmonth,['class'=>'form-control','prompt'=>'Select...']); ?>
		        </div>
		        <div class="col-sm-4">
		            <?= Html::activeDropDownList($model, 'dob[0]',$fyear,['class'=>'form-control','prompt'=>'Select...']); ?>
		        </div>
	            <?= Html::error($model, 'dob',['class'=>'help-block']); ?>
	        </div>
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
    
    <?php $field = $form->field($model, 'id_category'); echo $field->begin(); ?>
        <?= Html::activeLabel($model, 'id_category',['class'=>'col-sm-2 control-label']); ?>
        <div class="col-sm-10">
            <?php
            $category=Category::find()->all();
            $listData=ArrayHelper::map($category,'id_category','category');
            ?>
            <?= Html::activeRadioList($model, 'id_category',$listData); ?>
            <?= Html::error($model, 'id_category',['class'=>'help-block']); ?>
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
            <a href="<?=Yii::$app->urlManager->createAbsoluteUrl('member/myaccount'); ?>" class="btn btn-pink">Cancel</a>
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