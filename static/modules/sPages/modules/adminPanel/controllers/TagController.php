<?php

namespace app\modules\sPages\modules\adminPanel\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\modules\sPages\modules\adminPanel\models\TagCreatingForm;
use app\modules\sPages\modules\adminPanel\models\Tag;
use app\modules\sPages\modules\adminPanel\models\DeleteForm;

class TagController extends Controller
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

    	$query = Tag::find();
    	$tags = new Pagination(['totalCount' => $query->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
    	$models = $query->offset($tags->offset)
        	->limit($tags->limit)
        	->all();

        return $this->render('index', compact('tags','models'));
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

    	$model = new TagCreatingForm();

    	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    		$tag = new Tag();

    		$tag->title = $model->title;
    		$tag->slug = $model->slug;

    		if ($tag->create()) {
                Yii::$app->getSession()->setFlash('success','Tag was made!');
                return $this->redirect('/admin/tag/index');
            }
    	}

    	return $this->render('create', compact('model'));    	
    }

    public function actionDelete($id)
    {
		if (Yii::$app->user->isGuest) {
    		Yii::$app->getSession()->setFlash('warning','Stop! Who are you?');
        	return $this->redirect('site/login');
    	}

    	if (Yii::$app->user->id != '100') {
    		Yii::$app->getSession()->setFlash('error','Stop! You do not have access to the admin panel!');
    		return $this->goHome();
    	}    	

    	$model = new DeleteForm();
    	$tag = Tag::findOne($id);

		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->title === $tag->title) {
    			$tag->delete();
    			Yii::$app->getSession()->setFlash('success','Tag was successfully deleted!');
    			return $this->redirect(['index']);
			} else{
				Yii::$app->getSession()->setFlash('warning','You entered the tag title incorrectly!');
			}
		}

		return $this->render('delete', compact('tag','model'));
    }

    public function actionUpdate($id)
    {
		if (Yii::$app->user->isGuest) {
    		Yii::$app->getSession()->setFlash('warning','Stop! Who are you?');
        	return $this->redirect('site/login');
    	}

    	if (Yii::$app->user->id != '100') {
    		Yii::$app->getSession()->setFlash('error','Stop! You do not have access to the admin panel!');
    		return $this->goHome();
    	}

    	$model = new TagCreatingForm();
    	$tag = $this->findModel($id);

    	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    		$tag->title = $model->title;
    		$tag->slug = $model->slug;

    		if ($tag->save(false)) {
                Yii::$app->getSession()->setFlash('success','Tag was successfully updated!');
                return $this->redirect('/admin/tag/index');
            }	
        }

    	return $this->render('update', compact('model','tag'));    	
    }

    protected function findModel($id)
    {
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
