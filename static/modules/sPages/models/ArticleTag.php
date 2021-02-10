<?php

namespace app\modules\sPages\models;

use Yii;

/**
 * This is the model class for table "articletag".
 *
 * @property int $id
 * @property int|null $article_id
 * @property int|null $tag_id
 */
class ArticleTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articletag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'tag_id'], 'integer'],
            ['article_status', 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'tag_id' => 'Tag ID',
            'article_status' => 'Article status',
        ];
    }
}
