<?php


namespace common\components\shoppingcart\storages;


use common\components\shoppingcart\ShoppingCart;
use yii\helpers\Json;

abstract class Storage extends \yii\base\BaseObject
{

    /**
     * Abstract function for read cart data from storage.
     * @param ShoppingCart $cart
     */
    abstract public function read(ShoppingCart $cart);

    /**
     * Abstract function for write cart data from storage.
     * @param ShoppingCart $cart
     */
    abstract public function write(ShoppingCart $cart);

    /**
     * Abstract function for lock cart data from storage.
     * @param ShoppingCart $cart
     */
    abstract public function lock($drop, ShoppingCart $cart);

    /**
     * Sets cart from serialized string
     * @param string $serialized
     */
    public function unserialize($serialized, ShoppingCart $cart)
    {
        $cart->items = unserialize($serialized);
    }

    /**
     * Returns items as serialized items
     * @return string
     */
    public function serialize(ShoppingCart $cart)
    {
        return serialize($cart->items);
    }
}
