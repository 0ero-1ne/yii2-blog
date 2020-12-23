<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ArticleTag}}`.
 */
class m201223_200312_create_ArticleTag_table extends Migration
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
