-- Créé le 2/11/2019 par Sylvain Bourbousse --

-- Supprime la base de donnée si celle-ci existe --
drop database if exists Atlantik;

-- Creer la base de données --
create database Atlantik;

-- Selectionner la base de données --
use Atlantik;

-- Implantation de la base --
create table parametre(
    version float
)engine=innodb charset=utf8;

create table bateau(
    bateauId int unsigned primary key,
    bateauNom varchar(64),
    bateauLongueur float unsigned,
    bateauLargeur float unsigned,
    bateauVitesse smallint unsigned,
    bateauImage varchar(256),
    bateauPoidMax smallint,
    bateauType varchar(1) -- v pour voyageur, f pour fret --
)engine=innodb charset=utf8;

create table equipement(
    numeroEquipement smallint unsigned primary key,
    libelleEquipement varchar(256)
)engine=innodb charset=utf8;

create table posseder(
    bateauId int unsigned references bateau(bateauId),
    numeroEquipement smallint unsigned references equipement(numeroEquipement)
)engine=innodb charset=utf8;

create table categorie(
    categorieId char(1) primary key,
    categorieNom varchar(64)
)engine=innodb charset=utf8;

create table disposer(
    categorieId char(1) references categorie(categorieId),
    bateauId int unsigned references bateau(bateauId),
    nbPlaces smallint unsigned
)engine=innodb charset=utf8;

create table type(
    categorieId char(1) references categorie(categorieId),
    typeId char(1),
    typeLibelle varchar(64),
    primary key(categorieId,typeId)
)engine=innodb charset=utf8;

create table port(
    portId smallint unsigned primary key,
    portNom varchar(128)
)engine=innodb charset=utf8;

create table secteur(
    secteurId smallint unsigned primary key,
    secteurNom varchar(128)
)engine=innodb charset=utf8;

create table liaison(
    liaisonCode smallint unsigned primary key,
    portDepart smallint unsigned references port(portId),
    portArrive smallint unsigned references port(portId),
    liaisonDistance float,
    secteurId smallint unsigned references secteur(secteurId)
)engine=innodb charset=utf8;

create table traversee(
    traverseeId int unsigned primary key,
    traverseeHoraireDebut datetime,
    bateauId int unsigned references bateau(bateauId),
    liaisonCode smallint unsigned references liaison(liaisonCode)
)engine=innodb charset=utf8;

create table client(
    clientId int unsigned primary key,
    clientNom varchar(128),
    clientAdresse varchar(256),
    clientCP char(5),
    clientVille varchar(128)
)engine=innodb charset=utf8;

create table reservation(
    reservationId int unsigned primary key,
    clientId int unsigned references client(clientId),
    traverseeId int unsigned references traversee(traverseeId)
)engine=innodb charset=utf8;

create table contient(
    quantite smallint,
    reservationId int unsigned references reservation(reservationId),
    categorieId char(1) references type(categorieId),
    typeId char(1) references type(typeId)
)engine=innodb charset=utf8;

create table periode(
    periodeId int unsigned primary key,
    periodeDateDebut date,
    periodeDateFin date
)engine=innodb charset=utf8;

create table tarif(
    prix float,
    categorieId char(1) references type(categorieId),
    typeId char(1) references type(typeId),
    periodeId int unsigned references periode(periodeId),
    liaisonCode smallint unsigned references liaison(liaisonCode)
)engine=innodb charset=utf8;