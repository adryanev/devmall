<?php


namespace common\components;


use hscstudio\cart\ItemInterface;

interface CartPositionProviderInterface
{

    /**
     * @param array $params Parameters for cart position
     * @return ItemInterface
     */
    public function getCartPosition($params = []);
}
