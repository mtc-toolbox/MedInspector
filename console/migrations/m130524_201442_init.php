<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $this->getDb()->createCommand('

DELETE FROM migration;

')->execute();

        $this->getDb()->createCommand('
CREATE TABLE "clients"(
 "id" BigSerial NOT NULL,
 "polyclinic" Bigint,
 "oms" Character varying(16) NOT NULL,
 "login" Bit varying NOT NULL,
 "fullname" Character varying(128),
 "role" Character varying(32),
 "auth_key" Character varying(32),
 "password_reset_token" Character varying,
 "email" Character varying NOT NULL,
 "status" Integer DEFAULT 10,
 "verification_token" Bigint,
 "created_at" Timestamp,
 "deleted_at" Timestamp
);')->execute();

        $this->getDb()->createCommand('
COMMENT ON TABLE "clients" IS \'Пользователи\';
;')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "clients"."id" IS \'Идентификатор записи\'
;')->execute();
        $this->getDb()->createCommand('
COMMENT ON COLUMN "clients"."polyclinic" IS \'Учреждение по умолчанию\'
;')->execute();
        $this->getDb()->createCommand('
COMMENT ON COLUMN "clients"."oms" IS \'ОМС\'
;')->execute();
        $this->getDb()->createCommand('
COMMENT ON COLUMN "clients"."login" IS \'Логин\'
;')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "clients"."fullname" IS \'ФИО\'
;')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "clients"."role" IS \'Роль\'
;')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "clients"."email" IS \'E-mail\'
;')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "clients"."status" IS \'Статус учётной записи\'
;')->execute();
        $this->getDb()->createCommand('
COMMENT ON COLUMN "clients"."created_at" IS \'Время создания\'
;')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "clients"."deleted_at" IS \'Время удаления\'
;')->execute();

        $this->getDb()->createCommand('
CREATE INDEX "idx_clients_polyclinic" ON "clients" ("polyclinic")
;
')->execute();

        $this->getDb()->createCommand('
CREATE INDEX "idx_fullname" ON "clients" ("fullname")
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "clients" ADD CONSTRAINT "clients_id" PRIMARY KEY ("id")
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "clients" ADD CONSTRAINT "clients_login" UNIQUE ("login")
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "clients" ADD CONSTRAINT "clients_oms" UNIQUE ("oms")
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "clients" ADD CONSTRAINT "email" UNIQUE ("email")
;
')->execute();

        $this->getDb()->createCommand('
CREATE TABLE "regions"(
 "id" BigSerial NOT NULL,
 "name" Character varying(64) NOT NULL
)
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON TABLE "regions" IS \'Регионы\'
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "regions"."id" IS \'Идентификатор записи\'
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "regions"."name" IS \'Наименование\'
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "regions" ADD CONSTRAINT "regions_id" PRIMARY KEY ("id")
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "regions" ADD CONSTRAINT "regions_name" UNIQUE ("name")
;
')->execute();

        $this->getDb()->createCommand('
CREATE TABLE "cities"(
 "id" BigSerial NOT NULL,
 "region" Character varying(64),
 "name" Character varying(64) NOT NULL
)
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON TABLE "cities" IS \'Города\'
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "cities"."id" IS \'Идентификатор записи\'
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "cities"."name" IS \'Наименование\'
;
')->execute();

        $this->getDb()->createCommand('

CREATE INDEX "idx_cities_region" ON "cities" ("region")
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "cities" ADD CONSTRAINT "cities_id" PRIMARY KEY ("id")
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "cities" ADD CONSTRAINT "cities_name" UNIQUE ("name")
;
')->execute();

        $this->getDb()->createCommand('
CREATE TABLE "polyclinics"(
 "id" BigSerial NOT NULL,
 "city" Character varying(64),
 "name" Character varying(64) NOT NULL
)
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON TABLE "polyclinics" IS \'Регионы\'
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "polyclinics"."id" IS \'Идентификатор записи\'
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "polyclinics"."city" IS \'Населённый пункт\'
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "polyclinics"."name" IS \'Наименование\'
;
')->execute();

        $this->getDb()->createCommand('
CREATE INDEX "idx_polyclinics_city" ON "polyclinics" ("city")
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "polyclinics" ADD CONSTRAINT "polyclinics_id" PRIMARY KEY ("id")
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "polyclinics" ADD CONSTRAINT "polyclinics_name" UNIQUE ("name")
;
')->execute();

        $this->getDb()->createCommand('
CREATE TABLE "speciality"(
 "id" BigSerial NOT NULL,
 "name" Character varying(64) NOT NULL
)
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON TABLE "speciality" IS \'Специализация\'
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "speciality"."id" IS \'Идентификатор записи\'
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "speciality"."name" IS \'Наименование\'
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "speciality" ADD CONSTRAINT "speciality_id" PRIMARY KEY ("id")
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "speciality" ADD CONSTRAINT "speciality_name" UNIQUE ("name")
;
')->execute();

        $this->getDb()->createCommand('
CREATE TABLE "polyclinic_speciality"(
 "id" BigSerial NOT NULL,
 "polyclinic" Bigint,
 "speciality" Bigint
)
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "polyclinic_speciality"."id" IS \'Идентификатор записи\'
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "polyclinic_speciality"."polyclinic" IS \'Поликлиника\'
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "polyclinic_speciality"."speciality" IS \'Специализация\'
;
')->execute();

        $this->getDb()->createCommand('
CREATE INDEX "idx_polyclinic_speciality_speciality" ON "polyclinic_speciality" ("speciality")
;
')->execute();

        $this->getDb()->createCommand('
CREATE INDEX "idx_polyclinic_speciality_polyclinic" ON "polyclinic_speciality" ("polyclinic")
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "polyclinic_speciality" ADD CONSTRAINT "polyclinic_speciality_id" PRIMARY KEY ("id")
;
')->execute();

        $this->getDb()->createCommand('
CREATE TABLE "doctors"(
 "id" BigSerial NOT NULL,
 "polyclinics_speciality" Bigint,
 "fullname" Character varying(128)
)
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON TABLE "doctors" IS \'Пользователи\'
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "doctors"."id" IS \'Идентификатор записи\'
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "doctors"."polyclinics_speciality" IS \'Специальность\'
;
')->execute();

        $this->getDb()->createCommand('
COMMENT ON COLUMN "doctors"."fullname" IS \'ФИО\'
;
')->execute();

        $this->getDb()->createCommand('
CREATE INDEX "idx_doctors_clients_polyclinic" ON "doctors" ("polyclinics_speciality")
;
')->execute();

        $this->getDb()->createCommand('
CREATE INDEX "idx_doctors_fullname" ON "doctors" ("fullname")
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "doctors" ADD CONSTRAINT "doctors_id" PRIMARY KEY ("id")
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "cities" ADD CONSTRAINT "fk_regions_cities" FOREIGN KEY ("region") REFERENCES "regions" ("name") ON DELETE CASCADE ON UPDATE NO ACTION
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "polyclinics" ADD CONSTRAINT "fk_cities_polyclinics" FOREIGN KEY ("city") REFERENCES "cities" ("name") ON DELETE CASCADE ON UPDATE NO ACTION
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "clients" ADD CONSTRAINT "fk_polyclinics_clients" FOREIGN KEY ("polyclinic") REFERENCES "polyclinics" ("id") ON DELETE SET NULL ON UPDATE NO ACTION
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "polyclinic_speciality" ADD CONSTRAINT "fk_speciality_polyclinic_speciality" FOREIGN KEY ("speciality") REFERENCES "speciality" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "polyclinic_speciality" ADD CONSTRAINT "fk_polyclinic_polyclinic_speciality" FOREIGN KEY ("polyclinic") REFERENCES "polyclinics" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
;
')->execute();

        $this->getDb()->createCommand('
ALTER TABLE "doctors" ADD CONSTRAINT "fk_polyclinic_speciality" FOREIGN KEY ("polyclinics_speciality") REFERENCES "polyclinic_speciality" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
;
')->execute();
    }

    public function down()
    {
    }
}
