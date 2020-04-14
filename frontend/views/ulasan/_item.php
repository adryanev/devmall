<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/10/2019
 * Time: 8:22 PM
 */

use Carbon\Carbon;
use yii\bootstrap4\Html;

/**
 * @var $model common\models\Ulasan
 */


?>

<li class="single-thread">
    <div class="media">
        <div class="media-left">
            <?= Html::a(Html::img('@.frontend/images/profil/' . $model->user->profilUser->avatar, ['class' => 'media-object', 'alt' => 'Avatar Komentator']), '#') ?>
        </div>
        <div class="media-body">
            <div class="clearfix">
                <div class="pull-left">
                    <div class="media-heading">
                        <?= Html::a('<h4>' . $model->user->profilUser->namaLengkap . '</h4>', '#') ?>
                        <span><?= Carbon::createFromTimestamp($model->created_at)->diffForHumans() ?></span>
                    </div>
                    <?= \kartik\rating\StarRating::widget([
                        'name' => 'rating_produk_' . $model->id,
                        'value' => $model->nilai,
                        'pluginOptions' => [
                            'displayOnly' => true,
                            'theme' => 'krajee-fas',
                            'size' => 'xs'
                        ]
                    ]) ?>
                </div>
            </div>
            <?= $model->komentar ?>
        </div>
    </div>

</li>
<!-- end single comment thread /.comment-->
