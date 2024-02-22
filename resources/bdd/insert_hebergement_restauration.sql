
INSERT INTO hotel(pnom,adresse1, adresse2,cp,ville,tel,mail)values('Ibis Styles', '172 rue Pierre Mauroy', null, '59000', 'Lille', '0320300054', 'H1384@accor.com'),
('Ibis Budget', '10, Rue de Courtrai', null, '59000', 'Lille', '0328523415' , 'H5208@accor.com');

INSERT INTO nuite(hotel_id,date_nuite) values(1,str_to_date('2024/10/20', '%Y/%m/%d')), (1,str_to_date('2024/10/21', '%Y/%m/%d')), (1,str_to_date('2024/10/22', '%Y/%m/%d')),
(2,str_to_date('2024/10/20', '%Y/%m/%d')), (2,str_to_date('2024/10/21', '%Y/%m/%d')), (2,str_to_date('2024/10/22', '%Y/%m/%d')) ;

INSERT INTO categorie_chambre(libelle_categorie)values('Single'),('Double');
insert into proposer(hotel_id,categorie_id,tarif_nuite)values(1,1,95), (1,2,105), (2,1,70), (2,2,80);

insert into restauration(date_restauration,type_repas)values(str_to_date('2024/09/07', '%Y/%m/%d'), 'déjeuner'), (str_to_date('2024/09/07', '%Y/%m/%d'), 'dîner'),
(str_to_date('2024/09/08', '%Y/%m/%d'), 'déjeuner')
 ;