<?php

namespace app\modules\sPages\modules\adminPanel\models;

use Yii;
use yii\base\Model;

class CategoryCreatingForm extends Model
{
    public $title;
    public $slug;
    public $idParent;
    public $status;

    public function rules()
    {
        return [
            [['title','slug','status','idParent'],'required'],
            [['slug'],'match','pattern' => '/^[a-zA-Z0-9-]+$/'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'slug' => 'Slug',
            'status' => 'Status',
            'idParent' => 'Parent Id'
        ];
    }

}
