<?php

namespace app\modules\sPages\models;

use Yii;

/**
 * This is the model class for table "marks".
 *
 * @property int $id
 * @property int|null $article_id
 * @property string|null $ip_addr
 * @property int|null $mark
 */
class Marks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id','mark','ip_addr'],'required'],
            [['article_id', 'mark'], 'integer'],
            [['ip_addr'], 'string', 'max' => 255],
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
            'ip_addr' => 'Ip Addr',
            'mark' => 'Mark',
        ];
    }
}
