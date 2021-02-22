<?php

use yii\db\Migration;

/**
 * Class m210222_135218_add_column_register_table
 */
class m210222_135218_add_column_register_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('register', 'ID_CARD_IMAGE_PATH', $this->string(100)->after('ID_CARD_IMAGE'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210222_135218_add_column_register_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210222_135218_add_column_register_table cannot be reverted.\n";

        return false;
    }
    */
}
