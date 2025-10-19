INSERT INTO settings (`key`,`value`) VALUES
  ('site_title','Istanbul Nakliyat'),
  ('contact_whatsapp','905551112233'),
  ('contact_email','admin@example.com')
ON DUPLICATE KEY UPDATE `value` = VALUES(`value`);

INSERT INTO pages (title, slug, content, meta_title, meta_description) VALUES
('Hizmetler','services','<h2>Hizmetler</h2><p>Evden eve, ofis taşıma, parça eşya taşıma.</p>','Hizmetler','İstanbul nakliyat hizmetleri'),
('Fiyatlar','prices','<h2>Fiyatlar</h2><p>İlçe bazlı tahmini taşıma fiyatları.</p>','Fiyatlar','İstanbul nakliyat fiyatları'),
('İletişim','contact','<h2>İletişim</h2><p>Hızlı teklif için formu doldurun.</p>','İletişim','İstanbul nakliyat iletişim');

INSERT INTO districts (name, slug, meta_title, meta_description, lat, lng) VALUES
('Kadıköy','kadikoy','Kadıköy Evden Eve Nakliyat','Kadıköy nakliyat ve ofis taşıma',40.9875,29.0270),
('Beşiktaş','besiktas','Beşiktaş Evden Eve Nakliyat','Beşiktaş nakliyat ve ofis taşıma',41.0430,29.0059),
('Üsküdar','uskudar','Üsküdar Evden Eve Nakliyat','Üsküdar nakliyat ve ofis taşıma',41.0320,29.0214);

INSERT INTO neighborhoods (district_id, name, slug) VALUES
((SELECT id FROM districts WHERE slug='kadikoy'),'Moda','moda'),
((SELECT id FROM districts WHERE slug='kadikoy'),'Fenerbahçe','fenerbahce'),
((SELECT id FROM districts WHERE slug='besiktas'),'Levent','levent'),
((SELECT id FROM districts WHERE slug='besiktas'),'Etiler','etiler'),
((SELECT id FROM districts WHERE slug='uskudar'),'Çengelköy','cengelkoy'),
((SELECT id FROM districts WHERE slug='uskudar'),'Beylerbeyi','beylerbeyi');

INSERT INTO prices (from_district_id, to_district_id, variant, base_price) VALUES
((SELECT id FROM districts WHERE slug='kadikoy'),(SELECT id FROM districts WHERE slug='kadikoy'),'home',1490.00),
((SELECT id FROM districts WHERE slug='kadikoy'),(SELECT id FROM districts WHERE slug='besiktas'),'home',1890.00),
((SELECT id FROM districts WHERE slug='besiktas'),(SELECT id FROM districts WHERE slug='uskudar'),'home',1990.00);

INSERT INTO admins (username, password_hash) VALUES
('admin', '$2y$10$zvL0oWmJ3wa3q0d8y7S1R.2m6mC6aXb7uV6iE/7rF.1o8m2o4p7A2')
ON DUPLICATE KEY UPDATE username = username;
