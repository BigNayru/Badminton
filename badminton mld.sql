#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: type
#------------------------------------------------------------

CREATE TABLE type(
        numType        Int NOT NULL ,
        libelleType    Varchar (3) NOT NULL ,
        montantLicence Int NOT NULL
	,CONSTRAINT type_PK PRIMARY KEY (numType)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: adherent
#------------------------------------------------------------

CREATE TABLE adherent(
        matriculeADH       Int NOT NULL ,
        numType            Int NOT NULL ,
        nomADH             Varchar (100) NOT NULL ,
        prenomADH          Varchar (100) NOT NULL ,
        adresseADH         Varchar (100) NOT NULL ,
        cpADH              Int NOT NULL ,
        villeADH           Varchar (100) NOT NULL ,
        niveauADH          Varchar (100) NOT NULL ,
        numType_appartenir Int NOT NULL
	,CONSTRAINT adherent_PK PRIMARY KEY (matriculeADH,numType)

	,CONSTRAINT adherent_type_FK FOREIGN KEY (numType_appartenir) REFERENCES type(numType)
)ENGINE=InnoDB;

