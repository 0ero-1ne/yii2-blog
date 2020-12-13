<?php
namespace app\modules\sPages\modules\adminPanel\controllers;

use Yii;
use app\modules\sPages\modules\adminPanel\models\ArticleCreatingForm;
use app\modules\sPages\modules\adminPanel\models\Article;


class ArticleController extends \yii\web\Controller
{
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

        $model = new ArticleCreatingForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $article = new Aricle();

            $date = date("d.m.y H:i:s");

            $article->title = $model->title;
            $article->author = $model->author;
            $article->slug = $model->slug;
            $article->categoryId = $model->categoryId;
            $article->tagId = $model->tagId;
            $article->dateCreate = $date;
            $article->dateUpdate = $date;
            $article->status = $model->status;
            $article->shortContent = $model->shortContent;
            $article->content = $model->content;
            $article->raiting = $model->raiting;

            if($article->save()){
                Yii::$app->getSession()->setFlash('success','Article was made!');
                $this->redirect('admin/article/index');
            }
        }

        return $this->render('create', compact('model'));
    }

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

        $model = new ArticleCreatingForm();

        return $this->render('index');
    }    

}
