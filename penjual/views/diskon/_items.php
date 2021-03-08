<?php
/**
 * @var $model common\models\Produk
 */

use yii\bootstrap4\Html; 


$harga = $model['produk']['harga'] - ($model['produk']['harga']*($model->persentase/100));

?>

<div class="kt-pricing-1__visual">
    <div class="kt-pricing-1__hexagon1"></div>
    <div class="kt-pricing-1__hexagon2"></div>



    <?php

           $query= (new \yii\db\Query())
                    ->select('*')
                    ->from('produk')
                    ->leftJoin('galeri_produk', 'galeri_produk.id_produk = produk.id')
                    ->where('produk.id='.$model['id_produk'])
                    ->all();

			$dataProduk = $query;

     if ($dataProduk[0]['nama_berkas'] != NULL) {
?>
    <span class="kt-pricing-1__icon kt-font-brand"><?= Html::img(Yii::getAlias('@.produkPath/' . $dataProduk[0]['nama_berkas']), ['width' => '80%', 'height' => 120]) ?></span>
<?php
    } 
 ?>
</div>
<span class="kt-pricing-1__price"><?= \yii\helpers\StringHelper::mb_ucwords(Html::encode($dataProduk[0]['nama'])) ?></span>


    <h2 class="kt-pricing-1__subtitle"><del><?= Yii::$app->formatter->asCurrency($model['produk']['harga']) ?></del></h2>   

    <h2 class="kt-pricing-1__subtitle"><?= 'Diskon : '.$model->persentase.'%' ?></h2>

    <h2 class="kt-pricing-1__subtitle"> <b><?= Yii::$app->formatter->asCurrency($harga) ?></b> </h2>

<span class="kt-pricing-1__description">
												</span>
<div class="kt-pricing-1__btn">
    <?= Html::a('<i class="la la-eye"></i> Lihat', ['diskon/view', 'id' => $model->id], ['class' => 'btn btn-brand btn-custom btn-pill btn-wide btn-uppercase btn-bolder btn-sm']) ?>
</div>
