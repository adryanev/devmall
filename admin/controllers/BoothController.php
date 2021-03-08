<?php

namespace admin\controllers;

use common\models\Booth;
use common\models\User;
use Throwable;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class BoothController extends Controller
{
    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'verbs'=>[
                'class'=>VerbFilter::class,
                'actions' => [
                    'tolak'=>['POST'],
                    'terima'=>['POST']
                ]
            ]
        ];
    }

    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $data = Booth::find(); 
        $dataProvider = new ActiveDataProvider(['query' => $data]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * @return string
     */
    public function actionVerifikasi(): string
    {
        $data = Booth::find()->where(['status' => Booth::STATUS_CREATED]);
        $dataProvider = new ActiveDataProvider(['query' => $data]);

        return $this->render('verifikasi', ['dataProvider' => $dataProvider]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id): string
    {
        $model = $this->findModel($id);
        return $this->render('view', compact('model'));
    }

    /**
     * @param $id
     * @return Booth|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        $model = Booth::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
        }

        return $model;
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \Exception
     */
    public function actionTerima($id): Response
    {
        $model = $this->findModel($id);
        if (isset($model)) {
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
        throw new NotFoundHttpException();
    }


    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws yii\db\StaleObjectException
     */
    public function actionTolak($id): Response
    {
        $model = $this->findModel($id);
        if ($model !== null) {
            $model->user->has_booth = 0;
            $model->user->update(false);
            $model->delete();
            Yii::$app->session->setFlash('success', 'Berhasil menolak verifikasi');
            return $this->redirect(['index']);
        }
        throw new NotFoundHttpException();
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws yii\db\StaleObjectException
     */
    public function actionDelete($id): Response
    {
        $model = $this->findModel($id);
        if (isset($model)) {
            $model->user->has_booth = 0;
            $model->user->save(false);
            $model->delete();
            Yii::$app->session->setFlash('success', 'Berhasil menghapus Booth');
            return $this->redirect(['index']);
        }
        throw new NotFoundHttpException();
    }
}
