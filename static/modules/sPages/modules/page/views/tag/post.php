<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use app\modules\sPages\models\Article;

$this->title = $tag->title;
$this->params['breadcrumbs'][] = $this->title;

?>
<head>
	<style>
		.article_link{
			font-size: 25px;
			color: black;
		}

		.article_link:hover{
			text-decoration: none;
			color: #1f6155;
			transition-duration: 0.5s;
		}
	</style>
</head>

<div class="pages_of_tag">

	<h1>Tag: <?= Html::encode($this->title) ?></h1>
	<?php
		$count = count($models);
		if ($count == false) {
			echo "<h3>No articles...</h3>";
		} else{
			foreach ($models as $model) {
				$article = Article::findOne(['id' => $model->article_id]);
				$status = $article->status;

				if (Yii::$app->user->isGuest) {
		            if ($status == "guest") {
		            	echo "<div class='panel panel-default'>";
			            	echo "<div class='panel-heading'>";
				                echo "<h3><a class='article_link' href='/page/$article->slug.html'>$article->title</a></h3><br />";
								echo "$article->short_content"; 
								echo "<p align='right'>$article->date_create</p>";
			        		echo "</div>";
		        		echo "</div>";
		        	}
		        }

		        if (Yii::$app->user->id == "101") {
		            if ($status == "guest" || $status == "user") {
		      			echo "<div class='panel panel-default'>";
			            	echo "<div class='panel-heading'>";
				                echo "<h3><a class='article_link' href='/page/$article->slug.html'>$article->title</a></h3><br />";
								echo "$article->short_content"; 
								echo "<p align='right'>$article->date_create</p>";
			        		echo "</div>";
		        		echo "</div>";
		            }
		        }

		        if (Yii::$app->user->id == "100") {
	                if ($status == "guest" || $status == "user" || $status == "admin") {
		                echo "<div class='panel panel-default'>";
			            	echo "<div class='panel-heading'>";
				                echo "<h3><a class='article_link' href='/page/$article->slug.html'>$article->title</a></h3><br />";
								echo "$article->short_content"; 
								echo "<p align='right'>$article->date_create</p>";
			        		echo "</div>";
		        		echo "</div>";
		        	}
		    	}

			
			}
		}
	?>

	<?= LinkPager::widget([
		'pagination' => $pages,
	]); ?>

</div>
