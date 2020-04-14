<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 17/09/19
 * Time: 21.43
 */

namespace common\widgets;


use Yii;
use yii\helpers\ArrayHelper;

class BootstrapNotify extends \yii2mod\notify\BootstrapNotify
{

    public $logo = [
      'success'=>'fa fa-check',
        'danger'=>'fa fa-close',
        'warning'=>'fa fa-exclamation-triangle',
        'info'=>'fa fa-exclamation'
    ];
    /**
     * @inheritdoc
     */
    public function run()
    {
        parent::run();

        if ($this->useSessionFlash) {
            $session = Yii::$app->getSession();
            $flashes = $session->getAllFlashes();
            foreach ($flashes as $type => $data) {
                if (isset($this->alertTypes[$type])) {
                    if (ArrayHelper::isAssociative($data)) {
                        $this->options = ArrayHelper::merge($this->options, $data);
                        $this->clientOptions['type'] = $this->alertTypes[$type];
                        $this->clientOptions['icon'] = $this->logo[$type];
                        $this->renderMessage();
                    } else {
                        $data = (array)$data;
                        foreach ($data as $i => $message) {
                            $this->options['message'] = $message;
                            $this->clientOptions['type'] = $this->alertTypes[$type];
                            $this->clientOptions['icon'] = $this->logo[$type];
                            $this->renderMessage();
                        }
                    }

                    $this->options = [];
                    $session->removeFlash($type);
                }
            }
        } else {
            $this->renderMessage();
        }
    }

}