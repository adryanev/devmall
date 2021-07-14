<?php


namespace common\components\shoppingcart\events;


use common\components\shoppingcart\CartItemInterface;
use yii\base\Event;

class CartActionEvent extends Event
{

    const ACTION_UPDATE = 'update';
    const ACTION_ITEM_PUT = 'itemPut';
    const ACTION_BEFORE_REMOVE = 'beforeRemove';
    const ACTION_REMOVE_ALL = 'removeAll';
    const ACTION_SET_ITEMS = 'setItems';

    /**
     * Name of the action taken on the cart
     * @var string
     */
    public $action;
    /**
     * Item of the cart that was affected. Could be null if action deals with all items of the cart
     * @var CartItemInterface
     */
    public $item;
}
