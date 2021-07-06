<?php


namespace penjual\controllers;


use common\models\Booth;
use common\models\Keluhan;
use common\models\Notifikasi;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class KeluhanController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'tolak' => ['POST'],
                    'terima' => ['POST']
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Keluhan::find()->joinWith('produk')->where(['produk.id_booth' => \Yii::$app->user->identity->booth->id]),
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ]
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);

    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', compact('model'));
    }

    protected function findModel($id)
    {

        if ($model = Keluhan::findOne($id)) {
            return $model;
        }

        throw new NotFoundHttpException();
    }

    public function actionTerima($id)
    {
        $model = $this->findModel($id);
        $model->status = Keluhan::STATUS_DIPROSES;
        $model->save(false);
        $this->sendNotification($model, \Yii::$app->user->identity->booth, $model->user);
        \Yii::$app->session->setFlash('success', 'Berhasil menerima keluhan');
        return $this->redirect(['keluhan/view', 'id' => $model->id]);
    }

    private function sendNotification(Keluhan $keluhan, Booth $booth, User $user)
    {
        $notif = new Notifikasi();
        $notif->sender = $booth->id;
        $notif->receiver = $user->id;
        $notif->context = "Keluhan anda dengan pada produk: {$keluhan->produk->nama} $keluhan->statusString";
        $notif->id_data = $keluhan->id;
        $notif->jenis_data = 'Keluhan';
        $notif->save(false);
    }

    public function actionTolak($id)
    {
        $model = $this->findModel($id);
        $model->status = Keluhan::STATUS_DITOLAK;
        $model->save(false);
        $this->sendNotification($model, \Yii::$app->user->identity->booth, $model->user);
        \Yii::$app->session->setFlash('success', 'Berhasil Menolak keluhan');
        return $this->redirect(['keluhan/view', 'id' => $model->id]);
    }
}
