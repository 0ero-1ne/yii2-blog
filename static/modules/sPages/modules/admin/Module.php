<?php

namespace app\modules\sPages\modules\admin;

/**
 * admin-panel module definition class
 */
class Module extends \yii\base\Module
{

    /**
     * {@inheritdoc}
     */

    public $layout = '/admin';
    public $controllerNamespace = 'app\modules\sPages\modules\admin\controllers';


    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
