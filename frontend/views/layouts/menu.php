<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 17/09/19
 * Time: 19.48
 */

use common\widgets\MartplaceNav;
use frontend\models\forms\search\SearchProductForm;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

$items = [
    ['label' => 'Home', 'url' => ['/site/index']],
    ['label' => 'Produk', 'url' => ['/produk/index', 'kategori' => '']],
    ['label' => 'Booth', 'url' => ['/booth/index']],

];
$menuItems = $items;
?>

<div class="mainmenu">
    <!-- start .container -->
    <div class="container">
        <!-- start .row-->
        <div class="row">
            <!-- start .col-md-12 -->
            <div class="col-md-12">
                <div class="navbar-header">
                    <!-- start mainmenu__search -->
                    <div class="mainmenu__search">
                        <?php $form = ActiveForm::begin(['action' => ['produk/search'], 'method' => 'GET']); ?>
                        <div class="searc-wrap">
                            <?= /** @var SearchProductForm $searchModel */
                            $form->field($searchModel, 'product')->textInput(['placeholder' => 'Cari Produk', 'name' => 'produk'])->label(false) ?>
                            <?= Html::submitButton('<span class="lnr lnr-magnifier"></span>', ['class' => 'search-wrap__btn']) ?>
                        </div>
                        <?php ActiveForm::end() ?>
                    </div>
                    <!-- start mainmenu__search -->
                </div>

                <?php
                NavBar::begin([
                    'options' => [
                        'class' => 'navbar navbar-expand-md navbar-light mainmenu__menu'
                    ]
                ])
                ?>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <?= Nav::widget(
                    [
                        'options' => [
                            'class' => 'navbar-nav'
                        ],
                        'items' => $menuItems


                    ]
                ) ?>
                <!-- /.navbar-collapse -->
                <?php NavBar::end() ?>
            </div>
            <!-- end /.col-md-12 -->
        </div>
        <!-- end /.row-->
    </div>
    <!-- start .container -->
</div>
