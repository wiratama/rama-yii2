<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="<?= Yii::$app->charset ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= Html::csrfMetaTags() ?>
		<title><?= Html::encode($this->title) ?></title>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<?php $this->head() ?>
	</head>
	<body>
	<?php $this->beginBody() ?>
		<div class="container-fluid">
			<div class="row bg-darkpink">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-12 pull-left"><img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->homeUrl;?>images/logo.png" class="img-responsive logo"></div>
						<div class="col-md-8 col-sm-8 col-xs-12 text-right link header">
							<span>
								<a href="<?=Yii::$app->urlManager->createAbsoluteUrl('member/signup'); ?>">SIGN UP</a>
								</span>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<span>
								<a href="<?=Yii::$app->urlManager->createAbsoluteUrl('site/login'); ?>">LOGIN</a>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="row bg-pink">
				<div class="container">
					<div class="row">
						<nav class="navbar navbar-default navigation">
							<div class="container-fluid">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#grandistanaramamenu">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>
								<div class="collapse navbar-collapse" id="grandistanaramamenu">
									<ul class="nav navbar-nav navbar-right">
										<li class="link"><a href="index.php">HOME</a><hr class="menu-divider"></li>
										<li class="navigation-divider">|</li>
										<li class="link"><a href="memberbenefit.php">MEMBER BENEFIT</a><hr class="menu-divider"></li>
										<li class="navigation-divider">|</li>
										<li class="link"><a href="aboutus.php">ABOUT US</a><hr class="menu-divider"></li>
										<li class="navigation-divider">|</li>
										<li class="link"><a href="quotations.php">QUOTATIONS</a><hr class="menu-divider"></li>
										<li class="navigation-divider">|</li>
										<li class="link"><a href="contactus.php">CONTACT US</a></li>
									</ul>
								</div>
							</div>
						</nav>
					</div>
				</div>
			</div>
			<div class="row box-shadow">
				<div id="grandistanaramabanner" class="carousel slide carousel-fade" data-ride="carousel" data-interval="10000">
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->homeUrl;?>images/banner1.jpg" alt="">
						</div>
						<div class="item">
							<img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->homeUrl;?>images/banner2.jpg" alt="">
						</div>
						<div class="item">
							<img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->homeUrl;?>images/banner3.jpg" alt="">
						</div>
						<div class="item">
							<img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->homeUrl;?>images/banner4.jpg" alt="">
						</div>
						<div class="item">
							<img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->homeUrl;?>images/banner5.jpg" alt="">
						</div>
					</div>
					<a class="left carousel-control" href="#grandistanaramabanner" role="button" data-slide="prev">
						<span class="glyphicon" aria-hidden="true"><img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->homeUrl;?>images/previous.png" class="img-responsive"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#grandistanaramabanner" role="button" data-slide="next">
						<span class="glyphicon" aria-hidden="true"><img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->homeUrl;?>images/next.png" class="img-responsive"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
			<div class="row content">
				<div class="container">
					<?= Alert::widget() ?>
					<?= $content ?>
				</div>
			</div>
			<div class="row bg-pink">
				<div class="container">
					<div class="row footer">
						<div class="col-md-12">
							<div class="socmed">
								<a href=""><img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->homeUrl;?>images/fb.png"></a>
								<a href=""><img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->homeUrl;?>images/tw.png"></a>
								<a href=""><img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->homeUrl;?>images/ta.png"></a>
							</div>
						</div>
						<div class="col-md-12 line">
							<img src="<?php echo Yii::$app->request->hostInfo.Yii::$app->homeUrl;?>images/hrwhite.png" class="full center-block">
						</div>
						<div class="col-md-12">
							<div class="bottom-menu">
								<a href="">News</a>&nbsp;&nbsp;|&nbsp;&nbsp;
								<a href="">Careers</a>&nbsp;&nbsp;|&nbsp;&nbsp;
								<a href="">Testimonial</a>&nbsp;&nbsp;|&nbsp;&nbsp;
								<a href="">Sitemap</a>&nbsp;&nbsp;|&nbsp;&nbsp;
								<a href="">Awards</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center sticky-foot bg-white">
					&copy;2015 Grand Istana Rama . All rights reserved
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	<?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage() ?>