<?php

use common\helpers\FileIconHelper;
use common\helpers\FileTypeHelper;
use common\models\constants\FileExtension;
use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;
use kartik\number\NumberControl;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\helpers\FileHelper;


/* @var $this yii\web\View */
/* @var $model common\models\Produk */
/* @var $form ActiveForm; */
/* @var $galeriModel common\models\GaleriProduk */
/* @var $negoModel common\models\Nego */
/* @var $dataGaleri [] */


?>


    <div class="produk-form">

        <?php $form = ActiveForm::begin(['id' => 'produk-form']); ?>

        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'kategori')->widget(
            \dosamigos\selectize\SelectizeTextInput::className(),
            [
                'loadUrl' => ['produk/kategori-list'],
                'options' => ['class' => 'form-control','required'=>true],
                'clientOptions' => [
                    'plugins' => ['remove_button'],
                    'valueField' => 'name',
                    'labelField' => 'name',
                    'searchField' => ['name'],
                ],
            ]
        )->hint('Use commas to separate tags') ?>
        <?= $form->field($model, 'deskripsi')->widget(TinyMce::class, []) ?>

        <?= $form->field($model, 'spesifikasi')->widget(TinyMce::class, []) ?>

        <?= $form->field($model, 'fitur')->widget(TinyMce::class, []) ?>

        <?= $form->field($model, 'harga')->widget(NumberControl::class, [
            'maskedInputOptions' => [
                'prefix' => 'Rp '
            ],

        ]) ?>
        <?= $form->field($model, 'nego')->checkbox() ?>

        <div class="nego d-none">
            <?= $form->field($negoModel, 'harga_satu')->widget(NumberControl::class, [
                'maskedInputOptions' => [
                    'prefix' => 'Rp '
                ]
            ]) ?>

            <?= $form->field($negoModel, 'harga_dua')->widget(NumberControl::class, [
                'maskedInputOptions' => [
                    'prefix' => 'Rp '
                ]
            ]) ?>

            <?= $form->field($negoModel, 'harga_tiga')->widget(NumberControl::class, [
                'maskedInputOptions' => [
                    'prefix' => 'Rp '
                ]
            ]) ?>
        </div>


        <?= $form->field($model, 'demo')->textInput() ?>



        <?php if (!$model->isNewRecord): ?>
            <div class="row">
                <div class="col-lg-12">
                    <h4>Manual</h4>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Berkas</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <?php
                                        $extensions = FileHelper::getExtensionsByMimeType(FileHelper::getMimeType(Yii::getAlias('@penjual/web/upload/produk/' . $model->manual)))[0];
                                        echo FileIconHelper::getIconByExtension($extensions) ?>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <?= Html::encode($model->manual) ?>

                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row pull-right">
                                    <div class="col-lg-12">
                                        <?php $type = FileTypeHelper::getType($extensions);
                                        if ($type === FileTypeHelper::TYPE_PDF):?>
                                            <?php Modal::begin([
                                                'title' => $model->manual,
                                                'toggleButton' => ['label' => '<i class="la la-eye"></i> &nbsp;Lihat', 'class' => 'btn btn-info btn-pill btn-elevate btn-elevate-air'],
                                                'size' => 'modal-lg',
                                                'clientOptions' => ['backdrop' => 'blur', 'keyboard' => true]
                                            ]);

                                            echo '<embed src="' . Yii::getAlias('@.produkPath') . '/' . $model->manual . '" type="application/pdf" height="100%" width="100%">
';
                                            ?>

                                            <?php Modal::end(); ?>
                                        <?php endif; ?>
                                        <?= Html::a('<i class ="la la-download"></i> Unduh', ['produk/download-manual', 'id' => $model->id], ['class' => 'btn btn-warning btn-pill btn-elevate btn-elevate-air']) ?>
                                        <?= Html::a('<i class ="la la-trash"></i> Hapus', ['produk/hapus-manual', 'id' => $model->id], ['class' => 'btn btn-danger btn-pill btn-elevate btn-elevate-air']) ?>
                                    </div>

                                </div>


                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <?= $form->field($model, 'manual')->widget(FileInput::class, [
                'pluginOptions' => [
                    'theme' => 'explorer-fas',
                    'allowedFileExtensions' => FileExtension::DOKUMEN,
                    'showUpload' => false,
                    'previewFileType' => 'any',
                    'fileActionSettings' => [
                        'showZoom' => true,
                        'showRemove' => false,
                        'showUpload' => false,
                    ],
                ]
            ]) ?>
        <?php endif; ?>
        <?= $form->field($galeriModel, 'nama_berkas[]')->widget(FileInput::class, [
            'options' => [
                'multiple' => true
            ],
            'pluginOptions' => [
                'allowedFileExtensions' => FileExtension::FOTO,
                'showUpload' => false,
                'previewFileType' => 'image',
                'fileActionSettings' => [
                    'showZoom' => true,
                    'showRemove' => false,
                    'showUpload' => false,
                ],
            ]
        ])->label('Galeri Produk')->hint('Ukuran maksimal 5MB, jpeg/png') ?>
        <?php if (!empty($dataGaleri)) :
            ?>

            <div class="row">
                <div class="col-lg-12">
                    <h4>Galeri Produk</h4>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Berkas</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($dataGaleri as $item) : ?>
                            <tr>
                                <td>
                                    <?= Html::img(Yii::getAlias('@.produkPath/' . $item->nama_berkas), ['width' => '30%']);
                                    ?>
                                </td>
                                <td>
                                    <div class="row pull-right">
                                        <div class="col-lg-12">

                                            <?= Html::a('<i class ="la la-download"></i> Unduh', ['produk/download-galeri', 'id' => $item->id], ['class' => 'btn btn-warning btn-pill btn-elevate btn-elevate-air']) ?>
                                            <?= Html::a('<i class ="la la-trash"></i> Hapus', ['produk/hapus-galeri', 'id' => $item->id], ['class' => 'btn btn-danger btn-pill btn-elevate btn-elevate-air']) ?>
                                        </div>

                                    </div>


                                </td>

                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php endif; ?>

        <div class="form-group">
            <?= Html::submitButton('<i class=\'la la-save\'></i> Simpan', ['class' => 'btn btn-pill btn-elevate btn-elevate-air btn-brand']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php $js = <<<JS
$(document).ready(function() {
   var checked = $('#produk-nego').prop('checked');
    if(checked){
       $('.nego').removeClass('d-none');
    }
    else{
        $('.nego').addClass('d-none');
    }
});
$('#produk-nego').on('change',function() {
    var checked = $('#produk-nego').prop('checked');
    if(checked){
       $('.nego').removeClass('d-none');
    }
    else{
        $('.nego').addClass('d-none');
    }
});
 $('form').on('beforeSubmit', function()
    {
        var form = $(this);
        //console.log('before submit');

        var submit = form.find(':submit');
        KTApp.block('.modal',{
            overlayColor: '#000000',
            type: 'v2',
            state: 'primary',
            message: 'Sedang Memproses...'
        });
        submit.html('<i class="flaticon2-refresh"></i> Sedang Memproses');
        submit.prop('disabled', true);

        KTApp.blockPage({
            overlayColor: '#000000',
            type: 'v2',
            state: 'primary',
            message: 'Sedang memproses...'
        });

    });

JS;

$this->registerJs($js);
?>