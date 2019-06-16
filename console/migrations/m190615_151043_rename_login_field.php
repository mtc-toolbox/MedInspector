<?php

use yii\db\Migration;

/**
 * Class m190615_151043_rename_login_field
 */
class m190615_151043_rename_login_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('clients', 'login', 'username');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190615_151043_rename_login_field cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190615_151043_rename_login_field cannot be reverted.\n";

        return false;
    }
    */
}
