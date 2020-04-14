<?php

namespace penjual\controllers;

use common\models\User;
use yii\web\NotFoundHttpException;

class UserController extends \yii\web\Controller
{
    public function actionView($id)
    {
        return $this->render('view', ['model'=>$this->findModel($id)]);
    }

    protected function findModel($id)
    {
        $model = User::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
        }

        return $model;
    }
}
