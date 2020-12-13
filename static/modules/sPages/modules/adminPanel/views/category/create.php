<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Create category';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to create a category:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'w0',
        'layout' => 'default'
        /*'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],*/
    ]); ?>

    <?= $form->field($model, 'title', ['inputOptions' => ['id' => 'category-title']])->textInput() ?>

    <?= $form->field($model, 'idParent', ['inputOptions' => ['id' => 'category-idParent']])->textInput()?>

    <?= $form->field($model, 'slug', ['inputOptions' => ['id' => 'category-slug']])->textInput() ?>

    <?= $form->field($model, 'status', ['inputOptions' => ['id' => 'category-status']])->dropDownList([
        '1' => 'guest',
        '2' => 'user',
        '3' => 'admin',
        '4' => 'link'
    ]) ?>

    <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>

    <?php ActiveForm::end(); ?>

</div>
