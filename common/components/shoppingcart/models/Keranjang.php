<?php

namespace common\components\shoppingcart\models;

use common\models\Promo;
use common\models\User;
use yii\behaviors\TimestampBehavior;

/**
 * items json structure
 * id=>[
 *   'produk'=> Produk::class,
 *   'qty' => 0,
 *   'nego' => (id_nego)
 *   'diskon => (id_diskon)
 *   'subtotal' => 2010002
 * ]
 */
/**
 * This is the model class for table "keranjang".
 *
 * @property int $id
 * @property int $id_user
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $items
 * @property boolean $status
 * @property int $promo
 *
 * @property User $user
 * @property Promo $promoProduk
 */
class Keranjang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'keranjang';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'created_at', 'updated_at','status'], 'integer'],
            [['items'], 'safe'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'items' => 'Items',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromoProduk()
    {
        return $this->hasOne(Promo::className(), ['id' => 'promo']);
    }


}
