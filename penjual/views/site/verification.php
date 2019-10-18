<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 15/10/19
 * Time: 20.51
 */

use borales\extensions\phoneInput\PhoneInput;
use common\models\constants\FileExtension;
use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;
use kolyunya\yii2\widgets\MapInputWidget;
use penjual\models\forms\PenjualSignupForm;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model PenjualSignupForm */

$this->title = 'Pembuatan Booth';
$this->params['breadcrumbs'][] = $this->title;

?>
    <!--begin::Portlet-->
<?php $form = ActiveForm::begin(['id' => 'pembuatan-booth-form', 'layout' => 'horizontal', 'fieldConfig' => [
    'horizontalCssClasses' => [
        'label' => 'col-sm-3',
        'wrapper' => 'col-sm-9',
    ],
]]) ?>
    <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">Form Pembuatan Booth <small>Lengkapi data berikut untuk membuat booth
                        anda</small></h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <?= Html::a('<i class="la la-arrow-left"></i>
                <span class="kt-hidden-mobile">Back</span>', ['site/index'], ['class' => 'btn btn-clean kt-margin-r-10']) ?>
                <?= Html::submitButton('<i class="la la-check"></i>
                <span class="kt-hidden-mobile">Save</span>', ['class' => 'btn btn-brand']) ?>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-8">
                    <div class="kt-section kt-section--first">
                        <div class="kt-section__body">
                            <h3 class="kt-section__title kt-section__title-lg">Identitas Booth:</h3>
                            <?= $form->field($model, 'nama')->textInput(['placeholder' => 'Nama Booth']) ?>
                            <?= $form->field($model, 'deskripsi')->widget(TinyMce::class) ?>
                            <?= $form->field($model, 'avatar')->widget(FileInput::class, [
                                'pluginOptions' => [
                                    'theme' => 'explorer-fas',
                                    'allowedFileExtensions' => FileExtension::FOTO,
                                    'showUpload' => false,
                                    'previewFileType' => 'any',
                                    'fileActionSettings' => [
                                        'showZoom' => true,
                                        'showRemove' => false,
                                        'showUpload' => false,
                                    ],
                                ]
                            ]) ?>
                        </div>
                    </div>
                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                    <div class="kt-section">
                        <div class="kt-section__body">
                            <h3 class="kt-section__title kt-section__title-lg">Alamat Booth:</h3>
                            <?= $form->field($model, 'koordinat')->widget(MapInputWidget::class, [
                                'key' => Yii::$app->params['maps_api'],
                                'animateMarker' => true,
                                'enableSearchBar' => true,
                                'latitude' => 0.511907,
                                'longitude' => 101.448639,
                                'zoom' => 12,
                                'pattern' => '%latitude%,%longitude%'
                            ]) ?>
                            <?= $form->field($model, 'alamat1')->textInput() ?>
                            <?= $form->field($model, 'alamat2')->textInput() ?>
                            <?= $form->field($model, 'kelurahan')->textInput() ?>
                            <?= $form->field($model, 'kecamatan')->textInput() ?>
                            <?= $form->field($model, 'kota')->textInput() ?>
                            <?= $form->field($model, 'provinsi')->textInput() ?>
                        </div>
                    </div>
                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                    <div class="kt-section">
                        <div class="kt-section__body">
                            <h3 class="kt-section__title kt-section__title-lg">Kontak Booth:</h3>
                            <?= $form->field($model, 'email')->textInput() ?>
                            <?= $form->field($model, 'nomor_telepon')->widget(PhoneInput::class,
                                [
                                    'jsOptions' => [
                                        'onlyCountries' => ['id']
                                    ],
                                    'options' => ['placeholder' => '62xxxxxxxxxxxx']
                                ]) ?>
                        </div>
                    </div>
                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                    <div class="kt-section kt-section--last">
                        <div class="kt-section__body">
                            <h3 class="kt-section__title kt-section__title-lg">Persetujuan:</h3>
                            <?= $form->field($model, 'terms')->checkbox()->label('Anda setuju dengan terms of service situs ini') ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2"></div>
            </div>
        </div>
    </div>

    <!--end::Portlet-->
<?php ActiveForm::end() ?>

<?php
$js = <<<JS
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};
   MutationObserver = window.MutationObserver || window.WebKitMutationObserver;
var trackChange = function(element) {
  var observer = new MutationObserver(function(mutations, observer) {
    if(mutations[0].attributeName == "value") {
        $(element).trigger("change");
    }
  });
  observer.observe(element, {
    attributes: true
  });
}
trackChange( $("#penjualsignupform-koordinat")[0] );
 $('#penjualsignupform-koordinat').change(function() {
        var a = document.getElementById('penjualsignupform-koordinat').value;
        var b = a.split(',');
        var latLng = {
            lat: b[0],
            lng: b[1]
        };
        var geocoder = new google.maps.Geocoder;
        geocodeLatLng(geocoder, latLng)
      });
function geocodeLatLng(geocoder, latLng){
                    console.log(latLng);
          var location = {lat: parseFloat(latLng.lat), lng: parseFloat(latLng.lng)};
          geocoder.geocode({'location': location }, function(result, status) {
            if(status === 'OK'){
                if(result[0]){
                    var addrObject = result[0].address_components;
                    console.log(addrObject);
                    
                     var address = {};
                     for(let i = 0; i< addrObject.length; i++){
                         let component = addrObject[i];
                         switch (component.types[0]) {
                        case 'postal_code':
                             address.postalCode = component.long_name; break;
                        case 'administrative_area_level_2':
                            address.city = component.long_name; break;
                        case 'country':
                            address.country = component.long_name;
                            break;
                        case 'route':
                             address.route = component.long_name; break;
                          case 'street_number':
                             address.streetNumber = component.long_name; break;    
                        case 'administrative_area_level_4':
                             address.lvl4 = component.long_name; break;       
                         case 'administrative_area_level_3':
                             address.lvl3 = component.long_name; break    
                             
                             case 'administrative_area_level_1':
                             address.lvl1 = component.long_name; break
                    }
                     }
                    
                    $('#penjualsignupform-kota').val(address.city);
                    $('#penjualsignupform-kecamatan').val(address.lvl3);
                    $('#penjualsignupform-provinsi').val(address.lvl1);
                    $('#penjualsignupform-kelurahan').val(address.lvl4);
                    
                    
                    
                }
            }
          })
      }
JS;

$this->registerJs($js, \yii\web\View::POS_LOAD);

