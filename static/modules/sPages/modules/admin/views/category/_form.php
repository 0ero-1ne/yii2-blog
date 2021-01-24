<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\sPages\models\Category;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\sPages\modules\adminPanel\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin([
        'id' => 'w0',
        'layout' => 'default',
    ]); ?>

    <?= $form->field($model, 'title', ['inputOptions' => ['id' => 'category-title']])->textInput(['maxlength' => true]) ?>

    <?php
        $categories = Category::find()->where(['id_parent' => -1])->all();
        $items = [
            -1 => 'Make it as parent category...',
        ];
        $items += ArrayHelper::map($categories, 'id', 'title');
        $options = [
            'prompt' => 'Select parent category...'
        ];
    ?>

    <?= $form->field($model, 'id_parent', ['inputOptions' => ['id' => 'category-id-parent']])->dropDownList($items, $options) ?>

    <?= $form->field($model, 'slug', ['inputOptions' => ['id' => 'category-slug']])->textInput(['maxlength' => true]) ?>

    <?php
    	$items = [
        	'guest' => 'Guest',
        	'admin' => 'Admin',
        	'user' => 'User',
        	'link' => 'Link',
    	];

	    $params = [
	        'prompt' => 'Select status...',
	    ];
    ?>

    <?= $form->field($model, 'status', ['inputOptions' => ['id' => 'category-status']])->dropDownList($items, $params) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
