<?php


namespace common\components\shoppingcart\behaviors;


use common\components\shoppingcart\CartItemInterface;
use common\components\shoppingcart\events\CostCalculationEvent;

class DiscountBehavior extends \yii\base\Behavior
{

    public function events()
    {
        return [
            CartItemInterface::EVENT_COST_CALCULATION => 'onCostCalculation',
        ];
    }

    /**
     * @param CostCalculationEvent $event
     */
    public function onCostCalculation($event)
    {

    }
}
