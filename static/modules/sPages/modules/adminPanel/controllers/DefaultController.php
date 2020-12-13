<?php

namespace app\modules\sPages\modules\adminPanel\controllers;

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

    	if (Yii::$app->user->isGuest) {
    		Yii::$app->getSession()->setFlash('warning','Stop! Who are you?');
        	return $this->redirect('site/login');
    	}

    	if (Yii::$app->user->id != '100') {
    		Yii::$app->getSession()->setFlash('error','Stop! You do not have access to the admin panel!');
    		return $this->goHome();
    	}

        return $this->redirect('admin/article/index');

    }
}
