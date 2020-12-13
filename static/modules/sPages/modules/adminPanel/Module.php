<?php

namespace app\modules\sPages\modules\adminPanel;

/**
 * admin-panel module definition class
 */
class Module extends \yii\base\Module
{

    /**
     * {@inheritdoc}
     */

    public $layout = '/admin';
    public $controllerNamespace = 'app\modules\sPages\modules\adminPanel\controllers';


    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
