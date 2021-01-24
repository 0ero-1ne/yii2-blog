<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\sPages\models\Tag;

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\sPages\modules\adminPanel\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title;
//$this->params['breadcrumbs'][] = $this->title;
?>
<head>
	<style>
		.content{
			margin-top: 20px;
			font-size: 25px;
		}

		#rating {
		  unicode-bidi: bidi-override;
		  direction: rtl;
		  text-align: left;
		}
		
		#rating > span {
		  display: inline-block;
		  position: relative;
		  width: 1.1em;
		  font-size: 50px;
		}
		
		#rating > span:hover,
		#rating > span:hover ~ span {
		  color: transparent;
		}
		
		#rating > span:hover:before,
		#rating > span:hover ~ span:before {
		   content: "\2605";
		   position: absolute;
		   left: 0; 
		   color: gold;
		   cursor: pointer;
		}

		.star-active{

		}

	</style>
</head>
<div class="article">

    <h1><?= Html::encode($model->title) ?></h1>
	<p>Article was created on <em><?= $model->date_create ?></em></p><br />
	<h3>Tags:
		<?php
			$count = count($tags);
			for ($i = 0; $i < $count; $i++) {
				$query = Tag::findOne(['title' => $tags[$i]]); 
				if ($i == $count - 1) {
					echo "<a style='cursor: pointer;' href='/page/tag/$query->slug.html'>#$query->title</a>.";
				} else{
					echo "<a style='cursor: pointer;' href='/page/tag/$query->slug.html'>#$query->title</a>, ";
				}
				
			}
			$ip = $_SERVER['REMOTE_ADDR'];
		?>
	</h3>
	<p class="content"><?= $model->content?></p>

	<div id="rating">
		<span onclick="articleMark(5)">☆</span>
		<span onclick="articleMark(4)">☆</span>
		<span onclick="articleMark(3)">☆</span>
		<span onclick="articleMark(2)">☆</span>
		<span onclick="articleMark(1)">☆</span>
	</div>

	<p><em><b>Average raiting of users:</b> <?= $model->raiting?></em></p>
</div>

<script type="text/javascript">
	var url = "http://static.by/page/article/save-mark.html";
	var ip = '<?php echo $ip; ?>';
	var article_id = '<?= $model->id?>';

	function getGoodMessage(){
		alert("The vote has been accepted");
	}

	function getBadMessage(){
		alert("The vote hasn't been accepted. Refresh page and try again. If it didn't help you, tell us about your problem!");
	}

	function articleMark(mark){
		let xhr = new XMLHttpRequest();

		xhr.onreadystatechange = function(){
			if (this.readyState === 4 && this.status === 200) {
				getGoodMessage();
				console.log(mark);
			} else if (this.readyState === 4 && this.status !== 200) {
				getBadMessage();
				console.log(mark);
			}
		}

		let markData = "mark=" + mark + "&ip=" + ip + "&article_id=" + article_id;

		xhr.open("GET", url + "?" + markData, true);
		//xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		xhr.send();
	}
</script>
