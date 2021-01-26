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

    public function actionPost($slug)
    {	
    	$tag = Tag::findOne(['slug' => $slug]);
    	$tag_id = $tag->id;

    	$query = ArticleTag::find()->where(['tag_id' => $tag_id]);

    	$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10]);
    	$models = $query->offset($pages->offset)
        	->limit($pages->limit)
        	->all();

    	return $this->render('post', [
    		'pages' => $pages,
    		'models' => $models,
    		'tag' => $tag,
    	]);
    }

}