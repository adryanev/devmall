<?php


namespace common\components\shoppingcart;


/**
 * Interface CartPositionProviderInterface
 * @property CartItemInterface $cartItem
 * @package yz\shoppingcart
 */
interface CartItemProviderInterface
{

    /**
     * @param array $params Parameters for cart item
     * @return CartItemInterface
     */
    public function getCartItem($params = []);
}
