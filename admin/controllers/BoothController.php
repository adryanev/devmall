<?php

namespace admin\controllers;

use common\models\Booth;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class BoothController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $data = Booth::find();
        $dataProvider = new ActiveDataProvider(['query' => $data]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionVerifikasi()
    {
        $data = Booth::find()->where(['status' => Booth::STATUS_CREATED]);
        $dataProvider = new ActiveDataProvider(['query' => $data]);

        return $this->render('verifikasi', ['dataProvider' => $dataProvider]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', compact('model'));
    }

    function findModel($id)
    {
        $model = Booth::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
        }

        return $model;

    }

    public function actionTerima($id)
    {
        $model = $this->findModel($id);
        $model->status = Booth::STATUS_VERIFIED;
        $model->user->has_booth = User::HAS_BOOTH;
        $model->user->save(false);
        $model->save(false);

        $auth = Yii::$app->authManager;
        $role = $auth->getRole('penjual');
        $auth->assign($role, $model->user->getId());


        Yii::$app->session->setFlash('success', 'Berhasil menyetujui verifikasi');
        return $this->redirect(['booth/verifikasi']);
    }

    public function actionTolak($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        Yii::$app->session->setFlash('success', 'Berhasil menolak verifikasi');

        return $this->redirect(['index']);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->user->has_booth = 0;
        $model->delete();
        Yii::$app->session->setFlash('success', 'Berhasil menghapus Booth');
        return $this->redirect(['index']);
    }


}
