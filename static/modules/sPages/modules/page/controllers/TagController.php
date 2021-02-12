<?php

namespace app\modules\sPages\modules\page\controllers;
use Yii;
use app\modules\sPages\models\Tag;
use app\modules\sPages\models\Article;
use app\modules\sPages\models\ArticleTag;
use yii\data\Pagination;

class TagController extends \yii\web\Controller
{
    public function actionIndex()
    {	
    	$query = Tag::find();
    	$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10]);
	    $models = $query->offset($pages->offset)
	        ->limit($pages->limit)
	        ->all();

        return $this->render('index', [
        	'models' => $models,
        	'pages' => $pages,
        ]);
    }

    public function actionPost($slug, $sort = "none")
    {	
    	$tag = Tag::findOne(['slug' => $slug]);
    	$tag_id = $tag->id;

        if (Yii::$app->user->isGuest) {
            $query = ArticleTag::find()->where(['article_status' => 'guest'])->andWhere(['tag_id' => $tag_id]);
        } else if (Yii::$app->user->id == "101") {
            $query = ArticleTag::find()->where(['article_status' => 'guest'])->orWhere(['article_status' => 'user'])->andWhere(['tag_id' => $tag_id]);
        } else if (Yii::$app->user->id == "100") {
            $query = ArticleTag::find()->where(['article_status' => 'guest'])->orWhere(['article_status' => 'user'])->orWhere(['article_status' => 'admin'])->andWhere(['tag_id' => $tag_id]);
        }

        if ($sort == "title") {
            $query->orderBy(['article_title' => SORT_ASC]);
        } else if ($sort == "-title") {
            $query->orderBy(['article_title' => SORT_DESC]);
        } else if ($sort == "date_create") {
            $query->orderBy(['article_datecr' => SORT_ASC]);
        } else if ($sort == "-date_create") {
            $query->orderBy(['article_datecr' => SORT_DESC]);
        } else if ($sort == "rating") {
            $query->orderBy(['article_rating' => SORT_ASC]);
        } else if ($sort == "-rating") {
            $query->orderBy(['article_rating' => SORT_DESC]);
        } else if ($sort == "date_update") {
            $query->orderBy(['article_dateup' => SORT_ASC]);
        } else if ($sort == "-date_update") {
            $query->orderBy(['article_dateup' => SORT_DESC]);
        }

    	$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10]);
    	$models = $query->offset($pages->offset)
        	->limit($pages->limit)
        	->all();

        $sort_type = $sort;

    	return $this->render('post', [
    		'pages' => $pages,
    		'models' => $models,
    		'tag' => $tag,
            'sort_type' => $sort_type,
    	]);
    }

}
