<?php

namespace app\modules\sPages\modules\adminPanel\models;

use Yii;
use yii\db\IntegrityException;
use yii\base\Model;

class TagCreatingForm extends Model
{
    public $title;
    public $slug;

    public function rules()
    {
        return [
            [['title','slug'],'required'],
            [['slug'],'match','pattern' => '/^[a-zA-Z0-9-]+$/'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'slug' => 'Slug'
        ];
    }

}
