<?php


namespace common\helpers;


use DateInterval;
use DateTime;

trait UnixToDateTrait
{

    public function convertToDate($time)
    {
        $date = DateTime::createFromFormat('Y/m/d', $time);
        $date->setTime(0, 0, 0);

// set lowest date value
        $unixDateStart = $date->getTimeStamp();

// add 1 day and subtract 1 second
        $date->add(new DateInterval('P1D'));
        $date->sub(new DateInterval('PT1S'));

// set highest date value
        $unixDateEnd = $date->getTimeStamp();

        return ['dateStart' => $unixDateStart, 'dateEnd' => $unixDateEnd];
    }
}