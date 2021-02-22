<?php

use yii\db\Migration;

/**
 * Class m210222_134958_edit_column_register_table
 */
class m210222_134958_edit_column_register_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $query = "ALTER TABLE register MODIFY IS_AGREE ENUM('0','1') default '0'";
        $this->execute($query);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210222_134958_edit_column_register_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210222_134958_edit_column_register_table cannot be reverted.\n";

        return false;
    }
    */
}
