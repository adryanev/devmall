<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(__DIR__, 2) . '/frontend');
Yii::setAlias('@admin', dirname(__DIR__, 2) . '/admin');
Yii::setAlias('@penjual', dirname(__DIR__, 2) . '/penjual');
Yii::setAlias('@console', dirname(__DIR__, 2) . '/console');
Yii::setAlias('@profilUserPath', '@frontend/web/images/profil');
Yii::setAlias('@produkPath', '@penjual/web/upload/produk');
Yii::setAlias('@permintaanPath', '@frontend/web/upload/permintaan');
Yii::setAlias('@keluhanPath','@frontend/web/upload/keluhan');
$ini = parse_ini_file(dirname(__DIR__, 2) . '/system-configuration.ini');

Yii::setAlias('@.frontend', $ini['url_frontend']);
Yii::setAlias('@.penjual', $ini['url_penjual']);
Yii::setAlias('@.admin', $ini['url_admin']);
Yii::setAlias('@.profilUserPath', '@.frontend/images/profil');
Yii::setAlias('@.produkPath', '@.penjual/upload/produk');
Yii::setAlias('@.permintaanPath', '@.frontend/upload/permintaan');
Yii::setAlias('@.reimbursementPath', '@.penjual/upload/reimbursement');
Yii::setAlias('@.keluhanPath', '@.frontend/upload/keluhan');
