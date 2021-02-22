<?php

use yii\db\Migration;

/**
 * Class m210222_133943_add_column_register_table
 */
class m210222_133943_add_column_register_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('register', 'PREFIX', $this->string(100)->after('FB_PICTURE'));
        $this->addColumn('register', 'ID_CARD_NO', $this->string(100)->after('EMAIL'));
        $this->addColumn('register', 'ID_CARD_IMAGE', $this->string(100)->after('ID_CARD_NO'));
        $this->addColumn('register', 'BIRTHDAY', $this->date()->after('ID_CARD_IMAGE'));
        $this->addColumn('register', 'IS_AGREE', $this->integer()->after('IP'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210222_133943_add_column_register_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210222_133943_add_column_register_table cannot be reverted.\n";

        return false;
    }
    */
}
