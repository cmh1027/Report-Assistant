create table signup(
	n			int				not null	auto_increment,
	email		varchar(100)	not null,
	nickname	varchar(20)		not null,
	password	varchar(100)	not null,
	primary key(n),
	unique(email),
	unique(nickname)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table department(
    dept_name varchar(12) not null primary key
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table post(
    dept_name varchar(12),
    post_id int,
    nickname varchar(20) not null,
    title varchar(40) not null,
    content mediumtext,
    date date,
    hit int(11),
    primary key (dept_name, post_id),
    foreign key (nickname) references signup (nickname),
    foreign key (dept_name) references department (dept_name) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table comment(
    dept_name varchar(12),
    post_id int,
    comment_id int, /* Warning - This is the ID of "Comment", not the ID of "User" who wrote the comment */
    comment_nickname varchar(20) not null,
    comment_content text not null,
    primary key (dept_name, post_id, comment_id),
	foreign key (comment_nickname) references signup (nickname),
    foreign key (dept_name, post_id) references post (dept_name, post_id) on delete cascade on update cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into department (dept_name) values ('policy');
insert into department (dept_name) values ('economy');
insert into department (dept_name) values ('it');
insert into department (dept_name) values ('science');
insert into department (dept_name) values ('sport');
insert into department (dept_name) values ('issue');