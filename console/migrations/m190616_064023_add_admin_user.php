<?php

use yii\db\Migration;

/**
 * Class m190616_064023_add_admin_user
 */
class m190616_064023_add_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->getDb()->createCommand('INSERT INTO "clients" ("id", "polyclinic", "oms", "username", "fullname", "role", "auth_key", "password_reset_token", "email", 
        "status", "verification_token", "created_at", "deleted_at", "password") VALUES (1000, NULL, E\'1\', E\'admin\', E\'Иванов Иван\', E\'ADMIN\', NULL, NULL, E\'softarts@mail.ru\', 10, NULL, NULL, NULL, E\'123321\');')->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190616_064023_add_admin_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190616_064023_add_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
