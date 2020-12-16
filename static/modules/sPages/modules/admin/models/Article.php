<?php

namespace app\modules\sPages\modules\admin\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $author
 * @property int|null $category_id
 * @property int|null $tag_id
 * @property string|null $date_create
 * @property string|null $date_update
 * @property string|null $status
 * @property string|null $content
 * @property string|null $short_content
 * @property int|null $raiting
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','author','status','content','short_content','date_create','date_update','tag_id','category_id','raiting','slug'],'required'],
            [['category_id', 'tag_id', 'raiting'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
            [['content', 'short_content'], 'string'],
            [['title', 'slug', 'author', 'status'], 'string', 'max' => 255],
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
            'author' => 'Author',
            'category_id' => 'Category ID',
            'tag_id' => 'Tag ID',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'status' => 'Status',
            'content' => 'Content',
            'short_content' => 'Short Content',
            'raiting' => 'Raiting',
        ];
    }
}
