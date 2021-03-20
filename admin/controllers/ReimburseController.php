<?php


namespace admin\controllers;


use admin\models\ReimbursementCompletedForm;
use common\models\CoinLedger;
use common\models\Reimbursement;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ReimburseController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'verbs'=>[
                'class'=>VerbFilter::class,
                'actions' => [
                    'terima'=>['POST'],
                    'selesai'=>['GET','POST']
                ]
            ]
        ];
    }

    public function actionIndex(){
        $dataProvider = new ActiveDataProvider(['query' => Reimbursement::find()->where(['like','status',Reimbursement::STATUS_CREATED])->orWhere(['like','status',Reimbursement::STATUS_PROGRESS])->orderBy('id DESC')]);

        $completeDataProvider = new ActiveDataProvider(['query' => Reimbursement::find()->where(['like','status',Reimbursement::STATUS_COMPLETED])]);
        return $this->render('index',compact('dataProvider','completeDataProvider'));
    }

    public function actionTerima(){
        $id = \Yii::$app->request->post('id');
        $model = $this->findModel($id);

        $model->status = Reimbursement::STATUS_PROGRESS;
       if($model->save(false)){
           \Yii::$app->session->setFlash('success','Berhasil Menerima Reimbursement');
       } else{
           \Yii::$app->session->setFlash('danger','Ups, terjadi kesalahan saat menerima reimbursement');
       }


        return $this->redirect(\Yii::$app->request->referrer);
    }
    public function actionSelesai($id){

        $reimbursement = $this->findModel($id);
        $model = new ReimbursementCompletedForm($reimbursement);

        if($model->load(\Yii::$app->request->post())){
            $transaction = \Yii::$app->db->beginTransaction();
            try{
                $model->bukti = UploadedFile::getInstance($model,'bukti');
                if($model->save()){

                    $coin = $reimbursement->booth->coin;
                    $coin->saldo = $coin->saldo - $reimbursement->amount;
                    $coin->save(false);

                    $coinLedger = new CoinLedger();
                    $coinLedger->id_coin = $coin->id;
                    $coinLedger->type = CoinLedger::TYPE_OUT;
                    $coinLedger->amount = $reimbursement->amount;
                    $coinLedger->save(false);


                    $transaction->commit();
                    \Yii::$app->session->setFlash('success','Berhasil Menerima Reimbursement');
                } else{
                    \Yii::$app->session->setFlash('danger','Ups, terjadi kesalahan saat menerima reimbursement');
                }
            }catch (Exception $exception){
                $transaction->rollBack();
                throw $exception;
            }

            return $this->redirect(\Yii::$app->request->referrer);
        }

        return  $this->renderAjax('_selesai',compact('model'));

    }
    public function actionView($id){

        return $this->render('view',[
            'model'=>$this->findModel($id)
        ]);

    }

    protected function findModel($id){
        if($model = Reimbursement::findOne($id)){
            return $model;
        }
        throw new NotFoundHttpException();
    }
}
