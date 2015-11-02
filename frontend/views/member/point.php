<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model frontend\models\Member */

$this->title = 'Member Poits';
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row content">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<h2 class="text-center">MY POINT</h2>
		<div class="col-md-12">
			<div class="col-md-6 col-sm-6 col-xs-6 full-col-xs point-space text-center">
				<div class="bg-yellow point point1">
					<h4>ACTIVE POINT</h4><span class="point-value"><?php echo $active_point; ?></span>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-6 full-col-xs point-space">
				<div class="bg-yellow point point2 point-info">
					<div class="form-group">
						<div class="col-md-8 col-sm-8 col-xs-8 no-info-padding">Used points</div>
						<div class="col-md-4 col-sm-4 col-xs-4"><?php echo $used_point; ?></div>
					</div>
					<br>
					<div class="form-group">
						<div class="col-md-8 col-sm-8 col-xs-8 no-info-padding">Points total</div>
						<div class="col-md-4 col-sm-4 col-xs-4"><?php echo $total_point; ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<hr class="history">
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-12 text-center">
			<div class="bg-white history-point">
				<h3 class="text-center history-title">HISTORY POINT</h3>
				<select class="form-control select-history more-space" id="point-filter">
					<option value="">Select</option>
					<option value="all">All</option>
					<option value="gained">Points gained</option>
					<option value="used">Used</option>
				</select>
				<div class="table-responsive">
					<table class="table table-bordered more-space table-point">
						<thead>
							<tr>
								<th class="text-center">NO.</th>
								<th class="text-center">DATE</th>
								<th class="text-center">POINT</th>
							</tr>
						</thead>
						<tbody id="all">
							<?php 
							$i=1;
							foreach ($points as $point) {?>
							<tr>
								<td><?= $i; ?></td>
								<td><?= $point->created_at; ?></td>
								<td><?= $point->point; ?></td>
							</tr>
							<?php $i++;} ?>
						</tbody>
						<tbody id="gained">
							<?php 
							$i=1;
							foreach ($points_active as $point_active) {?>
							<tr>
								<td><?= $i; ?></td>
								<td><?= $point_active->created_at; ?></td>
								<td><?= $point_active->point; ?></td>
							</tr>
							<?php $i++;} ?>
						</tbody>
						<tbody id="used">
							<?php 
							$i=1;
							foreach ($points_used as $point_used) {?>
							<tr>
								<td><?= $i; ?></td>
								<td><?= $point_used->created_at; ?></td>
								<td><?= $point_used->point; ?></td>
							</tr>
							<?php $i++;} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$this->registerJs("
$(document).ready(function() {
    var filter = $('#point-filter').val();
    if (filter=='') {
       $('#gained').hide();
       $('#used').hide();
       $('#all').show();
    }
});
$('#point-filter').on('change', function() {    
    var filter = $('#point-filter').val();
    if (filter=='all') {
   		$('#gained').hide();
    	$('#used').hide();
    	$('#all').show();
    } else if (filter=='gained'){
    	$('#used').hide();
    	$('#all').hide();
		$('#gained').show();
    } else if (filter=='used'){
		$('#gained').hide();
    	$('#all').hide();
    	$('#used').show();
    }
});", View::POS_END);
?>