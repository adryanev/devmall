<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@admin', dirname(dirname(__DIR__)) . '/admin');
Yii::setAlias('@penjual', dirname(dirname(__DIR__)) . '/penjual');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

Yii::setAlias('@.frontend','http://devmall.test/frontend/web');
Yii::setAlias('@.penjual','http://devmall.test/penjual/web');
Yii::setAlias('@.admin','http://devmall.test/penjual/web');
