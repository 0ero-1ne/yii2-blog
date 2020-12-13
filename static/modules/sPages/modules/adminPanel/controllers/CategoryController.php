<?php

namespace app\modules\sPages\modules\adminPanel\controllers;
use Yii;
use app\modules\sPages\modules\adminPanel\models\CategoryCreatingForm;
use app\modules\sPages\modules\adminPanel\models\Category;

class CategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	if (Yii::$app->user->isGuest) {
    		Yii::$app->getSession()->setFlash('warning','Stop! Who are you?');
        	return $this->redirect('site/login');
    	}

    	if (Yii::$app->user->id != '100') {
    		Yii::$app->getSession()->setFlash('error','Stop! You do not have access to the admin panel!');
    		return $this->goHome();
    	}
    	
        return $this->render('index');
    }

    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('warning','Stop! Who are you?');
            return $this->redirect('site/login');
        }

        if (Yii::$app->user->id != '100') {
            Yii::$app->getSession()->setFlash('error','Stop! You do not have access to the admin panel!');
            return $this->goHome();
        }

        $model = new CategoryCreatingForm();


        return $this->render('create', compact('model'));
    }

}
