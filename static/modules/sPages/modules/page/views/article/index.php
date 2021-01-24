<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\sPages\modules\adminPanel\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<head>
	<style>
		.article_link{
			color: black;
		}

		.article_link:hover{
			text-decoration: none;
			color: #1f6155;
			transition-duration: 1.2s;
		}
	</style>
</head>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
	
	<?php foreach($models as $model): ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3><a class="article_link" href="/page/<?= $model->slug ?>.html"><?= $model->title ?></a></h2><br />
				<?= $model->short_content ?>
				<p align="right"><?= $model->date_create ?></p>		
			</div>
		</div>
	<?php endforeach; ?>

	<?= LinkPager::widget([
		'pagination' => $pages,
	]); ?>
	
</div>
