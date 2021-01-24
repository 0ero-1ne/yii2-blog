<?php

namespace app\modules\sPages\modules\page;

/**
 * pages module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\sPages\modules\page\controllers';
    public $layout = "/page";

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
