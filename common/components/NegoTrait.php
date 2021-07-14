<?php


namespace common\components;


use common\models\HargaNego;

trait NegoTrait
{
    /**
     * @var HargaNego
     */
    protected $_nego;

    public function setNegoPrice($hargaNego){
        $this->_nego = $hargaNego;
    }

    /**
     * @return HargaNego
     */
    public function getNegoPrice(){
        return $this->_nego;
    }
}
