<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\sPages\models\Tag;
use app\modules\sPages\models\Marks;

$ip = $_SERVER['REMOTE_ADDR'];
$article_id = $model->id;
$findUserByIpInTableMark = Marks::findOne(['ip_addr' => $ip, 'article_id' => $article_id]);

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

		#rating > span:before,
		#rating > span ~ span:before {
		   content: "\2605";
		   position: absolute;
		   left: 0;
		   color: gray;
		   cursor: pointer;
		}

		#rating > span:hover:before,
		#rating > span:hover ~ span:before {
		   content: "\2605";
		   position: absolute;
		   left: 0; 
		   color: gold;
		   cursor: pointer;
		}

		<?php if ($findUserByIpInTableMark) {?>
		#rating > .star-active:before,
		#rating > .star-active ~ .star-active:before {
		   content: "\2605";
		   position: absolute;
		   left: 0; 
		   color: gold;
		   cursor: not-allowed;
		}

		#rating > .star-active:hover:before,
		#rating > .star-active:hover ~ .star-active:before {
		   content: "\2605";
		   position: absolute;
		   left: 0; 
		   color: gold;
		   cursor: not-allowed;
		}

		<?php } else{ ?>
		#rating > .star-active:before,
		#rating > .star-active ~ .star-active:before {
		   content: "\2605";
		   position: absolute;
		   left: 0; 
		   color: gold;
		   cursor: pointer;
		}

		#rating > .star-active:hover:before,
		#rating > .star-active:hover ~ .star-active:before {
		   content: "\2605";
		   position: absolute;
		   left: 0; 
		   color: gold;
		   cursor: pointer;
		}
		<?php }?>

		#rating > .not-allowed:before,
		#rating > .not-allowed ~ .not-allowed:before {
		   content: "\2605";
		   position: absolute;
		   left: 0; 
		   color: gray;
		   cursor: not-allowed;
		}

		#rating > .not-allowed:hover:before,
		#rating > .not-allowed:hover ~ .not-allowed:before {
		   content: "\2605";
		   position: absolute;
		   left: 0; 
		   color: gray;
		   cursor: not-allowed;
		}

		#rating > .not-allowed-cursor:before,
		#rating > .not-allowed-cursor ~ .not-allowed-cursor:before {
		   cursor: not-allowed;
		}

		#rating > .not-allowed-cursor:hover:before,
		#rating > .not-allowed-cursor:hover ~ .not-allowed-cursor:before {
		   cursor: not-allowed;
		}

		.star-active{

		}

		.not-allowed{
			cursor: not-allowed;
		}

		.not-allowed-cursor{
			cursor: not-allowed;
		}
	</style>
