<?php

use yii\db\Migration;

/**
 * Class m190616_060132_add_steps_table
 */
class m190616_060132_add_steps_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('clients', 'password', 'Character varying(255)');

        $this->getDb()->createCommand('CREATE TABLE "states"(
    "id" Bigint NOT NULL,
 "client" Bigint,
 "steps" Character varying
)
;')->execute();

        $this->getDb()->createCommand('COMMENT ON COLUMN "states"."id" IS \'Идентификатор записи\'    ;')->execute();
        $this->getDb()->createCommand('COMMENT ON COLUMN "states"."client" IS \'Клиент\'
    ;')->execute();
        $this->getDb()->createCommand('COMMENT ON COLUMN "states"."steps" IS \'JSON полей\'
    ;')->execute();

        $this->getDb()->createCommand('CREATE INDEX "idx_states_client" ON "states" ("client")
    ;')->execute();


        $this->getDb()->createCommand('ALTER TABLE "states" ADD CONSTRAINT "ui_states" PRIMARY KEY ("id")')->execute();


        $this->getDb()->createCommand('ALTER TABLE "states" ADD CONSTRAINT "fk_client_states" FOREIGN KEY ("client") REFERENCES "clients" ("id") ON DELETE CASCADE ON UPDATE NO ACTION;
        ')->execute();


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190616_060132_add_steps_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190616_060132_add_steps_table cannot be reverted.\n";

        return false;
    }
    */
}
