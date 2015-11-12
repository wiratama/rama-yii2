<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Member */

$this->title = 'Sign Up';
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<div class="col-md-12">
		<div class="header-content text-center">
			<h1>MEMBER SIGNUP</h1>
			<div class="icon-aboutus">
				<a href="#"><img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl();?>/images/iconroom.png"></a>
				<a href="#"><img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl();?>/images/iconrestaurant.png"></a>
				<a href="#"><img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl();?>/images/iconbar.png"></a>
				<a href="#"><img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl();?>/images/iconpool.png"></a>
			</div>
		</div>
	</div>
	<div class="col-md-12 text-center">
		<div class="benefit-line">&nbsp;</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 form-member-profile">
		<h2 class="text-center"><?= Html::encode($this->title) ?></h2>
		<?= $this->render('_form', [
			'model' => $model,
			// 'model2' => $model2,
		]) ?>
	</div>
</div>