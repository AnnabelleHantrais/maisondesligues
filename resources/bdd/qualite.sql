--------------------------------------------------------
--  Fichier cr�� - dimanche-f�vrier-18-2024   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Table QUALITE
--------------------------------------------------------

  CREATE TABLE "MDL"."QUALITE" 
   (	"ID" NUMBER(2,0), 
	"LIBELLEQUALITE" VARCHAR2(50 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
REM INSERTING into MDL.QUALITE
SET DEFINE OFF;
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('1','Licencie');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('2','Pr�sident de ligue');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('3','Pr�sident de club');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('4','Pr�sident de CD');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('5','Vice-Pr�sident de ligue');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('6','Vice-Pr�sident de club');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('7','Vice-Pr�sident de CD');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('8','secr�taire de ligue');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('9','secr�taire de club');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('10','secr�taire de CD');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('11','Tr�sorier de ligue');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('12','Tr�sorier de club');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('13','Tr�sorier de CD');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('14','Maitre d''armes');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('15','Eleve Maitre');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('16','Cadre Technique R�gional');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('17','Relais');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('18','Coordinateur de P�le');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('19','Athl�te de Haut Niveau');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('20','TBenevole de Club');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('21','Animateur');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('22','FFE');
Insert into MDL.QUALITE (ID,LIBELLEQUALITE) values ('23','Tr�sorier de CD');
--------------------------------------------------------
--  DDL for Index PK_QUALITE
--------------------------------------------------------

  CREATE UNIQUE INDEX "MDL"."PK_QUALITE" ON "MDL"."QUALITE" ("ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  Constraints for Table QUALITE
--------------------------------------------------------

  ALTER TABLE "MDL"."QUALITE" ADD CONSTRAINT "PK_QUALITE" PRIMARY KEY ("ID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS"  ENABLE;
  ALTER TABLE "MDL"."QUALITE" MODIFY ("LIBELLEQUALITE" NOT NULL ENABLE);
  ALTER TABLE "MDL"."QUALITE" MODIFY ("ID" NOT NULL ENABLE);