</head>
<div class="article">

    <h1><?= Html::encode($model->title) ?></h1>
	<p>Article was created on <em><?= $model->date_create ?></em></p><br />
	<h3>Tags:
		<?php
			$count = count($tags);
			if ($count == 0) echo "No tags.";
			for ($i = 0; $i < $count; $i++) {
				$query = Tag::findOne(['title' => $tags[$i]]); 
				if ($i == $count - 1) {
					echo "<a style='cursor: pointer;' href='/page/tag/$query->slug.html'>#$query->title</a>.";
				} else{
					echo "<a style='cursor: pointer;' href='/page/tag/$query->slug.html'>#$query->title</a>, ";
				}
				
			}
		?>
	</h3>
	<p class="content"><?= $model->content?></p>

	
	<?php
		if ($findUserByIpInTableMark) {
			echo "<div id='rating' class='not-allowed'>";
			for ($i = 5; $i >= 1; $i--) {
				if ($i > $findUserByIpInTableMark->mark) {
					echo "<span class='star not-allowed'>☆</span>";
				} else{
					echo "<span class='star star-active'>☆</span>";
				}
			}
			echo "</div>";
		} else{
			echo "<div id='rating'>";
			for ($i = 5; $i >= 1; $i--) {
				if ($i > $model->rating) {
					echo "<span class='star' onclick='articleMark($i)'>☆</span>";	
				} else{
					echo "<span class='star star-active' onclick='articleMark($i)'>☆</span>";
				}
			}
			echo "</div>";
		}
	?>

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
		var stars = document.getElementsByClassName("star");

		for (let i = 0; i < stars.length; i++) {
			if (stars[i].classList.contains("star-active")) {
				stars[i].classList.remove("star-active")
				console.log(stars[i]);
			}
		}

		if (mark == 1) {
			stars[4].classList.add("star-active");
			stars[4].classList.add("not-allowed-cursor");
			stars[3].classList.add("not-allowed");
			stars[2].classList.add("not-allowed");
			stars[1].classList.add("not-allowed");
			stars[0].classList.add("not-allowed");
			rating.classList.add("not-allowed");
			stars[4].removeAttribute("onclick");
			stars[3].removeAttribute("onclick");
			stars[2].removeAttribute("onclick");
			stars[1].removeAttribute("onclick");
			stars[0].removeAttribute("onclick");
		} else if (mark == 2) {
			stars[4].classList.add("star-active");
			stars[3].classList.add("star-active");
			stars[4].classList.add("not-allowed-cursor");
			stars[3].classList.add("not-allowed-cursor");
			stars[2].classList.add("not-allowed");
			stars[1].classList.add("not-allowed");
			stars[0].classList.add("not-allowed");
			rating.classList.add("not-allowed");
			stars[4].removeAttribute("onclick");
			stars[3].removeAttribute("onclick");
			stars[2].removeAttribute("onclick");
			stars[1].removeAttribute("onclick");
			stars[0].removeAttribute("onclick");
		} else if (mark == 3) {
			stars[4].classList.add("star-active");
			stars[3].classList.add("star-active");
			stars[2].classList.add("star-active");
			stars[4].classList.add("not-allowed-cursor");
			stars[3].classList.add("not-allowed-cursor");
			stars[2].classList.add("not-allowed-cursor");
			stars[1].classList.add("not-allowed");
			stars[0].classList.add("not-allowed");
			rating.classList.add("not-allowed");
			stars[4].removeAttribute("onclick");
			stars[3].removeAttribute("onclick");
			stars[2].removeAttribute("onclick");
			stars[1].removeAttribute("onclick");
			stars[0].removeAttribute("onclick");
		} else if (mark == 4) {
			stars[4].classList.add("star-active");
			stars[3].classList.add("star-active");
			stars[2].classList.add("star-active");
			stars[1].classList.add("star-active");
			stars[4].classList.add("not-allowed-cursor");
			stars[3].classList.add("not-allowed-cursor");
			stars[2].classList.add("not-allowed-cursor");
			stars[1].classList.add("not-allowed-cursor");
			stars[0].classList.add("not-allowed");
			rating.classList.add("not-allowed");
			stars[4].removeAttribute("onclick");
			stars[3].removeAttribute("onclick");
			stars[2].removeAttribute("onclick");
			stars[1].removeAttribute("onclick");
			stars[0].removeAttribute("onclick");
		} else if (mark == 5) {
			stars[4].classList.add("star-active");
			stars[3].classList.add("star-active");
			stars[2].classList.add("star-active");
			stars[1].classList.add("star-active");
			stars[0].classList.add("star-active");
			stars[4].classList.add("not-allowed-cursor");
			stars[3].classList.add("not-allowed-cursor");
			stars[2].classList.add("not-allowed-cursor");
			stars[1].classList.add("not-allowed-cursor");
			stars[0].classList.add("not-allowed-cursor");
			rating.classList.add("not-allowed");
			stars[4].removeAttribute("onclick");
			stars[3].removeAttribute("onclick");
			stars[2].removeAttribute("onclick");
			stars[1].removeAttribute("onclick");
			stars[0].removeAttribute("onclick");
		}

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
