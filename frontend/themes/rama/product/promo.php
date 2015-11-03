<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;
use yii\helpers\Url;

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
				<a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['product/claimpromo','id'=>$promo['id_product'],'page'=>$promo['page']]); ?>" class="btn btn-pink">CLAIM THIS PROMO</a>
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