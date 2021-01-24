<?php

namespace app\modules\sPages\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $id_parent
 * @property string|null $slug
 * @property string|null $status
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','slug','status','id_parent'],'required'],
            [['id_parent'], 'integer'],
            [['slug'],'match','pattern' => '/^[a-zA-Z0-9-]+$/'],
            [['title', 'slug', 'status'], 'string', 'max' => 255],
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
            'id_parent' => 'Id Parent',
            'slug' => 'Slug',
            'status' => 'Status',
        ];
    }
}
