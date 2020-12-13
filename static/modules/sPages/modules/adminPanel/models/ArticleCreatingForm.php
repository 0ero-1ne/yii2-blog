<?php

namespace app\modules\sPages\modules\adminPanel\models;

use Yii;
use yii\base\Model;

class ArticleCreatingForm extends Model
{
    public $author;
    public $title;
    public $slug;
    public $content;
    public $shortContent;
    public $tagId;
    public $categoryId;
    public $status;
    public $dateCreate;
    public $dateUpdate;
    public $raiting;

    public function rules()
    {
        return [
            [['author','title','slug','content','shortContent','tagId','categoryId','status','raiting'],'required'],
            [['slug'],'match','pattern' => '/^[a-zA-Z0-9-]+$/'],
            [['dateCreate','dateUpdate'],'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'auhtor' => 'Author',
            'title' => 'Title',
            'slug' => 'Slug',
            'content' => 'Content(may contain HTML)',
            'shortContent' => 'Short content(may contain HTML)',
            'status' => 'Status',
            'raiting' => 'Raiting',
            'categoryId' => 'Category',
            'tagId' => 'Tag',
        ];
    }

}
