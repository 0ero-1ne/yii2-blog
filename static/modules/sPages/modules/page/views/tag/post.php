<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use app\modules\sPages\models\Article;

$this->title = $tag->title;
$this->params['breadcrumbs'][] = $this->title;

?>
<head>
	
</head>

<div class="pages_of_tag">

	<h1>Tag: <?= Html::encode($this->title) ?></h1>
	<?php
		if ($models == false) {
			echo "<h3>No articles... :(</h3>";
		} else {
			foreach ($models as $model) {
				$article = Article::findOne(['id' => $model->article_id]);
				echo "<div class='panel panel-default'>";
	            	echo "<div class='panel-heading'>";
		                echo "<h3><a class='article_link' href='/page/$article->slug.html'>$article->title</a></h3><br />";
						echo "$article->short_content"; 
						echo "<p align='right'>$article->date_create</p>";
						echo "<p align='right'>Average rating of users: <b>$article->rating</b></p>";
	        		echo "</div>";
        		echo "</div>";
			}
		}
	?>

	<?= LinkPager::widget([
		'pagination' => $pages,
	]); ?>

</div>
