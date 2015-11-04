<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create Member', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php 
	$exportGridColumns = [
		['class' => 'yii\grid\SerialColumn'],
		'name',
		'dob',
		'gender',
		'address',
		'phone',
		'email:email',
		[
			'attribute'=>'country',
			'value'=>'countries.name',
		],
		[
			'attribute'=>'city',
			'value'=>'cities.name',
		],
		'status',
		['class' => 'yii\grid\ActionColumn'],
	];
	echo ExportMenu::widget([
	    'dataProvider' => $dataProvider,
	    'columns' => $exportGridColumns
	]);

	echo GridView::widget([
	    'dataProvider'=> $dataProvider,
	    'filterModel' => $searchModel,
	    'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'name',
			'gender',
			'phone',
			[
				'attribute'=>'country',
				'value'=>'countries.name',
			],
			[
				'attribute'=>'city',
				'value'=>'cities.name',
			],
			'email:email',
			'status',
			['class' => 'yii\grid\ActionColumn'],
		],
	    'pjax'=>true,
	    'responsive'=>true,
	    'hover'=>true
	]);
	?>

</div>
