-- liskov_substitution_principle.sql

-- First, run the database in docker with this command:
-- docker run -it --rm -p 5432:5432 --net=host -e POSTGRES_PASSWORD=123456 postgres:16

drop schema if exists lsp cascade;

create schema if not exists lsp;

create table if not exists lsp.grades (
    student_id integer,
    exam text,
    value numeric
);

insert into lsp.grades (student_id, exam, value) values
(2410001, 'P1',  9),
(2410001, 'P2', 10),
(2410001, 'P3',  7),
(2410001, 'P4',  6),
(2410001, 'P5',  8);

create table if not exists lsp.averages (
    student_id integer,
    value numeric
);
