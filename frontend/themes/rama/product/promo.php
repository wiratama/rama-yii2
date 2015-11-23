<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\web\View;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Member */

$this->title = 'Promo';
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<div class="col-md-12">
		<div class="header-content text-center">
			<h1>MEMBER BENEFITS</h1>
			<div class="icon-aboutus">
				<a href="#"><img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl();?>/images/iconroom.png"></a>
				<a href="#"><img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl();?>/images/iconrestaurant.png"></a>
				<a href="#"><img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl();?>/images/iconbar.png"></a>
				<a href="#"><img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl();?>/images/iconpool.png"></a>
			</div>
		</div>
	</div>
	<div class="col-md-12 text-center">
		<div class="benefit-line">
			<span class="link"><a href="<?=Yii::$app->urlManager->createAbsoluteUrl('product/promo'); ?>">PROMO</a>
			</span>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
			<span class="link"><a href="<?=Yii::$app->urlManager->createAbsoluteUrl('member/point'); ?>">MY POINT</a></span>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<h3 class="text-center">PROMO</h3>
		<?php foreach ($promos as $promo) { ?>
		<div class="row content">
			<div class="col-md-4 col-sm-4">
				<img src="<?php echo $promo['promo_image_url'];?>" class="img-responsive center-block img-rounded img-promo">
			</div>
			<div class="col-md-8 col-sm-8">
				<h4><?=$promo['name'];?></h4>
				<p class="text-justify">
					<?=$promo['description'];?>
				</p>
				<p class="text-justify">
					<span class="product-point"><?=$promo['point'];?> Points</span>
				</p>
				<a href="javascript:void(0)" class="btn btn-pink" onclick="claimPromo(<?php echo $promo['id_product'].",".$promo['page']?>);">CLAIM THIS PROMO</a>
				
				<div id="promo-modal<?=$promo['id_product'];?>" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-backdrop="false">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
								<h4 class="modal-title" id="mySmallModalLabel">CLAIM PROMO</h4>
							</div>
							<div class="modal-body">
								<?php $form = ActiveForm::begin([
									'options' => [
										'class' => 'form-horizontal',
									],
									'action' => ['product/claimpromo'],
								]); ?>
								<?= Html::hiddenInput('ClaimPromo[id]', $promo['id_product']); ?>
								<?= Html::hiddenInput('ClaimPromo[page]', $promo['page']); ?>
								<?php $field = $form->field($claimpromo, 'doc'); echo $field->begin(); ?>
							        <?= Html::activeLabel($claimpromo, 'doc',['class'=>'col-sm-3 control-label']); ?>
							        <div class="col-sm-9">
							            <?= DatePicker::widget([
							                'model' => $claimpromo,
							                'attribute' => 'doc',
							                'template' => '{addon}{input}',
							                'clientOptions' => [
							                    'autoclose' => true,
							                    'format' => 'yyyy-mm-dd'
							                ]
							            ]);?>
							            <?= Html::error($claimpromo, 'doc',['class'=>'help-block']); ?>
							        </div>
							    <?= $field->end() ?>
								<?php $field = $form->field($claimpromo, 'comment'); echo $field->begin(); ?>
							        <?= Html::activeLabel($claimpromo, 'comment',['class'=>'col-sm-3 control-label']); ?>
							        <div class="col-sm-9">
							            <?= Html::activeTextarea($claimpromo, 'comment',['rows' => 6,'class'=>'form-control']); ?>
							            <?= Html::error($claimpromo, 'comment',['class'=>'help-block']); ?>
							        </div>
							    <?= $field->end() ?>
								<div class="form-group">
							        <label class="col-sm-3 control-label">&nbsp;</label>
							        <div class="col-sm-9">
							            <?= Html::submitButton('Book', ['class' => 'btn btn-pink']) ?>
							        </div>
							    </div>
								<?php ActiveForm::end(); ?>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		<?php } ?>
	</div>
	<div class="col-md-12">
	<?=LinkPager::widget([
		'pagination' => $pages,
	]);
	?>
	</div>
</div>
<?php
$formname='"ClaimPromo[doc]"';
$this->registerJs("
function claimPromo(id,page) {
	$('#promo-modal'+id).modal('show');
};

$(document).ready(function () {
    var date = new Date();
    date.setDate(date.getDate());
    console.log(date);
    $('input[name=".$formname."]').parent().datepicker({ 
        startDate: date
    });
});
", View::POS_END);
?>