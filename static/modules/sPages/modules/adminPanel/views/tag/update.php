<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Update tag';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to update a tag:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'w0',
        'layout' => 'default'
        /*'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],*/
    ]); ?>

    <?= $form->field($model, 'title', ['inputOptions' => ['id' => 'tag-title']])->textInput(['maxLenght' => true]) ?>

    <p>Current title: <?= $tag->title ?></p><br />

    <?= $form->field($model, 'slug', ['inputOptions' => ['id' => 'tag-slug']])->textInput(['maxLenght' => true]) ?>

    <p>Current slug: <?= $tag->slug ?></p><br />

    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>

    <?php ActiveForm::end(); ?>

</div>
