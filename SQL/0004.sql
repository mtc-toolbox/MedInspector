/*
Created: 15.06.2019
Modified: 15.06.2019
Model: PostgreSQL 9.1
Database: PostgreSQL 9.1
*/


-- Create tables section -------------------------------------------------

-- Table clients

CREATE TABLE "clients"(
 "id" BigSerial NOT NULL,
 "polyclinic" Bigint,
 "oms" Character varying(16) NOT NULL,
 "username" Character varying(64) NOT NULL,
 "fullname" Character varying(128),
 "role" Character varying(32),
 "auth_key" Character varying(32),
 "password_reset_token" Character varying,
 "email" Character varying NOT NULL,
 "status" Character varying(64),
 "verification_token" Bigint,
 "created_at" Timestamp,
 "deleted_at" Timestamp
)
;

COMMENT ON TABLE "clients" IS 'Пользователи'
;
COMMENT ON COLUMN "clients"."id" IS 'Идентификатор записи'
;
COMMENT ON COLUMN "clients"."polyclinic" IS 'Учреждение по умолчанию'
;
COMMENT ON COLUMN "clients"."oms" IS 'ОМС'
;
COMMENT ON COLUMN "clients"."username" IS 'Логин'
;
COMMENT ON COLUMN "clients"."fullname" IS 'ФИО'
;
COMMENT ON COLUMN "clients"."role" IS 'Роль'
;
COMMENT ON COLUMN "clients"."email" IS 'E-mail'
;
COMMENT ON COLUMN "clients"."status" IS 'Статус учётной записи'
;
COMMENT ON COLUMN "clients"."created_at" IS 'Время создания'
;
COMMENT ON COLUMN "clients"."deleted_at" IS 'Время удаления'
;

-- Create indexes for table clients

CREATE INDEX "idx_clients_polyclinic" ON "clients" ("polyclinic")
;

CREATE INDEX "idx_fullname" ON "clients" ("fullname")
;

-- Add keys for table clients

ALTER TABLE "clients" ADD CONSTRAINT "clients_id" PRIMARY KEY ("id")
;

ALTER TABLE "clients" ADD CONSTRAINT "clients_login" UNIQUE ("username")
;

ALTER TABLE "clients" ADD CONSTRAINT "clients_oms" UNIQUE ("oms")
;

ALTER TABLE "clients" ADD CONSTRAINT "email" UNIQUE ("email")
;

-- Table regions

CREATE TABLE "regions"(
 "id" BigSerial NOT NULL,
 "name" Character varying(64) NOT NULL
)
;

COMMENT ON TABLE "regions" IS 'Регионы'
;
COMMENT ON COLUMN "regions"."id" IS 'Идентификатор записи'
;
COMMENT ON COLUMN "regions"."name" IS 'Наименование'
;

-- Add keys for table regions

ALTER TABLE "regions" ADD CONSTRAINT "regions_id" PRIMARY KEY ("id")
;

ALTER TABLE "regions" ADD CONSTRAINT "regions_name" UNIQUE ("name")
;

-- Table cities

CREATE TABLE "cities"(
 "id" BigSerial NOT NULL,
 "region" Bigint,
 "name" Character varying(128) NOT NULL
)
;

COMMENT ON TABLE "cities" IS 'Города'
;
COMMENT ON COLUMN "cities"."id" IS 'Идентификатор записи'
;
COMMENT ON COLUMN "cities"."region" IS 'Регион'
;
COMMENT ON COLUMN "cities"."name" IS 'Наименование'
;

-- Create indexes for table cities

CREATE INDEX "idx_region_cities" ON "cities" ("region")
;

-- Add keys for table cities

ALTER TABLE "cities" ADD CONSTRAINT "cities_id" PRIMARY KEY ("id")
;

ALTER TABLE "cities" ADD CONSTRAINT "cities_name" UNIQUE ("name")
;

-- Table polyclinics

CREATE TABLE "polyclinics"(
 "id" BigSerial NOT NULL,
 "city" Bigint,
 "name" Character varying(64) NOT NULL
)
;

COMMENT ON TABLE "polyclinics" IS 'Регионы'
;
COMMENT ON COLUMN "polyclinics"."id" IS 'Идентификатор записи'
;
COMMENT ON COLUMN "polyclinics"."city" IS 'Населённый пункт'
;
COMMENT ON COLUMN "polyclinics"."name" IS 'Наименование'
;

-- Create indexes for table polyclinics

CREATE INDEX "idx_polyclinics_city" ON "polyclinics" ("city")
;

-- Add keys for table polyclinics

ALTER TABLE "polyclinics" ADD CONSTRAINT "polyclinics_id" PRIMARY KEY ("id")
;

