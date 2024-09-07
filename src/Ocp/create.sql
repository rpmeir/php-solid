-- open/closed_principle.sql

-- First, run the database in docker with this command:
-- docker run -it --rm -p 5432:5432 --net=host -e POSTGRES_PASSWORD=123456 postgres:16

drop schema if exists ocp cascade;

create schema if not exists ocp;

create table if not exists ocp.rooms (
    room_id uuid primary key,
    type text,
    price numeric
);

insert into ocp.rooms (room_id, type, price) values
('aa354842-59bf-42e6-be3a-6188dbb5fff8', 'day', 1000),
('d5f5c6cb-bf69-4743-a288-dafed2517e38', 'hour', 100);

create table if not exists ocp.reservations (
    reservation_id uuid primary key,
    room_id uuid,
    email text,
    checkin_date timestamp,
    checkout_date timestamp,
    price numeric,
    status text,
    duration numeric
);
