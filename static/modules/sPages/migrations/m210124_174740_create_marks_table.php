<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%marks}}`.
 */
class m210124_174740_create_marks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%marks}}', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer(),
            'ip_addr' => $this->string(),
            'mark' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%marks}}');
    }
}
