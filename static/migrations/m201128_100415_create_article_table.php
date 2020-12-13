<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article}}`.
 */
class m201128_100415_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'slug' => $this->string(),
            'author' => $this->string(),
            'category_id' => $this->integer(),
            'tag_id' => $this->integer(),
            'date_create' => $this->dateTime(),
            'date_update' => $this->dateTime(),
            'status' => $this->string(),
            'content' => $this->text(),
            'short_content' => $this->text(),
            'raiting' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article}}');
    }
}
