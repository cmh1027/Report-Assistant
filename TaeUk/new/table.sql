create table Sign (
	ID	int NOT NULL AUTO_INCREMENT,
	email		varchar(100)	NOT NULL,
	password	varchar(100)	NOT NULL,
	PRIMARY KEY (ID)
);

insert into Sign(email,password) values('tset@test.net', 'test');