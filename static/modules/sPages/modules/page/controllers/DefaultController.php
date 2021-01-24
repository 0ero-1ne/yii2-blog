<?php

namespace app\modules\sPages\modules\page\controllers;

use yii\web\Controller;

use app\modules\sPages\models\Article;

/**
 * Default controller for the `pages` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect('/list-of-articles.html');
    }
}
