<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\sPages\modules\adminPanel\models\Tag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tag-form">

    <?php $form = ActiveForm::begin([
        'id' => 'w0',
        'layout' => 'default',
    ]); ?>

    <?= $form->field($model, 'title', ['inputOptions' => ['id' => 'tag-title']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug', ['inputOptions' => ['id' => 'tag-slug']])->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
