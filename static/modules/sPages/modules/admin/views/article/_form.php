<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\sPages\models\Tag;
use app\modules\sPages\models\Category;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\sPages\modules\adminPanel\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin([
        'id' => 'w0',
        'layout' => 'default',
    ]); ?>

    <?= $form->field($model, 'title', ['inputOptions' => ['id' => 'article-title']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug', ['inputOptions' => ['id' => 'article-slug']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author', ['inputOptions' => ['id' => 'article-author']])->textInput(['maxlength' => true]) ?>

    <?php
        $categories = Category::find()->all();
        $items = ArrayHelper::map($categories,'id','title');
        $options = [
            'prompt' => 'Select category...',
        ];
    ?>

    <?= $form->field($model, 'category_id', ['inputOptions' => ['id' => 'article-category']])->dropDownList($items, $options) ?>

    <?php
        $tags = Tag::find()->all();
        $items = ArrayHelper::map($tags,'id','title');
        $options = [
            'multiple' => 'multiple',
            'size' => '10',
        ];
    ?>

    <?= $form->field($model, 'tag_id', ['inputOptions' => ['id' => 'article-tags']])->dropDownList($items, $options) ?>

    <!-- $form->field($model, 'date_create', ['inputOptions' => ['id' => 'article-date_create']])->textInput() -->

    <!-- $form->field($model, 'date_update', ['inputOptions' => ['id' => 'article-date_update']])->textInput() -->

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

    <?= $form->field($model, 'short_content', ['inputOptions' => ['id' => 'article-short_content']])->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'content', ['inputOptions' => ['id' => 'article-content']])->textarea(['rows' => 8]) ?>

    <?= $form->field($model, 'rating', ['inputOptions' => ['id' => 'article-rating']])->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
