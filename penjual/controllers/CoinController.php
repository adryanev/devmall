<?php


namespace penjual\controllers;


use penjual\models\forms\ReimbursementForm;
use Yii;
use yii\bootstrap4\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\web\MethodNotAllowedHttpException;
use yii\web\Response;

class CoinController extends \yii\web\Controller
{
    public function actionIndex(){

        $booth = $this->findBooth();
        $coin = $this->getCoin($booth);
        $ledger = new ActiveDataProvider(['query' => $coin->getLedger()]);

        return $this->render('index',compact('coin','ledger'));
    }

    public function actionReimbursement(){
        $booth = $this->findBooth();
        $model = new ReimbursementForm($booth);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('reimbursement',compact('booth','model'));
        }
        if($model->load(Yii::$app->request->post())){
            if($model->save()){
                Yii::$app->session->setFlash('success','Permintaan Reimbursement anda telah dikirim');
            }
            else {
                Yii::$app->session->setFlash('danger','Permintaan reimbursement anda gagal dikirim');
            }
            return $this->redirect('index');
        }

        throw new MethodNotAllowedHttpException('Tidak bisa mengakses halaman ini.');
    }

    private function getCoin($booth)
    {
        return $booth->coin;
    }

    private function findBooth(){
        return Yii::$app->user->identity->booth;
    }
}
