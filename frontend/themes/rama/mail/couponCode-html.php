<?php
use yii\helpers\Html;
?>
<div class="password-reset">
    <p>Hello <?= Html::encode($user->name) ?>,</p>

    <p>Gave the following code to claim your promo:</p>

    <p><?=$coupon_code;?></p>
</div>
