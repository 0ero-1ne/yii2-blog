<?php

namespace app\modules\sPages\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $slug
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','slug'],'required'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['slug'],'match','pattern' => '/^[a-zA-Z0-9-]+$/'],
            ['title','unique','targetClass' => 'app\modules\sPages\models\Tag'],
            ['slug','unique','targetClass' => 'app\modules\sPages\models\Tag'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
        ];
    }
}
