<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ArticleTag}}`.
 */
class m201230_183658_create_ArticleTag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ArticleTag}}', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer(),
            'tag_id' => $this->integer(),
            'article_status' => $this->string(),
            'article_title' => $this->string(),
            'article_datecr' => $this->date(),
            'article_dateup' => $this->date(),
            'article_rating' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ArticleTag}}');
    }
}
