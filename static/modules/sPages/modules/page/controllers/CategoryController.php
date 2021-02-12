<?php

namespace app\modules\sPages\modules\page\controllers;
use app\modules\sPages\models\Category;
use app\modules\sPages\models\Article;
use Yii;
use yii\data\Pagination;

class CategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {	
    	if (Yii::$app->user->isGuest) {
    		$query = Category::find()->where(['status' => 'guest']);
    	} else if (Yii::$app->user->id == '101') {
    		//$sql = 'SELECT * FROM article WHERE status = "guest" OR status = "user"';
        	$query = Category::find()->where(['status' => 'guest'])->orWhere(['status' => 'user']);
        } else if (Yii::$app->user->id == '100') {
        	//$sql = 'SELECT * FROM article WHERE status = "guest" OR status = "user" OR status = "admin"';
        	$query = Category::find()->where(['status' => 'guest'])->orWhere(['status' => 'user'])->orWhere(['status' => 'admin']);
        }
    	
    	$countQuery = clone $query;
    	$pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
    	$models = $query->offset($pages->offset)
        	->limit($pages->limit)
        	->all();

	    return $this->render('index', [
	         'models' => $models,
	         'pages' => $pages,
	    ]);
        return $this->render('index');
    }

    public function actionPost($slug, $sort = "none")
    {
    	$parentCategory = Category::findOne(['slug' => $slug]);
    	$id_parent = $parentCategory->id;
    	$items = Category::find()->where(['id_parent' => $id_parent])->orderBy('title')->all(); //list of subcategories

        if (Yii::$app->user->isGuest) {
            $query = Article::find()->where(['status' => 'guest'])->andWhere(['category_id' => $id_parent]);
        } else if (Yii::$app->user->id == "101") {
            $query = Article::find()->where(['status' => 'guest'])->orWhere(['status' => 'user'])->andWhere(['category_id' => $id_parent]);
        } else if (Yii::$app->user->id == "100") {
            $query = Article::find()->where(['status' => 'guest'])->orWhere(['status' => 'user'])->orWhere(['status' => 'admin'])->andWhere(['category_id' => $id_parent]);
        }

    	if ($sort == "title") {
    		$query->orderBy(['title' => SORT_ASC]);
    	} else if ($sort == "-title") {
    		$query->orderBy(['title' => SORT_DESC]);
    	} else if ($sort == "date_create") {
    		$query->orderBy(['date_create' => SORT_ASC]);
    	} else if ($sort == "-date_create") {
    		$query->orderBy(['date_create' => SORT_DESC]);
    	} else if ($sort == "rating") {
    		$query->orderBy(['rating' => SORT_ASC]);
    	} else if ($sort == "-rating") {
    		$query->orderBy(['rating' => SORT_DESC]);
    	} else if ($sort == "date_update") {
    		$query->orderBy(['date_update' => SORT_ASC]);
    	} else if ($sort == "-date_update") {
    		$query->orderBy(['date_update' => SORT_DESC]);
    	}


    	$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10]);
    	$models = $query->offset($pages->offset)
        	->limit($pages->limit)
        	->all();

    	return $this->render('post', [
    		'items' => $items,
    		'category' => $parentCategory,
    		'models' => $models,
    		'pages' => $pages,
    	]);
    }

}
