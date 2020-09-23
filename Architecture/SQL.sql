#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Fiche
#------------------------------------------------------------

CREATE TABLE Fiche(
        id    Int  Auto_increment  NOT NULL ,
        name  Varchar (50) NOT NULL ,
        date  Datetime NOT NULL ,
        titre Varchar (50) NOT NULL ,
        image Varchar (50) NOT NULL
	,CONSTRAINT Fiche_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Role
#------------------------------------------------------------

CREATE TABLE Role(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT Role_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Utilisateur
#------------------------------------------------------------

CREATE TABLE Utilisateur(
        id         Int  Auto_increment  NOT NULL ,
        email      Varchar (50) NOT NULL ,
        motdepasse Varchar (50) NOT NULL ,
        nom        Varchar (50) NOT NULL ,
        prenom     Varchar (50) NOT NULL ,
        borndate   Date NOT NULL ,
        id_Role    Int NOT NULL
	,CONSTRAINT Utilisateur_PK PRIMARY KEY (id)

	,CONSTRAINT Utilisateur_Role_FK FOREIGN KEY (id_Role) REFERENCES Role(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Commentaire
#------------------------------------------------------------

CREATE TABLE Commentaire(
        id             Int  Auto_increment  NOT NULL ,
        commentaire    Text NOT NULL ,
        date           Datetime NOT NULL ,
        id_Utilisateur Int NOT NULL ,
        id_Fiche       Int NOT NULL
	,CONSTRAINT Commentaire_PK PRIMARY KEY (id)

	,CONSTRAINT Commentaire_Utilisateur_FK FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur(id)
	,CONSTRAINT Commentaire_Fiche0_FK FOREIGN KEY (id_Fiche) REFERENCES Fiche(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: catégorie
#------------------------------------------------------------

CREATE TABLE categorie(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT categorie_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Appartenir
#------------------------------------------------------------

CREATE TABLE Appartenir(
        id           Int NOT NULL ,
        id_categorie Int NOT NULL
	,CONSTRAINT Appartenir_PK PRIMARY KEY (id,id_categorie)

	,CONSTRAINT Appartenir_Fiche_FK FOREIGN KEY (id) REFERENCES Fiche(id)
	,CONSTRAINT Appartenir_categorie0_FK FOREIGN KEY (id_categorie) REFERENCES categorie(id)
)ENGINE=InnoDB;

