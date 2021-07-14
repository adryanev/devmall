<?php


namespace common\components\shoppingcart;

use common\components\shoppingcart\events\CostCalculationEvent;
use yii\base\Component;

trait CartItemTrait
{
    protected $_quantity;
    protected $_discount;

    public function getQuantity()
    {
        return $this->_quantity;
    }

    public function setQuantity($quantity)
    {
        $this->_quantity = $quantity;
    }
    /**
     * Default implementation for getCost function. Cost is calculated as price * quantity
     * @param bool $withDiscount
     * @return int
     */
//    public function getCost($withDiscount = true)
//    {
//        /** @var Component|CartItemInterface|self $this */
//        $cost = $this->getQuantity() * $this->getPrice();
//        $costEvent = new CostCalculationEvent([
//            'baseCost' => $cost,
//        ]);
//        if ($this instanceof Component)
//            $this->trigger(CartItemInterface::EVENT_COST_CALCULATION, $costEvent);
//        if ($withDiscount)
//            $cost = max(0, $cost - $costEvent->discountValue);
//        return $cost;
//    }

    /**
     * Default implementation for getCost function. Cost is calculated as price * quantity
     * @param bool $withDiscount
     * @return int
     */
    public function getCost($withDiscount = true)
    {
        /** @var Component|CartItemInterface|self $this */
        $cost = $this->getQuantity() * $this->getPrice();
        $costEvent = new CostCalculationEvent([
            'baseCost' => $cost,
        ]);
        if ($this instanceof Component) {
            $this->trigger(CartItemInterface::EVENT_COST_CALCULATION, $costEvent);
        }
        if ($this->_discount) {
            $cost = max(0, $this->getHargaDiskon());
        }
        if ($this->_nego) {
            $cost = max(0, $this->_nego->harga);
        }
        return $cost;
    }

    public function setDiscount($discount)
    {
        $this->_discount = $discount;
    }
    public function getDiscount()
    {
        return $this->_discount;
    }
}
