<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@admin', dirname(dirname(__DIR__)) . '/admin');
Yii::setAlias('@penjual', dirname(dirname(__DIR__)) . '/penjual');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@profilUserPath', '@frontend/web/images/profil');
Yii::setAlias('@produkPath', '@penjual/web/upload/produk');
Yii::setAlias('@permintaanPath', '@frontend/web/upload/permintaan');

Yii::setAlias('@.frontend', 'http://devmall.test/frontend/web');
Yii::setAlias('@.penjual', 'http://devmall.test/penjual/web');
Yii::setAlias('@.admin', 'http://devmall.test/admin/web');
Yii::setAlias('@.profilUserPath', '@.frontend/images/profil');
Yii::setAlias('@.produkPath', '@.penjual/upload/produk');
Yii::setAlias('@.permintaanPath', '@.frontend/upload/permintaan');
