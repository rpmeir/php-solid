-- Dip

drop schema if exists dip cascade;

create schema if not exists dip;

create table if not exists dip.events (
    event_id uuid primary key,
    description text,
    price numeric
);

create table if not exists dip.tickets (
    ticket_id uuid primary key,
    event_id uuid,
    email text,
    price numeric,
    foreign key (event_id) references dip.events(event_id)
);

insert into dip.events (event_id, description, price) values
('185ff433-a7df-4dd6-ac86-44d219645cb1', 'A', 100);
