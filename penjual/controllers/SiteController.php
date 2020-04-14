<?php

namespace penjual\controllers;

use common\models\Coin;
use common\models\User;
use penjual\models\forms\PenjualLoginForm;
use penjual\models\forms\PenjualSignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
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
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'verification'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionDaftar()
    {

    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->identity->getHasBooth()) {
            $this->redirect(['site/verification']);
        } else {
            if (!Yii::$app->user->identity->booth->isVerified()) {
                Yii::$app->session->setFlash('warning', 'Booth anda sedang proses verifikasi');
            }
        }

        return $this->render('index');
    }

    public function actionVerification()
    {
        $user = $this->getUser();
        $model = new PenjualSignupForm($user->getId());
        if ($model->load(Yii::$app->request->post())) {
            $model->avatar = UploadedFile::getInstance($model, 'avatar');
            if ($model->signup()) {
                $user = User::findOne(Yii::$app->user->identity->getId());
                $user->has_booth = User::HAS_BOOTH;
                $user->save(false);
                $coin = new Coin();
                $coin->id_booth = $user->booth->id;
                $coin->saldo = 0;
                $coin->status = Coin::STATUS_ACTIVE;
                $coin->save(false);
                Yii::$app->session->setFlash('success', 'Berhasil untuk membuat Booth');
                return $this->redirect(['site/index']);
            }

        }
        return $this->render('verification', compact('model'));
    }

    protected function getUser()
    {
        $user = Yii::$app->user->identity;
        return $user;
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'main-login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new PenjualLoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) return $this->redirect(['site/index']);
            else  Yii::$app->session->setFlash('warning', 'Anda belum melakukan verifikasi identitas');
        }


        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
