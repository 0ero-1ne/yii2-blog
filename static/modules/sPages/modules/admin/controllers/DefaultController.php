<?php

namespace app\modules\sPages\modules\admin\controllers;

use yii\web\Controller;
use Yii;

/**
 * Default controller for the `admin-panel` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actionIndex(){

    	if (Yii::$app->user->isGuest || Yii::$app->user->id != '100') {
            Yii::$app->getSession()->setFlash('error','Where are you trying to get?');
            return $this->goHome();
        }
        
        return $this->redirect('admin/article/index.html');

    }
}
