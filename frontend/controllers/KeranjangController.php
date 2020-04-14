<?php


namespace frontend\controllers;


use common\models\HargaNego;
use common\models\Keranjang;
use Yii;
use yii\data\ActiveDataProvider;
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

        $keranjang = new Keranjang();
        $keranjang->id_user = $data['user'];
        $keranjang->id_produk = $data['produk'];
        $keranjang->is_diskon = $is_diskon;
        $keranjang->is_nego = $is_nego;
        if ($is_nego) {
            $keranjang->id_harga_nego = HargaNego::findOne(['id_produk' => $data['produk'], 'id_user' => $data['user']]);
        }
        $keranjang->save(false);

        return $this->redirect(Yii::$app->request->referrer ?: $this->goBack());
    }

    public function actionHapus()
    {
        $data = Yii::$app->request->post();
        $keranjang = Keranjang::findOne(['id_produk' => $data['produk'], 'id_user' => $data['user']]);
        $keranjang->delete();

        return $this->redirect(Yii::$app->request->referrer ?: $this->goBack());

    }

    public function actionIndex()
    {
        $keranjang = \Yii::$app->user->identity->getKeranjangs();
        $keranjangCount = $keranjang->count();
        $keranjangDataProvider = new ActiveDataProvider(['query' => $keranjang]);
        $keranjangTotal = array_sum(array_values(ArrayHelper::map($keranjang->all(), 'harga', 'harga')));


        return $this->render('index', compact('keranjang', 'keranjangCount', 'keranjangDataProvider', 'keranjangTotal'));
    }
}