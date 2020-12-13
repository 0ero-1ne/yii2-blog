<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Articles List';
$this->params['breadcrumbs'][] = $this->title;
?>

<head>
	<style>
		h1{
			font-family: 'Poppins', sans-serif;	
			margin-bottom: 10px;
		}

		.articles, .categories{
			border: 3px double black;
			padding: 10px;
			margin-bottom: 20px;
		}

		.tags{
			border: 3px double black;
			padding: 10px;
		}

		.btn-success{
			height: 50px;
			font-size: 25px;
			padding: 8px;
		}
		
		.btn-success:hover{
			text-decoration: none;
		}
	</style>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<div align="center" class="articles">
	<h1>Articles</h1>
	<a class="btn-success" href="create">Create</a>
</div>