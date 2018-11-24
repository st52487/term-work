-- Generated by Oracle SQL Developer Data Modeler 18.3.0.268.1156
--   at:        2018-10-25 14:15:16 CEST
--   site:      Oracle Database 11g
--   type:      Oracle Database 11g



CREATE TABLE akce (
    id_akce           NUMBER NOT NULL,
    nazev             VARCHAR2(100) NOT NULL,
    zkratka           VARCHAR2(10),
    pocetdetinaakci   NUMBER NOT NULL,
    popis             VARCHAR2(255) NOT NULL
);

ALTER TABLE akce ADD CONSTRAINT akce_pk PRIMARY KEY ( id_akce );

CREATE TABLE dite (
    id_dite              NUMBER NOT NULL,
    jmeno                VARCHAR2(255) NOT NULL,
    prijmeni             VARCHAR2(255) NOT NULL,
    vek                  NUMBER,
    pohlavi              VARCHAR2(25),
    trida_id_trida       NUMBER NOT NULL,
    kontakt_id_kontakt   NUMBER NOT NULL
);

ALTER TABLE dite ADD CONSTRAINT dite_pk PRIMARY KEY ( id_dite );

CREATE TABLE kontakt (
    id_kontakt   NUMBER NOT NULL,
    telefon      NUMBER NOT NULL,
    email        VARCHAR2(100),
    ulice        VARCHAR2(100) NOT NULL,
    psc          NUMBER NOT NULL,
    mesto        VARCHAR2(200) NOT NULL
);

ALTER TABLE kontakt ADD CONSTRAINT kontakt_pk PRIMARY KEY ( id_kontakt );

CREATE TABLE prihlasovaci_udaje (
    id_udaj             NUMBER NOT NULL,
    prihlasovacijmeno   VARCHAR2(150) NOT NULL,
    heslo               VARCHAR2(200) NOT NULL,
    ucitel_id_ucitel    NUMBER NOT NULL
);

ALTER TABLE prihlasovaci_udaje ADD CONSTRAINT prihlasovaci_udaje_pk PRIMARY KEY ( id_udaj );

CREATE TABLE trida (
    id_trida      NUMBER NOT NULL,
    nazev         VARCHAR2(100) NOT NULL,
    rozmeziveku   VARCHAR2(20) NOT NULL,
    popis         VARCHAR2(255)
);

ALTER TABLE trida ADD CONSTRAINT trida_pk PRIMARY KEY ( id_trida );

CREATE TABLE trida_akce (
    trida_id_trida   NUMBER NOT NULL,
    akce_id_akce     NUMBER NOT NULL
);

ALTER TABLE trida_akce ADD CONSTRAINT rel_trida_akce_pk PRIMARY KEY ( trida_id_trida,
                                                                      akce_id_akce );

CREATE TABLE trida_ucitel (
    trida_id_trida     NUMBER NOT NULL,
    ucitel_id_ucitel   NUMBER NOT NULL
);

ALTER TABLE trida_ucitel ADD CONSTRAINT rel_trida_ucitel_pk PRIMARY KEY ( trida_id_trida,
                                                                          ucitel_id_ucitel );

CREATE TABLE ucitel (
    id_ucitel            NUMBER NOT NULL,
    jmeno                VARCHAR2(100) NOT NULL,
    prijmeni             VARCHAR2(100) NOT NULL,
    reditel              VARCHAR2(15),
    ucitel_id_ucitel     NUMBER NOT NULL,
    kontakt_id_kontakt   NUMBER NOT NULL
);

CREATE UNIQUE INDEX ucitel__idx ON
    ucitel (
        ucitel_id_ucitel
    ASC );

ALTER TABLE ucitel ADD CONSTRAINT ucitel_pk PRIMARY KEY ( id_ucitel );

ALTER TABLE dite
    ADD CONSTRAINT dite_kontakt_fk FOREIGN KEY ( kontakt_id_kontakt )
        REFERENCES kontakt ( id_kontakt );

ALTER TABLE dite
    ADD CONSTRAINT dite_trida_fk FOREIGN KEY ( trida_id_trida )
        REFERENCES trida ( id_trida );

ALTER TABLE prihlasovaci_udaje
    ADD CONSTRAINT prihlasovaci_udaje_ucitel_fk FOREIGN KEY ( ucitel_id_ucitel )
        REFERENCES ucitel ( id_ucitel );

ALTER TABLE trida_akce
    ADD CONSTRAINT rel_trida_akce_akce_fk FOREIGN KEY ( akce_id_akce )
        REFERENCES akce ( id_akce );

