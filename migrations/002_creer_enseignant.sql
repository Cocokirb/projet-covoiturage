CREATE TABLE ENSEIGNANT (
    idEnseignant int NOT NULL ,
    nomEnseignant varchar(50) not NULL,
    prenomEnseignant varchar(50) NOT NULL,
    adressemailEnseignant varchar(50) NOT NULL,
    numeroTelEnseignant varchar(50) NULL,
    mdpEnseignant varchar(50) NOT NULL , 
    CONSTRAINT PK_ENSEIGNANT PRIMARY KEY (idEnseignant)
);

INSERT INTO parametres (code) 
VALUES ('123456');