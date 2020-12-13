<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;

$this->title = 'Categories List';
$this->params['breadcrumbs'][] = $this->title;
?>

<head>
	<style>
		h1{
			font-family: 'Poppins', sans-serif;
			width: 150px;
			height: 50px;
		}

		.head{
			display: flex;
			justify-content: space-around;
			align-items: center;
			padding: 0px 20px;
			margin-bottom: 20px;
		}

		.btn-success{
			height: 50px;
			font-size: 25px;
			padding: 8px;
		}
		
		.btn-success:hover{
			text-decoration: none;
		}

		.table{
			padding: 20px 20px;
		}

		.panel-heading{
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.links a:hover{
			text-decoration: none;
		}
	</style>

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
	<div class="head">
		<h1>Categories</h1>
		<a class="btn-success" href="create">Create</a>
	</div>

</body>