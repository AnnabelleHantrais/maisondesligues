
INSERT INTO hotel(pnom,adresse1, adresse2,cp,ville,tel,mail)values('Ibis Styles', '172 rue Pierre Mauroy', null, '59000', 'Lille', '0320300054', 'H1384@accor.com'),
('Ibis Budget', '10, Rue de Courtrai', null, '59000', 'Lille', '0328523415' , 'H5208@accor.com');

INSERT INTO nuite(hotel_id,date_nuite) values(1,str_to_date('2024/10/20', '%Y/%m/%d') ), 
(1,str_to_date('2024/10/21', '%Y/%m/%d')), 
(1,str_to_date('2024/10/22', '%Y/%m/%d')),
(2,str_to_date('2024/10/20', '%Y/%m/%d')), 
(2,str_to_date('2024/10/21', '%Y/%m/%d')), 
(2,str_to_date('2024/10/22', '%Y/%m/%d')) ;
INSERT INTO nuite(hotel_id,date_nuite) values(1,str_to_date('2024/10/20', '%Y/%m/%d')), 
(1,str_to_date('2024/09/07', '%Y/%m/%d')), 
(1,str_to_date('2024/10/22', '%Y/%m/%d')),
(2,str_to_date('2024/10/20', '%Y/%m/%d')), 
(2,str_to_date('2024/10/21', '%Y/%m/%d')), 
(2,str_to_date('2024/10/22', '%Y/%m/%d')) ;

INSERT INTO categorie_chambre(libelle_categorie)values('Single'),('Double');
insert into proposer(hotel_id,categorie_id,tarif_nuite)values(1,1,50), (1,2,55), (2,1,45), (2,2,50);

insert into restauration(date_restauration,type_repas)values(str_to_date('2024/10/20', '%Y/%m/%d'), 'déjeuner'), (str_to_date('2024/10/20', '%Y/%m/%d'), 'dîner'),
(str_to_date('2024/10/21', '%Y/%m/%d'), 'déjeuner'), (str_to_date('2024/10/21', '%Y/%m/%d'), 'dîner'),
(str_to_date('2024/10/22', '%Y/%m/%d'), 'déjeuner'), (str_to_date('2024/10/22', '%Y/%m/%d'), 'dîner'),
(str_to_date('2024/10/23', '%Y/%m/%d'), 'déjeuner') ;

select * from vacation;


insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(1,'2024-09-08 11:00:00', '2024-09-08 12:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(1,'2024-09-08 14:00:00', '2024-09-08 15:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(1,'2024-09-08 16:00:00', '2024-09-08 17:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(1,'2024-09-09 09:00:00', '2024-09-09 10:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(1,'2024-09-09 11:00:00', '2024-09-09 12:30:00');

insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(2,'2024-09-08 11:00:00', '2024-09-08 12:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(2,'2024-09-08 14:00:00', '2024-09-08 15:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(2,'2024-09-08 16:00:00', '2024-09-08 17:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(2,'2024-09-09 09:00:00', '2024-09-09 10:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(2,'2024-09-09 11:00:00', '2024-09-09 12:30:00');

insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(3,'2024-09-08 11:00:00', '2024-09-08 12:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(3,'2024-09-08 14:00:00', '2024-09-08 15:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(3,'2024-09-08 16:00:00', '2024-09-08 17:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(3,'2024-09-09 09:00:00', '2024-09-09 10:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(3,'2024-09-09 11:00:00', '2024-09-09 12:30:00');

insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(4,'2024-09-08 11:00:00', '2024-09-08 12:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(4,'2024-09-08 14:00:00', '2024-09-08 15:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(4,'2024-09-08 16:00:00', '2024-09-08 17:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(4,'2024-09-09 09:00:00', '2024-09-09 10:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(4,'2024-09-09 11:00:00', '2024-09-09 12:30:00');

insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(5,'2024-09-08 11:00:00', '2024-09-08 12:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(5,'2024-09-08 14:00:00', '2024-09-08 15:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(5,'2024-09-08 16:00:00', '2024-09-08 17:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(5,'2024-09-09 09:00:00', '2024-09-09 10:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(5,'2024-09-09 11:00:00', '2024-09-09 12:30:00');

insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(6,'2024-09-08 11:00:00', '2024-09-08 12:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(6,'2024-09-08 14:00:00', '2024-09-08 15:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(6,'2024-09-08 16:00:00', '2024-09-08 17:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values(6,'2024-09-09 09:00:00', '2024-09-09 10:30:00');
insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values( 6, str_to_date('2024-09-09 11:00:00', '%y-%m-%d %h:%mi:%s'), str_to_date('2024-09-09 12:30:00', '%y-%m-%d %h:%mi:%s') );

SELECT  
  a.id AS atelier_id, 
  a.libelle AS atelier_libelle, 
  a.nb_places_maxi, 
  t.id AS theme_id, 
  t.libelle AS theme_libelle
FROM 
  atelier a
JOIN 
  atelier_theme at ON a.id = at.atelier_id
JOIN 
  theme t ON at.theme_id = t.id
  GROUP BY 
  a.id;