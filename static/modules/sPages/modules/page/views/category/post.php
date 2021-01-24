<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use app\modules\sPages\models\Article;
use app\modules\sPages\models\Tag;

$this->title = $category->title;
$this->params['breadcrumbs'][] = $this->title;

?>
<head>
	<style>
		.category_link{
			font-size: 20px;
		}

		.sort_link{
			color: black;
		}

		.sort_link:hover{
			text-decoration: none;
		}

		span{
			padding: 10px 5px;
		}

		.sorts{
			font-size: 20px;
		}
	</style>
</head>

<div class="pages_of_categories">

	<h1>Category: <?= Html::encode($this->title) ?></h1>

	<?php
		if (count($items) == false) {
			echo "<br /><h3>No subcategories...</h3>";
		} else{
			echo "<br /><h3>Subcategory list:</h3>";
			echo "<ul>";
			foreach ($items as $item) {
				if(Yii::$app->user->isGuest){
					if ($item->status == "guest") {
						echo "<li><a class='category_link' href='/page/category/$item->slug.html?sort=title'>$item->title</a></li>";
					}
				} else if (Yii::$app->user->id == "101") {
					if ($item->status == "guest" || $item->status == "user") {
						echo "<li><a class='category_link' href='/page/category/$item->slug.html?sort=title'>$item->title</a></li>";
					}
				} else if (Yii::$app->user->id == "100") {
					if ($item->status == "guest" || $item->status == "user" || $item->status == "admin") {
						echo "<li><a class='category_link' href='/page/category/$item->slug.html?sort=title'>$item->title</a></li>";
					}
				}
			}
			echo "</ul>";
		}
	?>

	<?php
		echo "<h3>Articles:</h3>";
		
		echo "<div class='sorts'>";

		echo "<span><a class='sort_link' href='?sort=-date_create'>New first</a></span> |";
		
		echo " <span><a class='sort_link' href='?sort=title'>Title(A-Z)</a></span> |";
		
		echo " <span><a class='sort_link' href='?sort=-title'>Title(Z-A)</a></span> |";
		
		echo " <span><a class='sort_link' href='?sort=raiting'>Popular</a></span>";
		
		echo "</div><br />";

		foreach ($models as $model) {
			$article = Article::findOne(['id' => $model->id]);
			$status = $article->status;
			$q = 0;

			if (Yii::$app->user->isGuest) {
	            if ($status == "guest") {
	            	echo "<div class='panel panel-default'>";
		            	echo "<div class='panel-heading'>";
			                echo "<h3><a class='article_link' href='/page/$article->slug.html'>$article->title</a></h3><br />";
							echo "$article->short_content"; 
							echo "<p align='right'>$article->date_create</p>";
		        		echo "</div>";
	        		echo "</div>";
	        		$q++;
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
					$q++;
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
	        		$q++;
	        	}
	    	}
		}

		if ($q == 0 || count($models) == 0){
			echo "<h3>No articles...</h3>";
		}
	?>

	<?= LinkPager::widget([
		'pagination' => $pages,
	]); ?>

</div>