ALTER TABLE "polyclinics" ADD CONSTRAINT "polyclinics_name" UNIQUE ("name")
;

-- Table speciality

CREATE TABLE "speciality"(
 "id" BigSerial NOT NULL,
 "name" Character varying(64) NOT NULL
)
;

COMMENT ON TABLE "speciality" IS 'Специализация'
;
COMMENT ON COLUMN "speciality"."id" IS 'Идентификатор записи'
;
COMMENT ON COLUMN "speciality"."name" IS 'Наименование'
;

-- Add keys for table speciality

ALTER TABLE "speciality" ADD CONSTRAINT "speciality_id" PRIMARY KEY ("id")
;

ALTER TABLE "speciality" ADD CONSTRAINT "speciality_name" UNIQUE ("name")
;

-- Table polyclinic_speciality

CREATE TABLE "polyclinic_speciality"(
 "id" BigSerial NOT NULL,
 "polyclinic" Bigint,
 "speciality" Bigint
)
;
COMMENT ON COLUMN "polyclinic_speciality"."id" IS 'Идентификатор записи'
;
COMMENT ON COLUMN "polyclinic_speciality"."polyclinic" IS 'Поликлиника'
;
COMMENT ON COLUMN "polyclinic_speciality"."speciality" IS 'Специализация'
;

-- Create indexes for table polyclinic_speciality

CREATE INDEX "idx_polyclinic_speciality_speciality" ON "polyclinic_speciality" ("speciality")
;

CREATE INDEX "idx_polyclinic_speciality_polyclinic" ON "polyclinic_speciality" ("polyclinic")
;

-- Add keys for table polyclinic_speciality

ALTER TABLE "polyclinic_speciality" ADD CONSTRAINT "polyclinic_speciality_id" PRIMARY KEY ("id")
;

-- Table doctors

CREATE TABLE "doctors"(
 "id" BigSerial NOT NULL,
 "polyclinics_speciality" Bigint,
 "fullname" Character varying(128)
)
;

COMMENT ON TABLE "doctors" IS 'Пользователи'
;
COMMENT ON COLUMN "doctors"."id" IS 'Идентификатор записи'
;
COMMENT ON COLUMN "doctors"."polyclinics_speciality" IS 'Специальность'
;
COMMENT ON COLUMN "doctors"."fullname" IS 'ФИО'
;

-- Create indexes for table doctors

CREATE INDEX "idx_doctors_clients_polyclinic" ON "doctors" ("polyclinics_speciality")
;

CREATE INDEX "idx_doctors_fullname" ON "doctors" ("fullname")
;

-- Add keys for table doctors

ALTER TABLE "doctors" ADD CONSTRAINT "doctors_id" PRIMARY KEY ("id")
;

-- Table states

CREATE TABLE "states"(
 "id" Bigint NOT NULL,
 "client" Bigint,
 "steps" Character varying
)
;
COMMENT ON COLUMN "states"."id" IS 'Идентификатор записи'
;
COMMENT ON COLUMN "states"."client" IS 'Клиент'
;
COMMENT ON COLUMN "states"."steps" IS 'JSON полей'
;

-- Create indexes for table states

CREATE INDEX "idx_states_client" ON "states" ("client")
;

-- Add keys for table states

ALTER TABLE "states" ADD CONSTRAINT "ui_states" PRIMARY KEY ("id")
;
-- Create foreign keys (relationships) section ------------------------------------------------- 

ALTER TABLE "clients" ADD CONSTRAINT "fk_polyclinics_clients" FOREIGN KEY ("polyclinic") REFERENCES "polyclinics" ("id") ON DELETE SET NULL ON UPDATE NO ACTION
;

ALTER TABLE "polyclinic_speciality" ADD CONSTRAINT "fk_speciality_polyclinic_speciality" FOREIGN KEY ("speciality") REFERENCES "speciality" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
;

ALTER TABLE "polyclinic_speciality" ADD CONSTRAINT "fk_polyclinic_polyclinic_speciality" FOREIGN KEY ("polyclinic") REFERENCES "polyclinics" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
;

ALTER TABLE "doctors" ADD CONSTRAINT "fk_polyclinic_speciality" FOREIGN KEY ("polyclinics_speciality") REFERENCES "polyclinic_speciality" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
;

ALTER TABLE "cities" ADD CONSTRAINT "fk_region_cities" FOREIGN KEY ("region") REFERENCES "regions" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
;

ALTER TABLE "polyclinics" ADD CONSTRAINT "fk_cities_polyclinics" FOREIGN KEY ("city") REFERENCES "cities" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE "states" ADD CONSTRAINT "fk_client_states" FOREIGN KEY ("client") REFERENCES "clients" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
;




