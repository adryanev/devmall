<?php


namespace penjual\controllers;


use common\models\Transaksi;
use common\models\TransaksiDetail;
use common\models\TransaksiProduk;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;

class TransaksiController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'verbs'=>[
                'class'=>VerbFilter::class,
                'actions' => [
                    'kirim-produk'=>['POST']
                ]
            ]
        ];
    }

    protected function findTransaksiProdukBooth(){
        $booth = $this->findBooth();
        return TransaksiProduk::find()->joinWith('transaksiDetails.produk')->where(['produk.id_booth'=>$booth->id])->orderBy('order_date DESC');
    }
    public function actionMasuk(){

        $transaksiDataProvider = new ActiveDataProvider(['query' =>$this->findTransaksiProdukBooth() ]);
        return $this->render('masuk',['transaksiDataProvider'=>$transaksiDataProvider,'booth'=>$this->findBooth()]);
    }

    public function actionView($id){
        $model = TransaksiProduk::findOne($id);
        return $this->render('view',['model'=>$model]);
    }

    public function actionReimburse(){
        $booth = \Yii::$app->user->identity->booth;
        $reimburseDataProvider = new ActiveDataProvider(['query' => $booth->getReimbursement()->orderBy('id DESC') ]);
        return $this->render('reimburse',compact('reimburseDataProvider'));
    }

    public function actionKirimProduk(){
        $data = \Yii::$app->request->post();
        $transaksi = $this->findTransaksiProdukBooth()->andWhere(['transaksi_produk.id'=>$data['id']])->one();
        $transaksi->status = TransaksiProduk::STATUS_COMPLETE;
        $transaksi->save(false);
        \Yii::$app->session->setFlash('success','Transaksi Selesai, Produk sudah dapat diunduh oleh pengguna.');
        //TODO: Kirim Email
        return $this->redirect(\Yii::$app->request->referrer);
    }

    private function findBooth()
    {
        return \Yii::$app->user->identity->booth;
    }
}
