<?php
use yii\helpers\Html;
?>
<div class="password-reset">
    <p>Hello <?= Html::encode($user->name) ?>,</p>

    <p>Gave the following code to claim your promo:<b><?=$coupon_code;?></b></p>
    <p>Please claim your promo on:<b><?=$doc;?></b></p>
    <p></p>
    <p>Thank You</p>
</div>
