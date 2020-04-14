<?php

namespace penjual\controllers;

use common\models\Model;
use common\models\Promo;
use common\models\PromoProduk;
use penjual\models\PromoSearch;
use Yii;
use yii\bootstrap4\ActiveForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;


/**
 * PromoController implements the CRUD actions for Promo model.
 */
class PromoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['actions' => ['index', 'create', 'update', 'view', 'delete'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Promo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PromoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Promo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Promo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Promo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Promo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Promo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
//        $model = new Promo();
//
//        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
//            Yii::$app->response->format = Response::FORMAT_JSON;
//            return ActiveForm::validate($model);
//        }
//        if ($model->load(Yii::$app->request->post())) {
//
//
//            $model->save();
//            Yii::$app->session->setFlash('success','Berhasil menambahkan Promo.');
//
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        elseif (Yii::$app->request->isAjax){
//            return $this->renderAjax('_form',['model'=>$model]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);

        $modelPromo = new Promo();
        $modelPromo->id_booth = Yii::$app->user->identity->booth->id;
        $modelsProduk = [new PromoProduk()];
        if ($modelPromo->load(Yii::$app->request->post())) {
            $modelsProduk = Model::createMultiple(PromoProduk::class);
            Model::loadMultiple($modelsProduk, Yii::$app->request->post());

            //ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsProduk),
                    ActiveForm::validate($modelPromo)
                );
            }

            //validate all models
            $valid = $modelPromo->validate();
            $valid = Model::validateMultiple($modelsProduk) && $valid;
            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelPromo->save(false)) {
                        foreach ($modelsProduk as /** @var $promoProduk PromoProduk */ $promoProduk) {
                            $promoProduk->id_promo = $modelPromo->id;
                            if (!($flag = $promoProduk->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Berhasil menambahkan Promo.');

                        return $this->redirect(['index']);
                    }
                } catch (\Exception $exception) {
                    $transaction->rollBack();
                }
            }
        }
        return $this->render('create', [
            'modelPromo' => $modelPromo,
            'modelsProduk' => (empty($modelsProduk)) ? [new PromoProduk()] : $modelsProduk,
            'produkList' => $this->getProduks()

        ]);
    }

    protected function getProduks()
    {
        return ArrayHelper::map(Yii::$app->user->identity->booth->produks, 'id', 'nama');
    }

    /**
     * Updates an existing Promo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
//        $model = $this->findModel($id);
//
//        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
//            Yii::$app->response->format = Response::FORMAT_JSON;
//            return ActiveForm::validate($model);
//        }
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            Yii::$app->session->setFlash('success', 'Berhasil mengubah Promo.');
//
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('update', [
//            'model' => $model,
//        ]);
        $modelPromo = $this->findModel($id);
        $modelPromo->id_booth = Yii::$app->user->identity->booth->id;
        $modelsProduk = $modelPromo->promoProduks;
        if ($modelPromo->load(Yii::$app->request->post())) {
            $oldIds = ArrayHelper::map($modelsProduk, 'id', 'id');
            $modelsProduk = Model::createMultiple(PromoProduk::class, $modelsProduk);
            Model::loadMultiple($modelsProduk, Yii::$app->request->post());
            $deletedIds = array_diff($oldIds, array_filter(ArrayHelper::map($modelsProduk, 'id', 'id')));

            //ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsProduk),
                    ActiveForm::validate($modelPromo)
                );
            }
            //validate all models
            $valid = $modelPromo->validate();
            $valid = Model::validateMultiple($modelsProduk) && $valid;

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelPromo->save(false)) {
                        if (!empty($deletedIds)) {
                            PromoProduk::deleteAll(['id' => $deletedIds]);
                        }
                        foreach ($modelsProduk as $promoProduk) {
                            $promoProduk->id_promo = $modelPromo->id;
                            if (!($flag = $promoProduk->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Berhasil mengubah Promo.');

                        return $this->redirect(['view', 'id' => $modelPromo->id]);
                    }
                } catch (\Exception $exception) {
                    $transaction->rollBack();
                }
            }
        }
        return $this->render('update', [
            'modelPromo' => $modelPromo,
            'modelsProduk' => (empty($modelsProduk)) ? [new PromoProduk()] : $modelsProduk,
            'produkList' => $this->getProduks()
        ]);
    }

    /**
     * Deletes an existing Promo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', 'Berhasil menghapus Promo.');

        return $this->redirect(['index']);
    }
}
