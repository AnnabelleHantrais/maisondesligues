--------------------------------------------------------
--  Fichier créé - dimanche-février-18-2024   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Table CLUB
--------------------------------------------------------

  CREATE TABLE "MDL"."CLUB" 
   (	"ID" NUMBER(*,0), 
	"NOM" VARCHAR2(50 BYTE), 
	"ADRESSE1" VARCHAR2(60 BYTE), 
	"ADRESSE2" VARCHAR2(60 BYTE), 
	"CP" CHAR(5 BYTE), 
	"VILLE" VARCHAR2(60 BYTE), 
	"TEL" CHAR(14 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
REM INSERTING into MDL.CLUB
SET DEFINE OFF;
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('1','Institut Vallier Marseille','67a rue ferrari',null,'13005','Marseille','0491476657    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('2','Escrime Provence','1bis impasse des Independants',null,'13013','Marseille','0671205105    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('3','Toulon Var Esscrime','Complexe sportif Vert Coteau','Rue Sous Lieutenant Guy Friggeri','83000','Toulon','0494366517    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('4','Hyeres Escrime','Gymnase des Rougières','Rue du Soldat','83400','Hyères','0494385994    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('5','Les Cadets de l''Estuaire - Escrime','38 Bis route de l''Estuaire',null,'33390','PLASSAC','0661214848    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('6','Bordeaux Bastide Escrime','RUE GALIN',null,'33100','BORDEAUX','0777078961    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('7','Gradignan Talence Escrime','Parc de la Tannerie ',null,'33170','Gradignan','0556891011    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('8','C.e. De Haguenau','ymnase de la Musau','16, rue du Colonel PAULUS','67500','HAGUENAU','0675412183    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('9','Club d''escrime de Saverne la Licorne','COSEC SOURCES II ','10 RUE SAINTE MARIE','67700','SAVERNE','0670341251    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('10','Strasbourg UC','Gymnase Aristide BRIAND','43 avenue du Rhin','67000','STRASBOURG','0675749206    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('11','Section Paloise','12 rue René Fournets',null,'64000','PAU','0559276087    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('12','Escrime Reze Nantes Metropole','GYMNASE COLLEGE ND TOUTES AIDES','RUE DES EPINETTES','44300','NANTES','0616762045    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('13','NEC Escrime','Complexe Sportif Mangin Beaulieu','Rue Louis Joxe','44200','Nantes','0251724313    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('14','Escrime Valletaise','salle des dorices',null,'44330','VALLET','0240547574    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('15','CE d''Armentières','Hall sportive Jean Zay Salle Maurice DIERCKENS ','8 rue de l''octroi','59280','ARMENTIERES','0631827256    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('16','Academie Escrime Vauban Lille','aventure Crypte St Pierre St Paul',null,'59000','LILLE','0659358095    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('17','C.e. De Faches Thumesnil','Salle Dumas Rue Dumas',null,'59155','FACHES-THUMESNIL','0662045987    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('18','CE de Roubaix','4 rue Jules Guesde',null,'59100','Roubaix','0320755448    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('19','Haubourdin Escrime Club','Complexe omnisports Thérey Godin Salle Raoul Dufour','Avenue de Beaupré','59320','HAUBOURDIN','0659806224    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('20','Escrime Ouest Lyonnais','2 Rue de la Cadière',null,'69600','OULLINS','0478518769    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('21','Club Sportif Décinois d''Escrime','gymnase Becquerel Salle Sophie NABETH','37 rue sully','69150','Décines','0651842537    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('22','Vénissieux Escrime','Gymnase Jacques Brel','7 avenue d''Oschatz','69200','VENISSIEUX','0472510926    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('23','Escrime Club du Val de Saône','Gymnase Rosa Parks','13 rue Pollet','69250','NEUVILLE SUR SAONE','0670108294    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('24','Cercle d''Escrime Nord Isère','Hall des sports','21, avenue des Alpes','38300','BOURGOIN JALLIEU','0651191558    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('25','SA de Mandelieu la Napoule',' Adresse 1435 bd des Terme',null,'06210','MANDELIEU LA NAPOULE','0493496213    ');
Insert into MDL.CLUB (ID,NOM,ADRESSE1,ADRESSE2,CP,VILLE,TEL) values ('26','E.s. Le Cannet Rocheville','Gymnase MAILLAN','Boulevard Georges POMPIDOU','06110','LE CANNET','0615373706    ');
--------------------------------------------------------
--  DDL for Index PK_CLUB
--------------------------------------------------------

  CREATE UNIQUE INDEX "MDL"."PK_CLUB" ON "MDL"."CLUB" ("ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  Constraints for Table CLUB
--------------------------------------------------------

  ALTER TABLE "MDL"."CLUB" ADD CONSTRAINT "PK_CLUB" PRIMARY KEY ("ID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS"  ENABLE;
  ALTER TABLE "MDL"."CLUB" MODIFY ("TEL" NOT NULL ENABLE);
  ALTER TABLE "MDL"."CLUB" MODIFY ("VILLE" NOT NULL ENABLE);
  ALTER TABLE "MDL"."CLUB" MODIFY ("CP" NOT NULL ENABLE);
  ALTER TABLE "MDL"."CLUB" MODIFY ("ADRESSE1" NOT NULL ENABLE);
  ALTER TABLE "MDL"."CLUB" MODIFY ("NOM" NOT NULL ENABLE);
  ALTER TABLE "MDL"."CLUB" MODIFY ("ID" NOT NULL ENABLE);
