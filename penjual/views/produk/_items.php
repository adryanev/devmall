<?php
/**
 * @var $model common\models\Produk
 */

use yii\bootstrap4\Html; 

?>

<div class="kt-pricing-1__visual">
    <div class="kt-pricing-1__hexagon1"></div>
    <div class="kt-pricing-1__hexagon2"></div>

    <?php if ($model->galeriProduks != NULL) {
?>
    <span class="kt-pricing-1__icon kt-font-brand"><?= Html::img(Yii::getAlias('@.produkPath/' . $model->galeriProduks[0]->nama_berkas), ['width' => '80%', 'height' => 120]) ?></span>
<?php
    } 
 ?>
</div>
<span class="kt-pricing-1__price"><?= \yii\helpers\StringHelper::mb_ucwords(Html::encode($model->nama)) ?></span>

<?php 

if (isset($model['diskon']['persentase'])) {

	$harga = $model->harga - ($model->harga * ($model['diskon']['persentase']/100));

?>
	<h2 class="kt-pricing-1__subtitle"><?= 'Diskon '.$model['diskon']['persentase'].'%' ?></h2>	
	<h2 class="kt-pricing-1__subtitle"><del><?= Yii::$app->formatter->asCurrency($model->harga) ?></del></h2>	
	<h2 class="kt-pricing-1__subtitle"> <b><?= Yii::$app->formatter->asCurrency($harga) ?></b> </h2>

<?php
}else{
?>
	<h2 class="kt-pricing-1__subtitle"><?= Yii::$app->formatter->asCurrency($model->harga) ?></h2>	
<?php
}
 ?>




<span class="kt-pricing-1__description">
													<?= \yii\helpers\StringHelper::truncate($model->deskripsi, '80', '...', 'UTF-8', true) ?>
												</span>
<div class="kt-pricing-1__btn">
    <?= Html::a('<i class="la la-eye"></i> Lihat', ['produk/view', 'id' => $model->id], ['class' => 'btn btn-brand btn-custom btn-pill btn-wide btn-uppercase btn-bolder btn-sm']) ?>
</div>
