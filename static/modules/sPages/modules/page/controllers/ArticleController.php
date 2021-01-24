<?php

namespace app\modules\sPages\modules\page\controllers;
use Yii;
use app\modules\sPages\models\Article;
use app\modules\sPages\models\Tag;
use app\modules\sPages\models\ArticleTag;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex()
    {	
    	if (Yii::$app->user->isGuest) {
    		$query = Article::find()->where(['status' => 'guest']);
    	} else if (Yii::$app->user->id == '101') {
    		//$sql = 'SELECT * FROM article WHERE status = "guest" OR status = "user"';
        	$query = Article::find()->where(['status' => 'guest'])->orWhere(['status' => 'user']);
        } else if (Yii::$app->user->id == '100') {
        	//$sql = 'SELECT * FROM article WHERE status = "guest" OR status = "user" OR status = "admin"';
        	$query = Article::find()->where(['status' => 'guest'])->orWhere(['status' => 'user'])->orWhere(['status' => 'admin']);
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
    }

    public function actionPost($slug)
    {
        $model = Article::findOne(['slug' => $slug]);
        $status = $model->status;
        $items = ArticleTag::find()->where(['article_id' => $model->id])->all();
        $tags = [];
        
        foreach ($items as $item) {
            $query = Tag::findOne(['id' => $item->tag_id]);
            $tag = $query->title;
            array_push($tags, $tag);
        }

        if (Yii::$app->user->isGuest) {
            if ($status == "admin" || $status == "user") {
                return $this->goHome();
            } else{
                return $this->render('post', compact('model','tags'));                
            }
        }

        if (Yii::$app->user->id == "101") {
            if ($status == "admin") {
                return $this->goHome();
            } else{
                return $this->render('post', compact('model','tags'));   
            }
        }

        return $this->render('post', compact('model','tags'));
    }

    public function actionSaveMark($mark, $ip, $article_id)
    {
        echo "$mark<br />$ip<br />$article_id";
    }
}
