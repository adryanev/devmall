<?php


namespace common\components\shoppingcart\storages;

use common\components\shoppingcart\models\Keranjang;
use common\components\shoppingcart\ShoppingCart;
use Yii;
use yii\db\Query;
use yii\di\Instance;
use yii\helpers\Json;

/**
 * DatabaseStorage is extended from Storage Class
 *
 * It's specialty for handling read and write cart data into database
 *
 * Usage:
 * Configuration in block component look like this
 *        'cart' => [
 *            'class' => 'adryanev\shoppingcart\ShoppingCart',
 *            'storage' => [
 *                'class' => 'adryanev\shoppingcart\DatabaseStorage',
 *                'table'    => 'cart',
 *            ]
 *        ],
 *
 * @author Hafid Mukhlasin <hafidmukhlasin@gmail.com>
 * @since 1.0
 *
 */
class DatabaseStorage extends Storage
{
    public $db = 'db';

    public $table = 'keranjang';

    public function getPromo(ShoppingCart $cart)
    {
        if ($data=$this->select($cart)) {
            return $data->promoProduk;
        }
        return null;
    }
    /**
     *
     */
    public function init()
    {
        parent::init();
        $this->db = Instance::ensure($this->db, 'yii\db\Connection');
    }

    public function read(ShoppingCart $cart)
    {
        if ($data = $this->select($cart)) {
            $this->unserialize($data->items, $cart);
        }
    }

    public function write(ShoppingCart $cart)
    {
        if ($this->select($cart)) {
            $this->update($cart);
        } else {
            $this->insert($cart);
        }
    }

    public function lock($drop, ShoppingCart $cart)
    {
        if ($data = $this->select($cart)) {
            if ($drop) {
                $data->status = 0;
            } else {
                $data->status = 1;
//                $this->db->createCommand()->update($this->table, [
//                    'status' => 1
//                ],
//                    [
//                        'and',
//                        ['or',
//                            ['user_id' => Yii::$app->user->id],
//                            ['id' => Yii::$app->session->getId()],
//                        ],
//                        ['name'   => $cart->id],
//                        ['status'     => 0]
//                    ]
//                )->execute();
//                Yii::$app->session->regenerateID(true);
            }
            $data->save();
        }
    }

    /**
     * @param ShoppingCart $cart
     * @return Keranjang|null
     */
    public function select(ShoppingCart $cart)
    {
        return Keranjang::find()->where(['id_user'=>Yii::$app->user->id])->andWhere(['status'=>0])->orderBy('id DESC')->one();
//        return (new Query())
//            ->select('*')
//            ->from($this->table)
//            ->where(['or', 'user_id = ' . Yii::$app->user->id, 'id = \'' . Yii::$app->session->getId() . '\''])
//            ->andWhere([
//                'name' => $cart->id,
//                'status' => 0,
//            ])
//            ->orderBy(['id' => SORT_DESC])
//            ->limit(1)
//            ->one($this->db);
    }

    /**
     * @param ShoppingCart $cart
     */
    public function insert(ShoppingCart $cart)
    {
        $model = new Keranjang();
        $model->id_user = Yii::$app->user->id;
        $model->items = $this->serialize($cart);
        $model->status = 0;
        $model->save();
//        $this->db->createCommand()->insert($this->table, [
//            'id' => Yii::$app->session->getId(),
//            'user_id' => Yii::$app->user->id,
//            'name' => $cart->id,
//            'value' => $this->serialize($cart),
//            'status' => 0,
//        ])->execute();
    }

    /**
     * @param ShoppingCart $cart
     */
    public function update(ShoppingCart $cart)
    {
        $model = $this->select($cart);
        $model->items = $this->serialize($cart);
        $model->save();
//        $this->db->createCommand()->update($this->table, [
//            'value' => $this->serialize($cart)
//        ],
//            [
//                'and',
//                ['or',
//                    ['user_id' => Yii::$app->user->id],
//                    ['id' => Yii::$app->session->getId()],
//                ],
//                ['name'   => $cart->id],
//                ['status'     => 0]
//            ]
//        )->execute();
    }
}
