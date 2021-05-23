CREATE DATABASE api_databse;
CREATE USER api_user WITH password 'qwerty';

CREATE SEQUENCE person_id_seq
START 1;

CREATE TABLE person (
    person_id 		int PRIMARY KEY, -- id пользователя
    person_email    varchar(90),     -- эл. почта пользователя
    person_name     varchar(20),     -- имя пользователя
    person_lastname varchar(20),     -- фамилия пользователя
    person_age      int				 -- возраст пользователя
);

/*
Пример INSERT

INSERT INTO person (person_id, person_email, person_name,
	person_lastname, person_age)
VALUES (nextval('person_id_seq'), 'ivanchernov@gmail.com', 'Иван',
	'Чернов', '23');
*/


