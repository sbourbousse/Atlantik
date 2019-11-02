insert into parametre values (1);

load data local infile './bateau.csv' into table bateau
	fields terminated by ';'
	lines terminated by '\n';


load data local infile './equipement.csv' into table equipement
	fields terminated by ';'
	lines terminated by '\n';


load data local infile './posseder.csv' into table posseder
	fields terminated by ';'
	lines terminated by '\n';


load data local infile './categorie.csv' into table categorie
	fields terminated by ';'
	lines terminated by '\n';

load data local infile './disposer.csv' into table disposer
	fields terminated by ';'
	lines terminated by '\n';


load data local infile './type.csv' into table type
	fields terminated by ';'
	lines terminated by '\n';


load data local infile './port.csv' into table port
	fields terminated by ';'
	lines terminated by '\n';


load data local infile './secteur.csv' into table secteur
	fields terminated by ';'
	lines terminated by '\n';


load data local infile './laison.csv' into table liaison
	fields terminated by ';'
	lines terminated by '\n';


load data local infile './traversee.csv' into table traversee
	fields terminated by ';'
	lines terminated by '\n';


load data local infile './client.csv' into table client
	fields terminated by ';'
	lines terminated by '\n';


load data local infile './reservation.csv' into table reservation
	fields terminated by ';'
	lines terminated by '\n';


load data local infile './contient.csv' into table contient
	fields terminated by ';'
	lines terminated by '\n';


load data local infile './periode.csv' into table periode
	fields terminated by ';'
	lines terminated by '\n';


load data local infile './tarif.csv' into table tarif
	fields terminated by ';'
	lines terminated by '\n';

