alter table `ip_clients`
add client_cod_interscambio varchar(7);
alter table `ip_clients`
add client_pec varchar(255);
alter table `ip_users`
add user_cod_interscambio varchar(7);
alter table `ip_users`
add user_pec varchar(255);