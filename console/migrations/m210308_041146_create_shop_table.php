<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop}}`.
 */
class m210308_041146_create_shop_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop}}', [
            'id' => $this->primaryKey(),
            'shop_name' => $this->string(100),
            'is_active' => 'integer default 1',
        ]);

        $this->alterColumn('{{%shop}}', 'id', $this->integer(11).' NOT NULL AUTO_INCREMENT');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop}}');
    }
}
