<?php

use yii\db\Migration;

/**
 * Class m190615_151830_retype_username
 */
class m190615_151830_retype_username extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('clients', 'username', 'Character varying(64)');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190615_151830_retype_username cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190615_151830_retype_username cannot be reverted.\n";

        return false;
    }
    */
}
