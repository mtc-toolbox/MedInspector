ALTER TABLE public.cities
  DROP CONSTRAINT fk_regions_cities RESTRICT;

ALTER TABLE "cities" ADD CONSTRAINT "fk_region_cities" FOREIGN KEY ("region") REFERENCES "regions" ("id") ON DELETE CASCADE ON UPDATE NO ACTION;

idx_region_cities


status string

idx_polyclinics_city


ALTER TABLE "polyclinics" ADD CONSTRAINT "fk_cities_polyclinics" FOREIGN KEY ("city") REFERENCES "cities" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;
