<?php

namespace app\modules\sPages\modules\adminPanel\models;

use Yii;
use yii\base\Model;

class DeleteForm extends Model
{
    public $title;

    public function rules()
    {
        return [
            ['title','required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Title'
        ];
    }

}