ALTER TABLE trida_akce
    ADD CONSTRAINT rel_trida_akce_trida_fk FOREIGN KEY ( trida_id_trida )
        REFERENCES trida ( id_trida );

ALTER TABLE trida_ucitel
    ADD CONSTRAINT rel_trida_ucitel_trida_fk FOREIGN KEY ( trida_id_trida )
        REFERENCES trida ( id_trida );

ALTER TABLE trida_ucitel
    ADD CONSTRAINT rel_trida_ucitel_ucitel_fk FOREIGN KEY ( ucitel_id_ucitel )
        REFERENCES ucitel ( id_ucitel );

ALTER TABLE ucitel
    ADD CONSTRAINT ucitel_kontakt_fk FOREIGN KEY ( kontakt_id_kontakt )
        REFERENCES kontakt ( id_kontakt );

ALTER TABLE ucitel
    ADD CONSTRAINT ucitel_ucitel_fk FOREIGN KEY ( ucitel_id_ucitel )
        REFERENCES ucitel ( id_ucitel );

ALTER TABLE dite
    ADD CONSTRAINT dite_kontakt_fk FOREIGN KEY ( kontakt_id_kontakt )
        REFERENCES kontakt ( id_kontakt );

ALTER TABLE dite
    ADD CONSTRAINT dite_trida_fk FOREIGN KEY ( trida_id_trida )
        REFERENCES trida ( id_trida );

ALTER TABLE prihlasovaci_udaje
    ADD CONSTRAINT prihlasovaci_udaje_ucitel_fk FOREIGN KEY ( ucitel_id_ucitel )
        REFERENCES ucitel ( id_ucitel );

ALTER TABLE trida_akce
    ADD CONSTRAINT rel_trida_akce_akce_fk FOREIGN KEY ( akce_id_akce )
        REFERENCES akce ( id_akce );

ALTER TABLE trida_akce
    ADD CONSTRAINT rel_trida_akce_trida_fk FOREIGN KEY ( trida_id_trida )
        REFERENCES trida ( id_trida );

ALTER TABLE trida_ucitel
    ADD CONSTRAINT rel_trida_ucitel_trida_fk FOREIGN KEY ( trida_id_trida )
        REFERENCES trida ( id_trida );

ALTER TABLE trida_ucitel
    ADD CONSTRAINT rel_trida_ucitel_ucitel_fk FOREIGN KEY ( ucitel_id_ucitel )
        REFERENCES ucitel ( id_ucitel );

ALTER TABLE ucitel
    ADD CONSTRAINT ucitel_kontakt_fk FOREIGN KEY ( kontakt_id_kontakt )
        REFERENCES kontakt ( id_kontakt );

ALTER TABLE ucitel
    ADD CONSTRAINT ucitel_ucitel_fk FOREIGN KEY ( ucitel_id_ucitel )
        REFERENCES ucitel ( id_ucitel );



-- Oracle SQL Developer Data Modeler Summary Report: 
-- 
-- CREATE TABLE                             8
-- CREATE INDEX                             1
-- ALTER TABLE                             26
-- CREATE VIEW                              0
-- ALTER VIEW                               0
-- CREATE PACKAGE                           0
-- CREATE PACKAGE BODY                      0
-- CREATE PROCEDURE                         0
-- CREATE FUNCTION                          0
-- CREATE TRIGGER                           0
-- ALTER TRIGGER                            0
-- CREATE COLLECTION TYPE                   0
-- CREATE STRUCTURED TYPE                   0
-- CREATE STRUCTURED TYPE BODY              0
-- CREATE CLUSTER                           0
-- CREATE CONTEXT                           0
-- CREATE DATABASE                          0
-- CREATE DIMENSION                         0
-- CREATE DIRECTORY                         0
-- CREATE DISK GROUP                        0
-- CREATE ROLE                              0
-- CREATE ROLLBACK SEGMENT                  0
-- CREATE SEQUENCE                          0
-- CREATE MATERIALIZED VIEW                 0
-- CREATE MATERIALIZED VIEW LOG             0
-- CREATE SYNONYM                           0
-- CREATE TABLESPACE                        0
-- CREATE USER                              0
-- 
-- DROP TABLESPACE                          0
-- DROP DATABASE                            0
-- 
-- REDACTION POLICY                         0
-- 
-- ORDS DROP SCHEMA                         0
-- ORDS ENABLE SCHEMA                       0
-- ORDS ENABLE OBJECT                       0
-- 
-- ERRORS                                   0
-- WARNINGS                                 0