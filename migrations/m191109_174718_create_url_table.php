<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%url}}`.
 */
class m191109_174718_create_url_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%url}}', [
            'id' => $this->bigPrimaryKey(),
            'long_url' => $this->string(2000)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%url}}');
    }
}
