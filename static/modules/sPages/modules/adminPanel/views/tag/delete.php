<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Delete tag';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Confirm the removal of the tag by entering its title:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'w0',
        'layout' => 'default'
    ]); ?>

    <?= $form->field($model, 'title', ['inputOptions' => ['id' => 'tag-title']])->textInput(['maxLenght' => true]) ?>

    <p>Current title: <?= $tag->title ?></p><br />

    <?= Html::submitButton('Delete', ['class' => 'btn btn-primary', 'name' => 'delete-button']) ?>

    <?php ActiveForm::end(); ?>

</div>
