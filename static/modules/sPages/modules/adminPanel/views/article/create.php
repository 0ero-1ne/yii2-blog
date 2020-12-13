<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Create article';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to create an article:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'w0',
        'layout' => 'default'
        /*'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],*/
    ]); ?>

    <?= $form->field($model, 'author', ['inputOptions' => ['id' => 'article-author']])->textInput() ?>
    <?= $form->field($model, 'title', ['inputOptions' => ['id' => 'article-title']])->textInput() ?>
    <?= $form->field($model, 'slug', ['inputOptions' => ['id' => 'article-slug']])->textInput() ?>
    <?= $form->field($model, 'shortContent', ['inputOptions' => ['id' => 'article-short_content']])->textarea(['rows' => '2']) ?>
    <?= $form->field($model, 'content', ['inputOptions' => ['id' => 'article-content']])->textarea(['rows' => '10']) ?>
    <?= $form->field($model, 'raiting', ['inputOptions' => ['id' => 'article-raiting']])->textInput() ?>
    <?= $form->field($model, 'status', ['inputOptions' => ['id' => 'article-status']])->dropDownList([
        '1' => 'guest',
        '2' => 'user',
        '3' => 'admin',
        '4' => 'link'
    ]) ?>


    <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>

    <?php ActiveForm::end(); ?>

</div>
