<?php

namespace frontend\controllers;

use common\models\Kategori;
use common\models\Produk;
use frontend\models\ContactForm;
use frontend\models\forms\search\SearchProductIndexForm;
use frontend\models\forms\user\UserLoginForm;
use frontend\models\forms\user\UserSignupForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\ResetPasswordForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'main-index';
        $kategori = Kategori::find()->all();
        $dataKategori = ArrayHelper::map($kategori, 'nama', 'nama');
        $produkDataProvider = new ActiveDataProvider(['query' => Produk::find()->orderBy(new Expression('rand()'))->limit(6)]);

        $modelPencarian = new SearchProductIndexForm();
        if ($modelPencarian->load(Yii::$app->request->post())) {
            return $this->redirect(['produk/search', 'produk' => $modelPencarian->product, 'kategori' => $modelPencarian->kategori]);
        }

        //new produk
        $newProduk = Produk::find()->orderBy('created_at DESC');
        $newProdukDataProvider = new ActiveDataProvider(['query' => $newProduk,'pagination' => [
            'pageSize'=>6,
        ]]);

        //follower


        return $this->render('index', compact('dataKategori', 'modelPencarian','produkDataProvider','newProdukDataProvider'));
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goBack();
        }
        $model = new UserLoginForm();



        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    $model->login();
                     return $this->goBack();
                }
            }
        }

        $model->password = '';

        return $this->render('/common-forms/user-login-form', [
            'model' => $model
        ]);


    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new UserSignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($user = $model->signup()) {

                  Yii::$app->session->setFlash('success', [
                      'type' => 'success',
                      'icon' => 'fas fa-check',
                      'message' => 'Silahkan cek email anda untuk melakukan verifikasi.',
                      'title' => 'Pendaftaran Berhasil!',
                  ]);

                }
            }
        }

        return $this->render('/common-forms/user-signup-form', [
            'model' => $model,
        ]);
    }


    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {


        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
     * @throws BadRequestHttpException
     */
    // gHlB4DShguJKQpUjHx7zGlHQSqM2_nPs_1610599520

    public function actionSend()
    {
        $params = [
             'from'=>['address'=>'petya.orlov14@gmail.com','name'=>'Devmall'],
             'addresses'=>[
                 ['address'=>'ondripku14@gmail.com','name'=>'Ondri']
             ],

             'body'=>'email body here',

              //optional
              'subject'=>'email subject here',
               //optional
              'altBody'=>'email alt body here',
               //optional
              // 'addReplyTo'=>[
              //     ['address'=>'email address','information'=>'info here']
              // ],
              //  //optional
              // 'cc'=>[
              //     'email address'
              // ],
              //  //optional
              // 'bcc'=>[
              //     'email address'
              // ],
              //optional
              // 'attachments'=>[
              //    // ['path'=>'','name'=>'']
              // ],
         ];

         return Yii::$app->BitckoMailer->mail($params);
    }

    public function actionVerifyEmail($token)
    {

        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($user = $model->verifyEmail()) {
                Yii::$app->session->setFlash('success', [
                    'type' => 'success',
                    'icon' => 'fas fa-check',
                    'message' => 'Email anda berhasil diverifikasi, anda sudah bisa login.',
                    'title' => 'Verifikasi Berhasil!',
                ]);
                return $this->goHome();
        }

        Yii::$app->session->setFlash('danger', [
            'type' => 'danger',
            'icon' => 'fas fa-stop',
            'message' => 'Sepertinya terjadi kesalahan saat verifikasi email anda.',
            'title' => 'Verifikasi Gagal!',
        ]);
        return $this->goHome();
    }

    public function actionCheckVerificationEmail($email){

        return $this->render('check-verification-email',compact('email'));
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {

                Yii::$app->session->setFlash('success', [
                    'type' => 'success',
                    'icon' => 'fas fa-check',
                    'message' => 'Kode verifikasi baru telah dikirim ke email anda.',
                    'title' => 'Pengiriman Berhasil!',
                ]);
                return $this->redirect(['site/check-verification-email','email'=>$model->email]);
            }
            Yii::$app->session->setFlash('danger', [
                'type' => 'danger',
                'icon' => 'fas fa-stop',
                'message' => 'Terjadi kesalahan saat verifikasi email anda.',
                'title' => 'Gagal!',
            ]);
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
