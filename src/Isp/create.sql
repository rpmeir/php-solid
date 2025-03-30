
-- solid ISP video practice

drop schema if exists isp cascade;

create schema if not exists isp;

create table if not exists isp.products (
    product_id uuid primary key,
    description text,
    price numeric
);

insert into isp.products (product_id, description, price) values
('ae190ae8-e230-4f35-afb6-b4782366c38c', 'A', 1000),
('b20cf780-e23e-42aa-8757-577f3442fef8', 'B',  500),
('17453765-964e-48b4-854e-f32d1c2bf899', 'C',   20),
('6682bd4d-fb29-4c9a-aa57-1a859985667d', 'D',   10);

create table if not exists isp.orders (
    order_id uuid primary key,
    email text,
    total numeric,
    total_in_usd numeric,
    status text
);

create table if not exists isp.items (
    item_id uuid primary key,
    order_id uuid references isp.orders(order_id),
    product_id uuid references isp.products(product_id),
    quantity int,
    unit_price numeric,
    total numeric
);
