<?php

use yii\db\Migration;

/**
 * Class m190615_165645_relation_bugfix
 */
class m190615_165645_relation_bugfix extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {


        $this->getDb()->createCommand('
            ALTER TABLE cities
  DROP CONSTRAINT fk_regions_cities RESTRICT;
        ')->execute();


        $this->alterColumn('clients', 'status', 'Character varying(64)');


        $this->getDb()->createCommand('DROP INDEX idx_cities_region;');

        $this->dropColumn('cities', 'region');

        $this->addColumn('cities', 'region', 'Bigint');

        $this->addCommentOnColumn('cities', 'region', 'Регион');

        $this->createIndex('idx_cities_region', 'cities', ['region']);


        $this->getDb()->createCommand('
            ALTER TABLE "cities" ADD CONSTRAINT "fk_region_cities" FOREIGN KEY ("region") REFERENCES "regions" ("id") ON DELETE CASCADE ON UPDATE NO ACTION;
        ')->execute();

        $this->getDb()->createCommand('
            ALTER TABLE polyclinics
  DROP CONSTRAINT fk_cities_polyclinics RESTRICT;
        ')->execute();

        $this->getDb()->createCommand('DROP INDEX idx_polyclinics_city;');

        $this->dropColumn('polyclinics', 'city');

        $this->addColumn('polyclinics', 'city', 'Bigint');

        $this->addCommentOnColumn('polyclinics', 'city', 'Населённый пункт');

        $this->createIndex('idx_polyclinics_city', 'polyclinics', ['city']);

        $this->getDb()->createCommand('
            ALTER TABLE "polyclinics" ADD CONSTRAINT "fk_cities_polyclinics" FOREIGN KEY ("city") REFERENCES "cities" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;
        ')->execute();


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190615_165645_relation_bugfix cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190615_165645_relation_bugfix cannot be reverted.\n";

        return false;
    }
    */
}
