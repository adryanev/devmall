<?php


namespace frontend\controllers;

use common\components\shoppingcart\ShoppingCart;
use common\models\Diskon;
use common\models\HargaNego;

use common\models\Produk;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class KeranjangController extends Controller
{


    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'tambah' => ['POST'],
                    'hapus' => ['POST'],
                ]
            ]
        ];
    }

    public function actionTambah()
    {

        $data = Yii::$app->request->post();
        $is_nego = filter_var($data['is_nego'], FILTER_VALIDATE_BOOLEAN);
        $is_diskon = filter_var($data['is_diskon'], FILTER_VALIDATE_BOOLEAN);

        $cart = Yii::$app->cart;
        $product = Produk::findOne($data['produk']);
        $cart->create($product);



        if($is_nego){
            $harganego = HargaNego::findOne(['id_produk' => $product->id, 'id_user' => Yii::$app->user->id]);
            $cart->getItemById($product->id)->setNegoPrice($harganego);

        }


        if($is_diskon){
            $diskon = $product->diskon;
            $cart->getItemById($product->id)->setDiscount($diskon);
        }
        $cart->save();


//        $keranjang = new Keranjang();
//        $keranjang->id_user = $data['user'];
//        $keranjang->id_produk = $data['produk'];
//        $keranjang->is_diskon = $is_diskon;
//        $keranjang->is_nego = $is_nego;

//        if ($is_nego) {
//
//
//            $keranjang->id_harga_nego = $id_harga_nego->id;
//
//        }
//        $keranjang->save(false);

        return $this->redirect(Yii::$app->request->referrer ?: $this->goBack());
    }


    public function actionHapus()
    {

        $data = Yii::$app->request->post();
        $cart =Yii::$app->cart;
        $produk = Produk::findOne($data['produk']);
        $cart->delete($produk);

        return $this->redirect(Yii::$app->request->referrer ?: $this->goBack());
    }

    public function actionIndex()
    {

        $keranjang = Yii::$app->cart;

        $keranjangDataProvider = new ArrayDataProvider(['allModels' => $keranjang->getItems()]);
        $keranjangTotal = $keranjang->getCost();
        $keranjangCount = $keranjang->getCount();



        return $this->render('index', compact('keranjang', 'keranjangCount', 'keranjangDataProvider', 'keranjangTotal'));
    }
}
