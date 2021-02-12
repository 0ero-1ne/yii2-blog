<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;

?>
<head>
	<style>
		.category_link{
			font-size: 20px;
			color: black;
		}

		.category_link:hover{
			text-decoration: none;
			color: #1f6155;
			transition-duration: 1.2s;
		}
	</style>
</head>

<div class="tag-index">

    <h1><?= Html::encode($this->title) ?></h1>
	
	<?php foreach($models as $model): ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<a class="category_link" href="/page/category/<?=$model->slug?>.html"><?= $model->title ?></a>
			</div>
		</div>
	<?php endforeach; ?>

	<?= LinkPager::widget([
		'pagination' => $pages,
	]); ?>

</div>